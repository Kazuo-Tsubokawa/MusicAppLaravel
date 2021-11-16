<x-app-layout>
    {{-- @extends('layouts.main') --}}
    @section('title', '編集画面')
    {{-- @section('content') --}}
    @include('partial.flash')
    @include('partial.errors')
    <h1>曲の編集</h1>
    <section>
        <div class="card shadow">
            <figure class="m-3">
                <div class="row">
                    <div class="col-6">
                        <figcaption>
                            <form action="{{ route('songs.update', $song) }}" method="post" id="form"
                                enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="mb-3">
                                    <label for="title" class="form-label">曲名</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        value="{{ old('title', $song->title) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">ジャケット写真を選択してください</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="category">ジャンル</label>
                                    <select name="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if (old('category') == $category->id) selected  @endif>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">曲の説明を入力してください</label>
                                    <textarea name="description" id="description" rows="5"
                                        class="form-control">{{ old('description', $song->description) }}</textarea>
                                </div>
                            </form>
                        </figcaption>
                    </div>
                </div>
            </figure>
        </div>
        <div class="d-grid gap-3 col-6 mx-auto">
            <input type="submit" value="更新" form="form" class="btn btn-success btn-lg">
            <a href="{{ route('songs.show', $song) }}" class="btn btn-secondary btn-lg">戻る</a>
        </div>
        {{-- </section> --}}
        {{-- @endsection --}}
</x-app-layout>
