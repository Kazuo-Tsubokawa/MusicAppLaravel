<x-app-layout>
    @section('title', '新規登録')
    {{-- @include('partial.flash') --}}
    {{-- @include('partial.errors') --}}
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-5 px-8 bg-gray-400 shadow-md rounded-md">
        <h2 class="text-center text-3xl text-white font-bold pt-6 tracking-widest mb-4">アーティスト情報の登録</h2>
        <form action="{{ route('artists.store') }}" method="post" enctype="multipart/form-data">
            <div class="card mb-3">
                @csrf
                <div class="mb-4">
                    <label class="block text-white mb-2" for="image">写真を選択してください</label>
                    <input type="file" name="image">
                </div>

                <div class="mb-3">
                    <label class="block text-white mb-2" for="name">アーティスト名</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="block text-white mb-2" for="prefecture">活動地域</label>
                    <select name="prefecture_id">
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}" @if (old('prefecture') == $prefecture->id) selected  @endif>
                                {{ $prefecture->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="block text-white mb-2" for="introduction">自己紹介</label>
                    <textarea class="w-full" name="introduction" rows="5" required
                        placeholder="自己紹介を入力してください"></textarea>
                </div>
                <input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            </div>
        </form>
    </div>
</x-app-layout>
