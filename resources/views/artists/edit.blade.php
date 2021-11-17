<x-app-layout>
    @section('title', '編集画面')
    @include('partial.flash')
    @include('partial.errors')
    <h1>アーティスト情報の編集</h1>
    <section>
        <div class="card shadow">
            <figure class="m-3">
                <div class="row">
                    <div class="col-6">
                        <figcaption>
                            <form action="{{ route('artists.update', $artist) }}" method="post" id="form1"
                                enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="mb-3">
                                    <label for="image" class="form-label">写真を選択してください</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">アーティスト名</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $artist->name) }}">
                                </div>
                                {{-- {{ dd(($artist->members->count())) }} --}}
                                @if ($artist->members->count() != 0)
                                    <div class="mb-3">
                                        <p>メンバー</p>
                                        @foreach ($artist->members as $member)
                                            <input class="block" type="text" name="member[{{ $member->id }}]"
                                                value="{{ $member->name }}">
                                        @endforeach
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <label for="prefecture">活動地域</label>
                                    <select name="prefecture_id">
                                        @foreach ($prefectures as $prefecture)
                                            <option value="{{ $prefecture->id }}" @if (old('prefecture') == $prefecture->id) selected  @endif>
                                                {{ $prefecture->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="introduction" class="form-label">自己紹介</label>
                                    <textarea name="introduction" id="introduction" rows="5"
                                        class="form-control">{{ old('introduction', $artist->introduction) }}</textarea>
                                </div>
                            </form>
                        </figcaption>
                    </div>
                </div>
            </figure>
        </div>
        <div class="d-grid gap-3 col-6 mx-auto">
            <input type="submit" value="更新" form="form1" class="btn btn-success btn-lg">
            <a href="{{ route('artists.show', $artist) }}" class="btn btn-secondary btn-lg">戻る</a>
        </div>
        <form action="{{ route('members.store') }}" method="post" id="form2">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">メンバー追加</label>
                <input type="text" name="name" id="name" class="form-control">
                <input type="submit" value="追加" form="form2" class="btn btn-success btn-lg">
            </div>
        </form>
        {{-- <div class="d-grid col-6 mx-auto gap-3">
            <input type="submit" value="アーティスト登録をやめる" form="form" class="btn btn-danger btn-lg"
                onclick="if (!confirm('本当にやめますか？')) {return false};">
        </div> --}}
</x-app-layout>
