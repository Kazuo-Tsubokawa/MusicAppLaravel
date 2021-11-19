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
        $artist = Artist::where('user_id', $request->user()->id)->first();
        $song->artist_id = $artist['id'];

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
    public function show($songid)
    {
        $song = Song::find($songid);

        return $song;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $song_id)
    {
        $song = Song::find($song_id);
        $artist = Artist::where('user_id', $request->user()->id)->first();
        if ($song->artist_id != $artist->id || $artist->count() == 0) {
            return ["message" => "error"];
        };
        $song->fill($request->all());
        $song->image = $request->image;

        $song->save();

        return ["song" => $song];

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
