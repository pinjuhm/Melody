<?php

namespace App\Http\Controllers;

use App\Photo;
use App\User;
use Auth;
use Gate;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files  =   Photo::all();

        return view('photos.show', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($album_id)
    {

        return view('photos.create')->with('album_id', $album_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'songFile' => 'nullable|file|mimes:audio/mpeg,mpga,mp3,wav,aac',
            'songName' => 'required',
            'coverImage' => 'required|mimes:jpeg,png,jpg,bmp|max:5048',
            'artistName' => 'required',
        ]);

        if($file = $request->file('songFile') and $image = $request->file('coverImage')) {

            $fileName = time().time().'.'.$file->getClientOriginalExtension();


            $imageName = time().time().'.'.$image->getClientOriginalExtension();
            //$target_path = public_path('/uploads/songs_and_cover_images/');

            Storage::disk('public')->putFileAs(
                'uploads/songs_and_cover_images/',
                $file,
                $fileName
            );

            Storage::disk('public')->putFileAs(
                'uploads/songs_and_cover_images/',
                $image,
                $imageName
            );


          //  if($file->move($target_path, $fileName) and $image->move($target_path, $imageName)) {

                $photo = new Photo();
                $photo->user_id =  Auth::user()->id;
                $photo->album_id = $request->input('album_id');
                $photo->songFile = $fileName;
                $photo->songName = $request->input('songName');
                $photo->coverImage = $imageName;
                $photo->artistName = $request->input('artistName');
                //$photo->save();

                if($photo->save()){
                    $request->session()->flash('success', "Stavka " . $photo->songName . ' je uspještno prenesena');
                }else{
                    $request->session()->flash('error', 'Došlo je do pogreške tokom prijesnosa stavke!');
                }


                return redirect('/albums/' . $request->input('album_id'));
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function destroy(Photo $photo, User $user)
    {
        //$photo->delete();

        if($photo->delete()){
            session()->flash('success', "Stavka " . $photo->songName . ' je uspješno izbrisana');
        }else{
            session()->flash('error', 'Došlo je do greške prilikom brisanja stavke ' . $photo->songName . '!');
        }



        if(Gate::denies('delete-users')){
            return redirect()->route('management.show',Auth::user());
        }

        // return redirect()->route('information.show', $user);
        return redirect()->route('admin.users.index');


    }

}
