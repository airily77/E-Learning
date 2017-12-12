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


<h1 id="header">{{$coursedata->title}}</h1>
<h4 id="header">{{$coursedata->description}}</h4>

<div class="container">
<div class="well">
<div class="container">



        <div class="col-lg-3">

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
            @include('inc.home.popup')

        </div>


    <div id="video" class="col-lg-5">
        <h3>Course Video</h3>
        <a onclick="window.location='{{route('video',$coursedata->title)}}'"><div class="link"></div><img src="{{$coursedata->videoimg}}" width="500" height="auto" style="border:3px solid black"></a>


    </div>
    </div>
</div>
</div>