<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('private.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('private.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = public_path('img/banners');

        $image->move($imagePath, $imageName);

        Banner::create([
            'image' => 'img/banners/' . $imageName,
        ]);

        return redirect()->route('private.banners.index')->with('success', 'Баннер успешно создан');
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('img/banners');

            if (File::exists(public_path($banner->image))) {
                File::delete(public_path($banner->image));
            }

            $image->move($imagePath, $imageName);

            $banner->image = 'img/banners/' . $imageName;
        }

        $banner->save();

        return redirect()->route('private.banners.index')->with('success', 'Фото баннера обновлено');
    }

    public function destroy(Banner $banner)
    {
        if (File::exists(public_path($banner->image))) {
            File::delete(public_path($banner->image));
        }

        $banner->delete();
        return redirect()->route('private.banners.index')->with('success', 'Баннер удален');
    }
}
