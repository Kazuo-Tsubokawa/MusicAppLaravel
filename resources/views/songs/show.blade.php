<x-app-layout>
@extends('layouts.main')
@section('title', 'ランダム再生')
    @include('partial.flash')
    @include('partial.errors')

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
            {{-- {{ dd(Storage::url('song_image/' . $song->image)) }} --}}
            <img src="{{ Storage::url('song_image/' . $song->image) }}" class="rounded mx-auto d-block h-100">
        </div>
        <div>{{ $song->title }}</div>
        <div>
            <a href="{{ route('artists.show', $song->artist) }}">{{ $song->artist->name }}</a>
        <div>
            <audio controls autoplay src="{{ Storage::url('song_file/' . $song->file_name) }}"></audio>
        </div>
        <div>{{ $song->description }}</div>
        <div>
            <a href="{{ route('songs.index') }}">曲送り</a>
        </div>
        <a href="{{ route('songs.create') }}" class="">曲投稿</a>
        <a href="{{ route('songs.edit', $song) }}">曲情報編集</a>

        <form action="{{ route('songs.destroy', $song) }}" method="post" id="form">
            @csrf
            @method('delete')
        </form>
        <div class="d-grid col-6 mx-auto gap-3">
            <input type="submit" value="削除" form="form" class="btn btn-danger btn-lg"
                onclick="if (!confirm('本当に削除してよろしいですか？')) {return false};">
        </div>
    </x-app-layout>
