<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;

use App\Models\FooterLink;
use Illuminate\Http\Request;

class FooterLinkController extends Controller
{
    public function index()
    {
        $footerLinks = FooterLink::all();
        return view('private.footer-links.index', compact('footerLinks'));
    }

    public function create()
    {
        return view('private.footer-links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required|unique:footer_links,url',
            'content' => 'required',
        ]);

        FooterLink::create($request->all());
        return redirect()->route('private.footer-links.index')->with('success', 'Страница успешно создана.');
    }

    public function edit(FooterLink $footerLink)
    {
        return view('private.footer-links.edit', compact('footerLink'));
    }

    public function update(Request $request, FooterLink $footerLink)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required|unique:footer_links,url,' . $footerLink->id,
            'content' => 'required',
        ]);

        $footerLink->update($request->all());
        return redirect()->route('private.footer-links.index')->with('success', 'Страница успешно обновлена.');
    }

    public function destroy(FooterLink $footerLink)
    {
        $footerLink->delete();
        return redirect()->route('private.footer-links.index')->with('success', 'Страница успешно удалена.');
    }

    public function show($slug)
    {
        $footerLink = FooterLink::where('url', $slug)->firstOrFail();
        return view('private.footer-links.show', compact('footerLink'));
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/uploads', $filename);

            return response()->json([
                'url' => Storage::url($path)
            ]);
        }

        return response()->json(['error' => 'Image upload failed.'], 422);
    }

    public static function getFooterLinks()
    {
        return FooterLink::all();
    }
}
