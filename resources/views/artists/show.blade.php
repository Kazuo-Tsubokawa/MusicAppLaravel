<x-app-layout>
    @section('title', '詳細画面')
    {{-- @include('partial.flash') --}}
    {{-- @include('partial.errors') --}}
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto px-8 bg-gray-400 shadow-md rounded-md">
        <h2 class="text-center text-3xl text-white font-bold pt-6 tracking-widest mb-4">プロフィール</h2>
        <div>
            <img src="{{ Storage::url('artist_image/' . $artist->image) }}" alt="image" width="300" height="300"
                style="display: block; margin: auto;">
        </div>

        <div class="text-center">
            @if (Auth::user()->artist->id !== $artist->id)
                @if ($follow)
                    <form action="{{ route('artists.follows.destroy', [$artist, $follow]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="フォローやめる" class="mt-5 bg-red-200">
                    </form>
                @else
                    <form action="{{ route('artists.follows.store', $artist) }}" method="POST">
                        @csrf
                        <input type="submit" value="フォローする✓" class="mt-5 bg-green-200">
                    </form>
                @endif
            @endif
        </div>

        <div class="mb-4 text-1xl font-bold mt-4">
            <label class="block text-white mb-2">
                アーティスト名 : {{ $artist->name }}</label>
        </div>

        <div class="mb-4 text-1xl font-bold">
            <label class="block text-white mb-2">メンバー</label>
            @foreach ($artist->members as $member)
                <p>{{ $member->name }}</p>
            @endforeach
        </div>

        <div class="mb-4 text-1xl font-bold">
            <label class="block text-white mb-2">
                活動地域 : {{ $artist->prefecture->name }}</label>
        </div>

        <div class="mb-5 text-1xl font-bold">
            <label class="block text-white mb-2">
                紹介 : {{ $artist->introduction }}</label>
        </div>

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-3 rounded text-center mb-6 mt-2">
            <a href="{{ route('songs.index') }}">戻る</a>
        </button>
    </div>
</x-app-layout>
