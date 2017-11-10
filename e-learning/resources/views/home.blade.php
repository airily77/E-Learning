<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')


    <title>Home</title>
    @include('inc.banner')

        <div class="container">

        <div class="row">
            <div class="col-md-8 col-lg-8">
                @include('inc.imageSlide')


            </div>

            <div class="col-md-4 col-lg-4">
                @include('inc.login')

            </div>
    </div>
           <div/>