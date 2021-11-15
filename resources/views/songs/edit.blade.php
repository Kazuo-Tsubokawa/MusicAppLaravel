@extends('layouts.main')
@section('title', '編集画面')
@section('content')
    <h1>詳細編集</h1>
    <section>
        <div class="card shadow">
            <figure class="m-3">
                <div class="row">
                    <div class="col-6">
                        <img src="{{ $song->image }}" width="100%">
                    </div>
                    <div class="col-6">
                        <figcaption>
                            <form action="{{ route('songs.update', $song) }}" method="post" id="form">
                                @csrf
                                @method('patch')
                                <div class="row m-3">
                                    <label for="name" class="form-label">アーティスト名</label>
                                    <input type="name" name="name" id="name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">曲名</label>
                                    <input type="title" name="title" id="title" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="file" class="form-label">ジャケット写真を選択してください</label>
                                    <input type="file" name="file" id="file" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="file" class="form-label">音声ファイルを選択してください</label>
                                    <input type="file" name="file" id="file" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">ジャンル</label>
                                    <input type="category" name="category" id="category" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">曲の説明を入力してください</label>
                                    <textarea name="descroption" id="descroption" rows="5"
                                        class="form-control"></textarea>
                                </div>
                            </form>
                        </figcaption>
                    </div>
                </div>
            </figure>
        </div>
        <div class="d-grid gap-3 col-6 mx-auto">
            <input type="submit" value="更新" form="form" class="btn btn-success btn-lg">
            <a href="{{ route('songs.index') }}" class="btn btn-secondary btn-lg">戻る</a>
        </div>
    </section>
@endsection
