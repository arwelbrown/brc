@extends('layouts.app')
@section('content')
<section class="team-clean" style="background: rgb(18,21,24);padding-top:30px;">
    <div class="container text-center">
        <h1 style="text-align: center;color: rgb(255,255,255);font-size:50px;letter-spacing: 3px;font-family: Anton, sans-serif;">
            <strong>MEET THE TEAM!</strong>
        </h1>
        <div class="row justify-content-center people">
            @foreach($team as $member)
                <div class="col-6 col-md-6 col-lg-3 item">
                    <img class="rounded-circle img-fluid" src="{{ url($member->img_string) }}" alt="{{ $member->name }}">
                    <h3 class="name" style="color: rgb(255,255,255);">{{ $member->name }}</h3>
                    <p class="title" style="margin-bottom: 0;">{{ $member->role }}</p>
                    <p class="description" style="font-family: 'Open Sans', sans-serif;">
                        <span style="background-color: transparent;">{{ $member->bio }}</span>
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
