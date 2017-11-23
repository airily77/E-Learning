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
    .radio-option{

    }

</style>


<title>Quiz</title>
@include('inc.course.banner2')

<div class="container">
    <h1 id="header">Course name</h1>
    <div id="cont" class="container">
       
        <form action="" id="singleanswer">
        <h4><strong>Where is Finland located?</strong></h4>
            <li><input type="radio" name="answer" value="Answer1"> North America</li> <br>
            <li><input type="radio" name="answer" value="Answer2"> Asia</li> <br>
            <li><input type="radio" name="answer" value="Answer3"> Antarctica</li> <br>
            <li><input type="radio" name="answer" value="Answer4"> Europe</li> <br>
        </form>

        <form action="" id="multianswer">
            <h4><strong>Which of these are Chinese cities?</strong></h4>
            <input type="radio" name="answer0" value="Answer1"> Helsinki <br>
            <input type="radio" name="answer1" value="Answer2"> Shanghai <br>
            <input type="radio" name="answer2" value="Answer3"> Stockholm <br>
            <input type="radio" name="answer3" value="Answer4"> Suzhou <br>
            
            
        </form>



    </div>



</div>

