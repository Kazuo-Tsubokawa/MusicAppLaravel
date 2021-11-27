<x-app-layout>
    @section('title', '編集画面')
    {{-- @include('partial.flash') --}}
    {{-- @include('partial.errors') --}}
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto px-8 bg-gray-400 shadow-md rounded-md">
        <h2 class="text-center text-3xl text-white font-bold pt-6 tracking-widest mb-4">曲の情報編集</h2>
        <form action="{{ route('songs.update', $song) }}" method="post" enctype="multipart/form-data"
            class="rounded pt-3 pb-8 mb-4">
            @csrf
            @method('patch')
            <div class="mb-4">
                <label class="block text-white mb-2" for="title">
                    曲名
                </label>
                <input type="text" name="title"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3"
                    value="{{ old('title', $song->title) }}">
            </div>

            <div class="mb-4">
                <label class="block text-white mb-2" for="image">ジャケット写真を選択してください</label>
                <input type="file" name="image">
            </div>

            <div class="mb-4">
                <label class="block text-white mb-2" for="category">ジャンル</label>
                <select name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if (old('category') == $category->id) selected  @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-white mb-2" for="description">説明</label>
                <textarea class="w-full" name="description"
                    rows="5">{{ old('description', $song->description) }}</textarea>
            </div>

            <input type="submit" value="更新"
                class="bg-yellow-300 hover:bg-yellow-500 text-white font-bold py-2 px-4 mr-3 rounded text-center">
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mr-3 rounded text-center">
                <a href="{{ route('songs.show', $song) }}">戻る</a>
            </button>
        </form>
    </div>
</x-app-layout>
