<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Photo;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('photos/create');
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $request->validate([
            'photo'=>'required',
        ]);
        $photo = Photo::create([
        'photo' => $request->file('photo')->store('images'),
        'user_id' => $userId,
        ]);

        return back();
    }

    public function show()
    {
        $userId = auth()->user()->id;
        $photoList = Photo::where('user_id',$userId)->get();
        return view('photos.photos', compact('photoList'));
    }

    public function delete($id)
    {
        $photo = Photo::find($id)->delete();
        return back();
    }
}
