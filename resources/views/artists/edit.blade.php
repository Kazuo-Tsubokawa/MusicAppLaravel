<x-app-layout>
    @section('title', '編集画面')
    {{-- @include('partial.flash') --}}
    {{-- @include('partial.errors') --}}
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-5 px-8 bg-gray-400 shadow-md rounded-md">
        <h2 class="text-center text-3xl text-white font-bold pt-6 tracking-widest mb-4">アーティスト情報の編集</h2>
        <form action="{{ route('artists.update', $artist) }}" method="post" id="form1" enctype="multipart/form-data"
            class="rounded pt-3 pb-8 mb-2">
            @csrf
            @method('patch')
            <div class="mb-4">
                <label class="block text-white mb-2" for="image">ジャケット写真を選択してください</label>
                <input type="file" name="image">
            </div>



            <div class="mb-3">
                <label class="block text-white mb-2" for="name">
                    アーティスト名
                </label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $artist->name) }}">
            </div>


            {{-- {{ dd(($artist->members->count())) }} --}}
            @if ($artist->members->count() != 0)
                <div class="mb-3">
                    <p class="text-white mb-2">メンバー</p>
                    @foreach ($artist->members as $member)
                        <input class="block mb-1" type="text" name="member[{{ $member->id }}]"
                            value="{{ $member->name }}">
                    @endforeach
                </div>
            @endif


            <div class="mb-3">
                <label class="block text-white mb-2" for="prefecture">
                    活動地域
                </label>
                <select name="prefecture_id">
                    @foreach ($prefectures as $prefecture)
                        <option value="{{ $prefecture->id }}" @if (old('prefecture') == $prefecture->id) selected  @endif>
                            {{ $prefecture->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="block text-white mb-2" for="introduction" class="form-label">自己紹介</label>
                <textarea class="w-full" name="introduction" rows="5" equired
                    placeholder="自己紹介">{{ old('introduction', $artist->introduction) }}</textarea>
            </div>
            
            <input type="submit" value="更新"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mr-3 rounded text-center">
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mr-3 rounded text-center">
                <a href="{{ route('artists.show', $artist) }}">戻る</a>
            </button>
        </form>
    </div>

    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto pt-2 pb-2 px-8 bg-gray-400 shadow-md rounded-md">
        <form action="{{ route('members.store') }}" method="post" id="form2">
            @csrf
            <div class="mb-2 pt-2">
                <label class="text-white mb-2 mr-2" for="name">メンバー追加</label>
                <input type="text" name="name" class="form-control">
                <input type="submit" value="追加" form="form2"
                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 mr-3 rounded text-center">
            </div>
        </form>
    </div>
    {{-- <div class="d-grid col-6 mx-auto gap-3">
            <input type="submit" value="アーティスト登録をやめる" form="form" class="btn btn-danger btn-lg"
                onclick="if (!confirm('本当にやめますか？')) {return false};">
        </div> --}}
</x-app-layout>
