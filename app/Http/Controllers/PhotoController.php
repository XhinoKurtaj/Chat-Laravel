<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        //upload img
//        if(Input::hasFile('file')){
//
//            echo 'Uploaded';
//            $file = Input::file('file');
//            $file->move('uploads', $file->getClientOriginalName());
//            echo '';
        $request->validate([
            'photo'=>'required',
            'user_id'
        ]);
        $photo = Photo::create([
        'photo' => $request->file('photo')->store('images'),
        'user_id' => $request->get('userId'),
        ]);

        return back();

//        $photo = Photo::create([
//            'photo' => $request->get('photo'),
//            'user_id' => $request->get('userId')
//        ]);
//        return redirect('photos/show');

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
