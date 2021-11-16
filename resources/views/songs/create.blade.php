<x-app-layout>
    {{-- @extends('layouts.main') --}}
    @section('title', '新規登録')
    {{-- @section('content') --}}
    @include('partial.flash')
    @include('partial.errors')
    <div class="col-8 col-offset-2 mx-auto">
        <h1>新規登録</h1>
        <form action="{{ route('songs.store') }}" method="post" enctype="multipart/form-data">
            <div class="card mb-3">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">曲名</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">ジャケット写真を選択してください</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">音声ファイルを選択してください</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="category">ジャンル</label>
                    <select name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if (old('category') == $category->id) selected  @endif>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">曲の説明を入力してください</label>
                    <textarea name="description" id="description" rows="5" class="form-control"></textarea>
                </div>
                <input type="submit">
            </div>
        </form>
    </div>
    {{-- @endsection --}}
</x-app-layout>
