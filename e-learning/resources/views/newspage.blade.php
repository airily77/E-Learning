<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<style>

    #newstitle {
        text-align: center;
        color: black;
    }

    #bt1, #bt2, #toggle {
        background-color: #4caf50;
        border: solid 2px black;
        border-radius: 10px;
        color: black;
        font-weight: bold;
        align-content: center;


    }

    #bt {
        display: flex;
        justify-content: center;
        margin: 2% 0px;

    }


    .arrow-up {
        border-left: 20px solid transparent;
        border-right: 20px solid transparent;
        border-bottom: 40px solid black;
        margin:5px 5px;
    }

</style>

<title>{{$article->title}}</title><!-- //TODO Pull news header from DB-->

@include('inc.course.banner2')
@include('inc.home.popup')
<div class="container">
    <div class="well">
        <h2 id="newstitle">{{$article->title}}</h2><!-- /TODO news Title -->
        <div id="content">
            {{$article->content}}
        </div>
    </div>
</div>