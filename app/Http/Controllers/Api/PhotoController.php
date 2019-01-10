<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Photo;
class PhotoController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Photo $photo
     * @return Photo
     */
    public function show()
    {
        $userId = auth()->user()->id;
        $photoList = Photo::where('user_id',$userId)->get();
        return $photoList;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


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
        return response()->json($photo, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Photo $photo
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function delete(Photo $photo)
    {
        $photo->delete();

        return response()->json("Deleted Successfully", 204);
    }
}
