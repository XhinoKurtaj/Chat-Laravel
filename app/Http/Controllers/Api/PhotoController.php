<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Photo;
class PhotoController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $photoList = Photo::where('user_id',$userId)->get();
        return $photoList;
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $request->validate([
            'photo'=>'required|mimes:jpeg,jpg,png|max:1000',
        ]);
        $image = $request->file('photo');
        $photo = Photo::create([
            'photo' =>  $image->store('images',['disk' => 'public']),
            'user_id' => $userId,
        ]);
        if($photo)
            return response()->json("Photo added successfully", 201);
        else
            return response()->json("Something went wrong try again later!", 500);
    }

    public function delete($id)
    {
        $photo = Photo::find($id);
        $photo->delete();
        return response()->json( 204);
    }
}
