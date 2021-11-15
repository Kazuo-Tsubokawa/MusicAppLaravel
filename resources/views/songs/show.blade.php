@extends('layouts.main')

@section('title', 'ランダム再生')

@section('content')

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('songs.index') }}">インディーズBOX</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" name="category" placeholder="ジャンルから探す">
                <input class="form-control mr-sm-2" type="search" name="prefecture" placeholder="活動地域から探す">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>


    <div class="list-unstyled border shadow vh-100">
        <div>
            <img src="/storage/song_image/1.jpeg" class="rounded mx-auto d-block h-100">
        </div>
        <div>{{ $song->title }}</div>
        <div>{{ $song->artist->name }}</div>
        <div>
            <audio controls src="/storage/song_file/animal.mp3"></audio>
        </div>
        <div>
            <a href="{{ route('songs.index') }}">曲送り</a>
        </div>
        <a href="{{ route('songs.create') }}" class="position-fixed fs-1 bottom-0 end-0">
            <i class="fas fa-plus-circle"></i>
        </a>
    </div>
@endsection
