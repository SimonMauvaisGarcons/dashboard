@extends('layouts.app')

@section('content')
<div class="center">
    <a class="btn btn-primary" href="{{ route('spotify.auth.go') }}" >Connect to Spotify</a>
</div>
@endsection
