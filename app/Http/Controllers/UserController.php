<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VerificationRequest;

class UserController extends Controller
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('login')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->string('label_admin')->nullable();
            $table->unsignedBigInteger('role_id')->default(1);
            $table->decimal('money', 10, 2)->default(0);
            $table->decimal('bonus', 10, 2)->default(0);
            $table->string('cur')->nullable();
            $table->timestamps();
        });
    }

    public function privateadmin(Request $request)
    {
        $searchId = trim($request->input('search_id'));

        if ($searchId) {
            if (filter_var($searchId, FILTER_VALIDATE_EMAIL)) {
                $users = User::where('email', 'LIKE', "%{$searchId}%")->orderBy('created_at', 'desc')->get();
            } elseif (is_numeric($searchId)) {
                $cleanedSearchId = preg_replace('/[^0-9]/', '', $searchId);
                $users = User::where('id', $cleanedSearchId)
                    ->orWhereRaw("REPLACE(REPLACE(REPLACE(phone, ' ', ''), '(', ''), ')', '') LIKE ?", ["%{$cleanedSearchId}%"])
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                $users = User::where('name', 'LIKE', "%{$searchId}%")
                    ->orWhere('email', 'LIKE', "%{$searchId}%")
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        } else {
            $users = User::orderBy('created_at', 'desc')->get();
        }

        $totalUsers = User::count();

        return view('private_users', compact('users', 'totalUsers'));
    }
    public function verificationRequest(Request $request)
    {
        $filesPaths = [];

        $request->validate([
            'files' => 'required|array|min:1|max:4',
            'files.*' => 'file|max:8192',
        ]);

        if ($request->hasFile('files')) {
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            foreach ($request->file('files') as $file) {
                $extension = strtolower($file->getClientOriginalExtension());
                if (!in_array($extension, $allowedExtensions)) {
                    return response()->json([
                        'message' => 'Разрешены только файлы формата JPG, JPEG и PNG.'
                    ], 422);
                }
            }
        }

        $requestIsExist = VerificationRequest::where('user_id', auth()->id())->where('is_verified', 0)->exists();

        if ($requestIsExist) {
            return response()->json([
                'message' => 'У вас уже есть заявка на верификацию.'
            ]);
        }

        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach($files as $file) {
                $path = $file->move(public_path('img/verification-requests'), $file->getClientOriginalName());
                $filesPaths[] = 'img/verification-requests/' . $file->getClientOriginalName();
            }
        }

        $pathsString = implode(',', $filesPaths);

        VerificationRequest::create([
            'user_id' => auth()->id(),
            'image_links' => $pathsString,
        ]);

        return response()->json([
            'message' => 'Заявка на верификацию отправлена.'
        ]);
    }
}
