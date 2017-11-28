<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<title>{{$coursedata->title}}</title>

<style>


    .col-lg-5{
        text-align: center;
        align-content: 
    }


    #header{
    text-align: center;
    color: black;
}

 #exams:hover{
     text-decoration-line: underline;
 }




</style>


@include('inc.course.banner2')
<h1 id="header">{{$coursedata->title}}</h1>
<h4 id="header">{{$coursedata->description}}</h4>

<div class="container">
<div class="well">
<div class="container">



        <div class="col-lg-3">

        <h3>Course Exams</h3>
            @foreach($exams as $exam)
                <div id="exam" onclick="window.location='{{route('exam',[$coursedata->title,$exam->title])}}'">
                    <h4 id="exams">{{($exam->title)}}</h4>
                    @if(($userexamresults)==0)
                        @include('inc.course.progress')
                    @else
                        @include('inc.course.passed')
                    @endif
                </div>
            @endforeach
        </div>


    <div id="video" class="col-lg-5">
        <h3>Course Video</h3>
        <a href="/video"><div class="link"></div><img src="/img/imageSlide_green.jpg" width="500" height="auto" style="border:3px solid black"></a>


    </div>
    </div>
</div>
</div>