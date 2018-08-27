@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
             <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>
            </div>
            <br>
           <div class="card">
                <div class="card-body">
                    <a class="btn btn-link" href="/dashboard">Aller au dashboard</a>
                </div>
            </div>
            <br>
             <div class="card">
                <div class="card-header">Spotify setting</div>
                <div class="card-body">
                    <spotify v-bind:credentials="{{ json_encode($spotify) }}"></spotify>
                </div>
            </div>

            <br>
            <div class="card">
                <div class="card-header">Twitch setting</div>
                <div class="card-body">
                    <twitchsetting v-bind:infos="{{ json_encode($twitch) }}"></twitchsetting>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection
