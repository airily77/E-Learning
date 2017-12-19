<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
@include('inc.home.popup')
<title>{{$coursedata->title}}</title>

<style>



    #video {
        margin-top: -250px;
        margin-left:  150px;
        text-align: center;


    }

    #header {
        text-align: center;
        color: black;
    }

    #exams:hover {
        text-decoration-line: underline;
    }

    #exams{
        padding-top: 10px;
    }


</style>
<div class="col-lg-9 col-md-6">
    <div class="well">
        <h1 id="header">{{$coursedata->title}}</h1>
        <h4 id="header">{{$coursedata->description}}</h4>


        <div class="container">

            <h3>Course Exams</h3>
            @for($i=0;$i<sizeof($exams);$i++)
                @php $exam = $exams[$i] @endphp
                <div id="exam" onclick="window.location='{{route('exam',[$coursedata->title,$exam->title])}}'">
                    <h4 id="exams">{{($exam->title)}}</h4>
                    @if(empty($userexamresults[$i]))
                        @include('inc.course.dothis')
                    @elseif(($userexamresults[$i]->result)==1)
                        @include('inc.course.passed')
                    @elseif(($userexamresults[$i]->result)==0)
                        @include('inc.course.failed')
                    @endif
                </div>
            @endfor


        </div>


        <div id="video">
            <h3>Course Video</h3>

            <video id="my-video" class="video-js" controls preload="auto" width="500" height="auto" poster="{{$imagepath}}" data-setup="{}">
                <source src="{{$videopath}}" type='video/mp4'>
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a web browser that
                    <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                </p>
            </video>

        </div>
    </div>
</div>
