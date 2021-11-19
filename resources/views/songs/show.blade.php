<x-app-layout>
    @extends('layouts.main')
    @section('title', 'ランダム再生')
    @include('partial.flash')
    @include('partial.errors')
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 bg-gray-400 shadow-md rounded-md">
        <h2 class="text-center text-3xl text-white font-bold pt-6 tracking-widest mb-4">インディーズBOX</h2>
        <div>
            {{-- {{ dd(Request::url()) }} --}}
            {{-- {{ dd(Storage::url('song_image/' . $song->image)) }} --}}
            <img src="{{ Storage::url('song_image/' . $song->image) }}" class="w-full">
        </div>

        <div class="text-2xl mt-4 text-white font-bold mb-2">{{ $song->title }}

            <div class="flex flex-row-reverse">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <a href="{{ route('songs.index') }}">曲送り</a>
                </button>
            </div>

            <div>
                <a href="{{ route('artists.show', $song->artist) }}"
                    class="text-1xl mt-4 text-white font-bold mb-2">{{ $song->artist->name }}</a>
            </div>

            <div>
                <audio controls autoplay src="{{ Storage::url('song_file/' . $song->file_name) }}"
                    class="w-full mt-2"></audio>
            </div>

            <div>
                {{-- {{ dd($like) }} --}}
                @if ($like)
                    <form action="{{ route('songs.likes.destroy', [$song, $like]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="♥">
                    </form>
                @else
                    <form action="{{ route('songs.likes.store', $song) }}" method="POST">
                        @csrf
                        <input type="submit" value="♡">
                    </form>
                @endif

            </div>
            <div>{{ $song->description }}</div>

            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <a href="{{ route('songs.create') }}" class="">投稿</a>
            </button>

            @can('update', $song)
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <a href="{{ route('songs.edit', $song) }}">編集</a>
                </button>
            @endcan

            @can('delete', $song)
                <form action="{{ route('songs.destroy', $song) }}" method="post" id="form">
                    @csrf
                    @method('delete')
                    <input type="submit" value="削除" form="form"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        onclick="if (!confirm('本当に削除してよろしいですか？')) {return false};">
                </form>
            @endcan
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" name="category" placeholder="ジャンルから探す">
                <input class="form-control mr-sm-2" type="search" name="prefecture" placeholder="活動地域から探す">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</x-app-layout>
