<?php

namespace App\Http\Controllers\Api;

use App\Album;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlbumsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Album::all();
    }

    public function getSingleAlbum(Album $album)
    {
        return $album;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $album = new Album;
        $album->user_id = $request->user_id;
        $album->name = $request->input('name');
        $album->cover_image = $request->input('cover_image');
    
        $album->save();

        return $album;

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
        $album = Album::find($id);

        $album->name = $request->input('name');
        $album->cover_image = $request->input('cover_image');
        $album->save();
        return $album;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::find($id);
        if($album)
            $album->delete(); 
        else
        return response()->json([
            'message' => 'Greška prilikom brisanja albuma. Provjerite postoji li album u sustavu.'], 404);

        return response()->json(null); 
    }
}