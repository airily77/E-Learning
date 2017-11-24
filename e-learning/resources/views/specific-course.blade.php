<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<title>{{$coursedata->title}}</title>
@include('inc.course.banner2')


<div class="container">
    <p>you are in {{$coursedata->title}}</p>
    <!-- //TODO Create a button or a div which you can start your exam from. -->
</div>
