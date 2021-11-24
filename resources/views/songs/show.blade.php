<x-app-layout>
    @section('title', 'ランダム再生')
    {{-- @include('partial.flash') --}}
    {{-- @include('partial.errors') --}}
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto pt-1 px-8 bg-gray-400 shadow-md rounded-md">
        <div class="text-center mt-4 mb-5">
            <form action="{{ route('songs.random') }}" method="GET" class="form-inline my-2 my-lg-0">
                <select name="category_id">
                    <option selected>ジャンルから探す</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if (old('category') == $category->id) selected  @endif>{{ $category->name }}</option>
                    @endforeach
                </select>

                <select name="prefecture_id">
                    <option selected>活動地域から探す</option>
                    @foreach ($prefectures as $prefecture)
                        <option value="{{ $prefecture->id }}" @if (old('prefecture') == $prefecture->id) selected  @endif>{{ $prefecture->name }}</option>
                    @endforeach
                </select>

                <button class="btn btn-outline-success my-2 my-sm-0 ml-2 text-gray-800" type="submit">検索</button>
            </form>
        </div>

        <div class="flex justify-center">
            {{-- {{ dd(Request::url()) }} --}}
            {{-- {{ dd(Storage::url('song_image/' . $song->image)) }} --}}
            <img src="{{ Storage::url('song_image/' . $song->image) }}" alt="image" width="300" height="300"
                style="display: block; margin: auto; object-fit">
        </div>

        <div class="text-center">
            <h3 class="text-2xl mt-4 text-white font-bold mb-2 ml-60 pl-6" style="float: left">
                {{ $song->title }}
            </h3>
            @if ($like)
                <form action="{{ route('songs.likes.destroy', [$song, $like]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="いいね削除👎" class="mt-5 bg-red-200">
                </form>
            @else
                <form action="{{ route('songs.likes.store', $song) }}" method="POST">
                    @csrf
                    <input type="submit" value="いいね👍" class="mt-5 bg-green-200">
                </form>
            @endif
        </div>

        <div class="text-center text-1xl mt-4 text-white font-bold mb-2">
            <a href="{{ route('artists.show', $song->artist) }}">{{ $song->artist->name }}</a>
        </div>

        <audio controls autoplay src="{{ Storage::url('song_file/' . $song->file_name) }}" class="w-250 ml-20"
            style="float: left"></audio>

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2 ml-20">
            <a href="{{ route('songs.index') }}">▶▶曲送り▶▶</a>
        </button>

        <p class="text-center text-1xl mt-5 bg-red-100 text-black font-bold mb-2">曲の説明</p>
        <div class="text-center text-1xl mt-4 text-white font-bold mb-2">{{ $song->description }}</div>


        <div class="text-center">
            <button
                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 mr-3 mb-4 rounded text-center">
                <a href="{{ route('songs.create') }}">投稿</a>
            </button>
            @can('update', $song)
                <button
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mr-3 mb-4 rounded text-center">
                    <a href="{{ route('songs.edit', $song) }}">編集</a>
                </button>
            @endcan
            @can('delete', $song)
                <form action="{{ route('songs.destroy', $song) }}" method="post" class="display: inline-block">
                    @csrf
                    @method('delete')
                    <input type="submit" value="削除"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mb-4 rounded text-center"
                        onclick="if (!confirm('本当に削除してよろしいですか？')) {return false};">
                </form>
            @endcan
        </div>
    </div>
</x-app-layout>
