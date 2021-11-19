<x-app-layout>
    @section('title', '詳細画面')
    @include('partial.flash')
    @include('partial.errors')
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 bg-gray-400 shadow-md rounded-md">
        <h2 class="text-center text-3xl text-white font-bold pt-6 tracking-widest mb-4">プロフィール</h2>
    <div>
        <img src="{{ Storage::url('artist_image/' . $artist->image) }}" class="w-full">
    </div>


    <div>
        @if (Auth::user()->artist->id !== $artist->id) 
        @if ($follow)
        <form action="{{ route('artists.follows.destroy', [$artist, $follow]) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="−フォロー外す−">
        </form>
        @else
            <form action="{{ route('artists.follows.store', $artist) }}" method="POST">
                @csrf
                <input type="submit" value="＋フォローする＋">;
            </form>
        @endif
        @endif
    </div>


    <div>
        <p>アーティスト名</p>
        <p>{{ $artist->name }}</p>
    </div>
    <div>
        <p>メンバー</p>
        @foreach ($artist->members as $member)
            <p>{{ $member->name }}</p>
        @endforeach
    </div>
    <div>
        <p>活動地域</p>
        <p>{{ $artist->prefecture->name }}</p>
    </div>
    <div>
        <p>紹介</p>
        <p>{{ $artist->introduction }}</p>
    </div>
    <a href="{{ route('songs.index') }}">戻る</a>

    </div>
</x-app-layout>
