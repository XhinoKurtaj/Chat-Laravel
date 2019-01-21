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
    public function index()
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

    /**
     * Remove the specified resource from storage.
     *
     * @param Photo $photo
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function delete($id)
    {
        if ($photo = Photo::find($id)) {
            $photo->delete();
            return response()->json( 204);
            }else{
            return response()->json('Photo doesnt exist!', 404);
        }
    }
}
