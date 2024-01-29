@extends('layouts.app')
@section('content')
<section class="team-clean" style="background: rgb(18,21,24);padding-top:30px;">
    <div class="container text-center">
        <h1 style="text-align: center;color: rgb(255,255,255);font-size:50px;letter-spacing: 3px;font-family: Anton, sans-serif;">
            <strong>MEET THE TEAM!</strong>
        </h1>
        @foreach([$founders, $team, $partners, $creators] as $section)
        <div class="row justify-content-center people">
            <h2 class="name text-white mb-0 p-3" style="font-family: 'Open Sans', sans-serif;">
                @if (!empty($section))
                    <strong>
                        {{ $section[0]['brc_team_role'] != 'Team' ? strtoupper($section[0]['brc_team_role'] . 's') : strtoupper('BRC ' . $section[0]['brc_team_role']) }}
                    </strong>
                @endif
            </h2>
            @foreach($section as $user)
                <div class="col-6 col-md-6 col-lg-3 item" style="padding-top:10px;">
                    <img class="rounded-circle img-fluid" src="{{ $user['img_string'] }}" alt="{{ explode(' ', $user['name'])[0] }}">
                    <h3 class="name" style="color: rgb(255,255,255);">{{ explode(' ', $user['name'])[0] }}</h3>
                    <p class="title" style="margin-bottom: 0;">{{ $user['position'] }}</p>
                    <p class="description" style="font-family: 'Open Sans', sans-serif;">
                        <span style="background-color: transparent;">{{ $user['bio'] }}</span>
                    </p>
                </div>
            @endforeach
        </div>
        @endforeach
    </div>
</section>
@endsection
