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
            'photo'=>'required | mimes:jpeg,jpg,png | max:1000',
        ]);
        $image = $request->file('photo');
        $photo = Photo::create([
        'photo' =>  $image->store('images',['disk' => 'public']),
        'user_id' => $userId,
        ]);

        return back()->with('success', "Photo created successfully");
    }

    public function show()
    {
        $userId = auth()->user()->id;
        $photoList = Photo::where('user_id',$userId)->get();
        return view('photos.photos', compact('photoList'));
    }

    public function setProfilePhoto($photoId)
    {
        $photo = Photo::findOrFail($photoId);
        $photoName = $photo->photo;

        $user = auth()->user();
        $user->photo = $photoName;
        $user->save();

        return back()->with('success', "Profile photo updated ");
    }

    public function delete($id)
    {
        $photo = Photo::find($id)->delete();
        return back();
    }
}
