<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Photo;
use Illuminate\Http\Request;

class PhotosApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Photo::all();
    }


    public function getSingleSong(Photo $song)
    {
        return $song;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $photo = new Photo;
        $photo->user_id = $request->user_id;
        $photo->album_id = $request->album_id;
        $photo->songFile = $request->input('songFile');
        $photo->songName = $request->input('songName');
        $photo->coverImage = $request->input('coverImage');
        $photo->artistName = $request->input('artistName');
    
        $photo->save();

        return $photo;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $photo = Photo::find($id);

        $photo->songFile = $request->input('songFile');
        $photo->songName = $request->input('songName');
        $photo->coverImage = $request->input('coverImage');
        $photo->artistName = $request->input('artistName');

        $photo->save();
        return $photo;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        if($photo)
            $photo->delete(); 
        else
        return response()->json([
            'message' => 'Greška prilikom brisanja stavke. Provjerite postoji li stavka u sustavu.'], 404);

        return response()->json(null);
    }
}