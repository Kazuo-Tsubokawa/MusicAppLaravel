<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Member;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prefectures = Prefecture::all();

        return view('artists.create', compact('prefectures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $artist = new Artist();
        $artist->fill($request->all());
        // dd(Auth::user());
        $artist->user_id = Auth::user()->id;

        $image = $request->image;

        // dd($artist);
        DB::beginTransaction();
        try {
            $imagePath = Storage::putFile('artist_image', $image);

            $artist->image = basename($imagePath);

            $artist->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            back()->withErrors(['error' => '保存に失敗しました']);
        }

        return redirect()->route('artists.show', compact('artist'))->with(['flash_message' => '登録が完了しました！']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        return view('artists.show', compact('artist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $artist
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        $prefectures = Prefecture::all();
        return view('artists.edit', compact('artist','prefectures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {

        $artist->fill($request->all());

        $members = $request->member; //7 裕美子 11 宮沢
        // dd($members);
        // dd(array_keys($members));
        if ($members != null) {
        foreach (array_keys($members) as $memberId) {
            $member = Member::find($memberId);
            if ($members[$memberId] == null) {
                $member->delete();
            } else {
                $member->name = $members[$memberId];
                $member->save();
            }
        }
        }

        $image = $request->image;
        if ($image) {
            $delete_image_name = $artist->image;
            $imagePath = Storage::putFile('artist_image', $image);
            $artist->image = basename($imagePath);
        }

        DB::beginTransaction();
        try {
            $artist->save();

            if ($image) {
                if (!$imagePath) {
                    throw new \Exception('写真の保存に失敗しました');
                }
                if (!Storage::delete('artist_image/' . $delete_image_name)) {
                    throw new \Exception('写真の保存に失敗しました');
                    dd($artist);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return redirect()
            ->route('artists.show', $artist)
            ->with(['flash_message' => '更新が完了しました']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $delete_image_name = $artist->image;
        $delete_file_name = $artist->file_name;

        DB::beginTransaction();
        try {
            $artist->delete();
            //ジャケ写削除
            if (!Storage::delete('artist_image/' . $delete_image_name)) {
                throw new \Exception('ジャケ写の削除に失敗しました');
            }

            //曲削除
            if (!Storage::delete('artist_file/' . $delete_file_name)) {
                throw new \Exception('曲の削除に失敗しました');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->withErrors($e->getMessage());
        }

        return redirect()
            ->route('artists.index')
            ->with(['flash_message' => '削除しました']);
    }
}
