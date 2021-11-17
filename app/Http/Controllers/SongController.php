<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Category;
use App\Models\Like;
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
        $categories = Category::all();

        return view('songs.create', compact('categories'));
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
            $songPath = Storage::putFile('song_file', $file);
            $imagePath = Storage::putFile('song_image', $image);

            $song->file_name = basename($songPath);
            $song->image = basename($imagePath);

            $song->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            back()->withErrors(['error' => '保存に失敗しました']);
        }

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
        $like = null;
        foreach ($song->likes as $songLike) {
            foreach (Auth::user()->likes as $userLike) {
                if ($songLike->id == $userLike->id) {
                    $like = $userLike;
                    break;
                }
            }
        }

        return view('songs.show', compact('song', 'like'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        $categories = Category::all();

        

        return view('songs.edit', compact('song', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $song)
    {
        $song->fill($request->all());
        $image = $request->image;
        if ($image) {
            $delete_image_name = $song->image;
            $imagePath = Storage::putFile('song_image', $image);
            $song->image = basename($imagePath);
        }

        DB::beginTransaction();
        try {
            $song->save();

            if ($image) {
                if (!$imagePath) {
                    throw new \Exception('ジャケット写真の保存に失敗しました');
                }
                if (!Storage::delete('song_image/' . $delete_image_name)) {
                    throw new \Exception('ジャケット写真の保存に失敗しました');
                    dd($song);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return redirect()
            ->route('songs.show', $song)
            ->with(['flash_message' => '更新が完了しました']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        $delete_image_name = $song->image;
        $delete_file_name = $song->file_name;

        DB::beginTransaction();
        try {
            $song->delete();
            //ジャケ写削除
            if (!Storage::delete('song_image/' . $delete_image_name)) {
                throw new \Exception('ジャケ写の削除に失敗しました');
            }
            
            //曲削除
            if (!Storage::delete('song_file/' . $delete_file_name)) {
                throw new \Exception('曲の削除に失敗しました');
            }
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->withErrors($e->getMessage());
        }

        return redirect()
            ->route('songs.index')
            ->with(['flash_message' => '削除しました']);
    }

    
}
