<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>{{ $song->title }}</p>
    <p>{{ $song->artist->name }}</p>
    <p><a href="{{ route('songs.index') }}">曲送り</a></p>
</body>
</html>