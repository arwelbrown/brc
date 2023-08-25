@extends('layouts.app')
@section('content')
<section class="team-clean" style="background: rgb(18,21,24);">
    <div class="container text-center">
        <img class="img-fluid" src="{{ url('img/br_admin/hexa_final_1.webp') }}" width="25%|" style="margin-top: 50px;" alt="brc hex">
        <h1 style="text-align: center;color: rgb(255,255,255);margin-top: 20px;margin-bottom: 20px;font-family: Anton, sans-serif;letter-spacing: 3px;">
            <strong>ABOUT US!</strong>
        </h1>
        <p class="text-start" style="font-family: 'Open Sans', sans-serif;color: rgb(210,214,217);">
            <span style="color: rgb(125, 130, 133); background-color: transparent;">
                At the dawn of a new era for indie comic book creators, Broken Reality Comics is trying to
                revolutionize how things are done. We started simple with digital comics and will soon be progressing
                to physical comics that will be available on-demand. We house everything from comics to manga and
                interconnected stories to solo events. We’re here to show the world what our community is capable of
                and have some fun while we do it. Admittedly, what we have isn’t perfect and there will always be
                obstacles in our way, but with thirteen different creators (and growing) from around the world spanning
                the Americas, the United Kingdom, and even Australia, the one thing they all believe in is this:
            </span>
        </p>
        <p class="text-start" style="font-family: 'Open Sans', sans-serif;">
            While you put in all the hard work it takes to write, draw, and advertise your books. We will do what we
            can to help build a creative community and online marketplace for comics that has but one purpose: to put
            the money back into the hands of the creators, where it belongs. So if you’re an indie comic publisher that
            wants to sell your books, or just a freelance creator that's looking for a publisher to sign on with, we’ll
            do what we can to help. Your art does not have to be perfect, your story does not have to be flawless,
            you just have to care and put in the work!
        </p>
        <h1 style="text-align: center;color: rgb(255,255,255);margin-top: 60px;letter-spacing: 3px;font-family: Anton, sans-serif;">
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

