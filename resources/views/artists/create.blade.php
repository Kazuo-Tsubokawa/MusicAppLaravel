<x-app-layout>
    @section('title', '新規登録')
    @include('partial.flash')
    @include('partial.errors')
    <div class="col-8 col-offset-2 mx-auto">
        <h1>アーティスト登録</h1>
        <form action="{{ route('artists.store') }}" method="post" enctype="multipart/form-data">
            <div class="card mb-3">
                @csrf
                <div class="mb-3">
                    <label for="image" class="form-label">写真</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">アーティスト名</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
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
                    <textarea name="introduction" id="introduction" rows="5" class="form-control"></textarea>
                </div>
                <input type="submit">
            </div>
        </form>
    </div>
</x-app-layout>
