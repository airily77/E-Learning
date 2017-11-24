<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<title>{{$coursedata->title}}</title>

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

<div class="container">
    <p>you are in {{$coursedata->title}}</p>
    <!-- //TODO Create a button or a div which you can start your exam from. -->
</div>
