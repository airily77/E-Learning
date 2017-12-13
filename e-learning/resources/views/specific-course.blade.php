<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
@include('inc.home.popup')
<title>{{$coursedata->title}}</title>

<style>

    #video {
        float: right;
        margin-top: -250px;
        margin-right: 150px;
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


        <div id="video" class="col-lg-4">
            <h3>Course Video</h3>
            <a onclick="window.location='{{route('video',$coursedata->title)}}'">
                <div class="link"></div>
                <img src="{{$coursedata->videoimg}}" width="300" height="auto" style="border:3px solid black"></a>


        </div>
    </div>
</div>
