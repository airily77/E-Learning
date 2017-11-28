<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')

<style>

    #header{
        text-align: center;
        color: black;
            }

    #cont{
        padding-top: 10%;
        padding-left: 20%;
    }




</style>


<title>Exam</title>
@include('inc.course.banner2')

<div class="container">
    <h1 id="header">{{$examdata->title}}</h1>
    <div id="cont" class="container">
        <form action="{{ route('postExam',['questions'=>$examdata->questions,'examid'=>$examdata->examid,'started'=>$started])}}" method="post" id="answsers" name="anwsers">
            @for($i = 0; $i < sizeof($examdata->questions);$i++)
                <h4><strong>{{$examdata->questions[$i]}}</strong></h4>
                @foreach($examdata->options[$i] as $option)
                    <input type="radio" name={{$i}} value="{{$option}}">{{$option}}<br>
                @endforeach
            @endfor
            <button type="submit">Submit Exam</button> <!--- //TODO create a better looking button here -->
        </form>
    </div>



</div>


<script type="text/javascript">
    var radios = document.getElementsByTagName('input');
    for(i=0; i<radios.length; i++ ) {
        radios[i].onclick = function(e) {
        if(e.ctrlKey) {
            this.checked = false;

        }
    }
<script>

</script>
