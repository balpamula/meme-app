<?php

namespace App\Http\Controllers;

use App\Models\Meme;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home.index', [
            'memes' => Meme::latest()->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('home.create');
    }

    public function uploadFile(UploadedFile $file, $folder = null, $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);

        return $file->storeAs(
            $folder,
            $name . "." . $file->getClientOriginalExtension(),
            'gcs'
        );
    }

    public function store(Request $request)
    {
        $link = $request->hasFile('image') ? $this->uploadFile($request->file('image')) : null;

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|image|max:4096',
            'description' => 'nullable'
        ]);

        $validatedData['img_url'] = $link;

        Meme::create($validatedData);

        toastr()->success('New meme added!', ['closeButton' => true]);
        return redirect('/meme');
    }

    /**
     * Display the specified resource.
     */
    public function show(Meme $meme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meme $meme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meme $meme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meme $meme)
    {
        Storage::disk('gcs')->delete($meme->img_url);

        Meme::destroy($meme->id);

        toastr()->success('Meme deleted successfully!', ['closeButton' => true]);
        return redirect('/');
    }
}
