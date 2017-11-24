<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<title>Course <!-- todo pull Course name from DB --></title>

<style>

#header{
    text-align: center;
    color: black;
}



</style>


@include('inc.course.banner2')
<h1 id="header">Course name <!--  //TODO course name from DB  --></h1>
<h4 id="header">Course description <!-- //TODO Description from DB  --> </h4>

<div class="container">
    <div class="well">

        @include('inc.specific-course.Videopreview')


    </div>
</div>
