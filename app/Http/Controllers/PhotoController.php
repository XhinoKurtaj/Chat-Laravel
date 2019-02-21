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

    public function show()
    {
        return view('photos/create');
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $photoList = Photo::where('user_id',$userId)->get();
        return view('photos.photos', compact('photoList'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'photo'=>'required|mimes:jpeg,jpg,png ',
        ]);
        $image = $request->file('photo');
        $photo = Photo::create([
        'photo' =>  $image->store('images',['disk' => 'public']),
        'user_id' => $user->id,
        ]);

        return back()->with('success', "Photo created successfully");
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
        if(auth()->user()->type == "admin")
            return redirect()->route('photos.table');
        else
            return back();
    }

    public function photoDetails($id)
    {
        $check = Photo::find($id);
        if($check){
            $photoDetails = Photo::where('id',$id)
                ->with('user')
                ->get();
            return view('PhotoView', compact('photoDetails'));
        }else{
            return back();
        }
    }
}
