<x-app-layout>
    @section('title', '詳細画面')
    @include('partial.flash')
    @include('partial.errors')
    <div>
        <p>プロフィール</p>
        <img src="{{ Storage::url('artist_image/' . $artist->image) }}" class="rounded mx-auto d-block h-100">
    </div>


    <div>
        {{-- {{ dd($follow) }} --}}
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
                <input type="submit" value="＋フォローする＋">
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

</x-app-layout>
