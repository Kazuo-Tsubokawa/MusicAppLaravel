@extends('layouts.main')

@section('title', 'ランダム再生')

@section('content')
    <table>
        <tbody>
            <tr>
                <td>
                    <p>{{ $song->title }}</p>
                    <p>{{ $song->artist->name }}</p>
                </td>
            </tr>
        </tbody>
    </table>
    <a href="{{ route('songs.index') }}">曲送り</a>
@endsection