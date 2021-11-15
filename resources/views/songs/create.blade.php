@extends('layouts.main')
@section('title', '新規登録')
@section('content')
    <div class="col-8 col-offset-2 mx-auto">
        <h1>新規登録</h1>
        <form action="{{ route('songs.store') }}" method="post">
            <div class="card mb-3">
                @csrf
                <div class="row m-3">
                    <label for="name" class="form-label">アーティスト名</label>
                    <input type="name" name="name" id="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">曲名</label>
                    <input type="title" name="title" id="title" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">ジャケット写真を選択してください</label>
                    <input type="file" name="image" id="image" class="form-control">
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
                    <textarea name="descroption" id="descroption" rows="5" class="form-control"></textarea>
                </div>
                <input type="submit">
            </div>
        </form>
    </div>
@endsection
