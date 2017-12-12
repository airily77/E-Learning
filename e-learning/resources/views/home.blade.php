<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<title>Home</title>
@include('inc.home.banner')


<div class="container">
            <div class="col-md-8 col-lg-8">
                @include('inc.home.imageSlide')
                @include('inc.home.news')
            </div>
            <div class="col-md-1 col-lg-4">
                @if(auth()->guard('managers')->check())
                    @include('inc.home.loggedmanager')
                @elseif (auth()->guard('users')->check())
                    @include('inc.home.logged')
                @elseif (!auth()->guard('users')->check())
                    @include('inc.home.login')
                @endif
                @include('inc.home.popup')
            </div>
</div>
<script>
</script>