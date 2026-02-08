<?php

namespace App\Http\Controllers\Private;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\VerificationRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserManagementController extends Controller
{
    public function getUserSessions(string $id)
    {
        $userSessions = [];
        $sessionsPath = storage_path('framework/sessions');

        if (!File::exists($sessionsPath)) {
            return response()->json($userSessions);
        }

        foreach (File::files($sessionsPath) as $file) {
            try {
                if ($file->getFilename()[0] === '.') {
                    continue;
                }

                $content = File::get($file->getPathname());
                
                $sessionData = null;
                
                if (preg_match('/^a:\d+:/', $content)) {
                    $sessionData = @unserialize($content);
                } 
                elseif (json_decode($content, true) !== null) {
                    $sessionData = json_decode($content, true);
                }
                
                if ($sessionData && is_array($sessionData)) {
                    $userId = null;
                    $userIp = null;
                    
                    foreach ($sessionData as $key => $value) {
                        if (preg_match('/^login_web_/', $key)) {
                            if ((string)$value === (string)$id) {
                                $userId = $value;
                            }
                        }
                        
                        if ($key === 'user_ip') {
                            $userIp = $value;
                        }
                    }
                    
                    if ($userId !== null && (string)$userId === (string)$id) {
                        $lastModified = File::lastModified($file->getPathname());
                        $lastActivity = date('Y-m-d H:i:s', $lastModified);

                        $userSessions[] = [
                            'sessionId' => $file->getFilename(),
                            'lastActivity' => $lastActivity,
                            'ipAddress' => $userIp ?: 'Не указан',
                        ];
                    }
                }
            } catch (\Exception $e) {
                continue;
            }
        }

        return response()->json($userSessions);
    }

    function removeUserSession(string $id, string $sessionId)
    {
        $sessionFile = storage_path('framework/sessions/' . $sessionId);

        if (File::exists($sessionFile)) {
            File::delete($sessionFile);

            return response()->json([
                'message' => 'Сессия удалена',
            ]);
        } else {
            return response()->json([
                'message' => 'Сессия не найдена',
            ]);
        }
    }

    public function getUserWithdrawals(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([], 404);
        }

        $withdrawalRequests = $user->withdrawalRequests;

        return response()->json($withdrawalRequests);
    }


    public function authAsUserMainDomain(string $id)
    {
        $user = User::find($id);

        if ($user) {
            Auth::login($user);
            
            request()->session()->put('user_ip', $this->getRealIpAddress(request()));

            return redirect('/');
        } else {
            return redirect('/login')->with('error', 'Пользователь не найден');
        }
    }



    public function authAsUser(string $id)
    {
        $currentHost = request()->getHost();
        
        $hostParts = explode('.', $currentHost);
        
        if (count($hostParts) >= 3) {
            $mainDomain = implode('.', array_slice($hostParts, 1));
        } else {
            $mainDomain = $currentHost;
        }
        
        $redirectUrl = (request()->secure() ? 'https://' : 'http://') 
            . $mainDomain 
            . '/auth-as-user/' . $id;
        
        return redirect($redirectUrl);
    }



    public function successVerificationRequest(string $id)
    {
        $verificationRequest = VerificationRequest::where('user_id', $id)->first();

        $verificationRequest->is_verified = 1;
        $verificationRequest->save();

        $verificationRequest->user->verify = 1;
        $verificationRequest->user->save();

        return response()->json([
            'message' => 'Запрос на верификацию успешно одобрен',
        ]);
    }

    public function rejectVerificationRequest(string $id)
    {
        $verificationRequest = VerificationRequest::where('user_id', $id)->first();

        $verificationRequest->is_verified = 2;
        $verificationRequest->save();

        return response()->json([
            'message' => 'Запрос на верификацию успешно отклонен',
        ]);
    }

    private function getRealIpAddress(Request $request): string
    {
        $ip = $request->ip();
        
        if ($ip === '127.0.0.1' || $ip === '::1' || empty($ip)) {
            if ($request->header('X-Real-IP')) {
                $ip = $request->header('X-Real-IP');
            }
            elseif ($request->header('X-Forwarded-For')) {
                $forwardedFor = $request->header('X-Forwarded-For');
                $ips = explode(',', $forwardedFor);
                $ip = trim($ips[0]);
            }
            elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        }
        
        return $ip ?: 'Неизвестен';
    }
}

