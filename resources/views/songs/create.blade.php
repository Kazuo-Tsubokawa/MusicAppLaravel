<x-app-layout>
    @section('title', '新規登録')
    {{-- @include('partial.flash') --}}
    {{-- @include('partial.errors') --}}
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-5 px-8 bg-gray-400 shadow-md rounded-md">
        <h2 class="text-center text-3xl text-white font-bold pt-6 tracking-widest mb-4">新曲登録</h2>

        <form action="{{ route('songs.store') }}" method="post" enctype="multipart/form-data"
            class="rounded pt-3 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-white mb-2" for="title">
                    曲名
                </label>
                <input type="text" name="title"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3"
                    required placeholder="曲名" value="{{ old('title') }}">
            </div>

            <div class="mb-4">
                <label class="block text-white mb-2" for="image">ジャケット写真を選択してください</label>
                <input type="file" name="image">
            </div>

            <div class="mb-4">
                <label class="block text-white mb-2" for="file">音声ファイルを選択してください</label>
                <input type="file" name="file">
            </div>

            <div class="mb-4">
                <label class="block text-white mb-2" for="category">ジャンル</label>
                <select name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if (old('category') == $category->id) selected  @endif>{{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-white mb-2" for="description">説明</label>
                <textarea class="w-full" name="description" rows="5" required placeholder="曲の説明を入力してください"></textarea>
            </div>

            <input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        </form>
    </div>
</x-app-layout>
