<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Arg;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $song = Song::inRandomOrder()->first();
        return redirect()->route('songs.show', $song);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('songs.create');
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
        
        $song->artist_id = Auth::user()->artist->id;

        $file = $request->file;
        $image = $request->image;

        DB::beginTransaction();
        try {
            $song->save();

            $file = Storage::putFile('song_file', $file);
            $image = Storage::putFile('song_image', $image);

            $song->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            back()->withErrors(['error' => '保存に失敗しました']);
        }
        dd($song);
        return redirect()->route('songs.show', compact('song'))->with(['flash_message' => '登録が完了しました！']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        return view('songs.show', compact('song'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $song
     * @return \Illuminate\Http\Response
     */
    public function edit($song)
    {
        return view('songs.edit', compact('song'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $song)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy($song)
    {
        //
    }
}
