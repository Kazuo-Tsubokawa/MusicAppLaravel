<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $song = new Song();
        $song->fill($request->all());
        $artist = Artist::where('user_id', $request->user()->id)->get();
        $song->artist_id = $artist[0]['id'];

        // $file = $request->file;
        // $image = $request->image;

        // DB::beginTransaction();
        // try {
        // dd(Storage::url('song_file'));
        // $songPath = Storage::putFile('song_file', $file);
        // $imagePath = Storage::putFile('song_image', $image);

        $song->file_name = $request->file_name;
        $song->image = $request->image;

        $song->save();
        // DB::commit();
        $songArtist = [$song, $artist[0], $request->user()];
        return $songArtist;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        // $song->fill($request->all());
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $song)
    {
        $song->fill($request->all());
        $artist = Artist::where('user_id', $request->user()->id)->get();
        $song->artist_id = $artist[0]['id'];

        $song->image = $request->image;

            $song->save();
            $songArtist = [$song, $artist[0], $request->user()];
            return $songArtist;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
