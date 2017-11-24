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


<title>Quiz</title>
@include('inc.course.banner2')

<div class="container">
    <h1 id="header">Course name</h1>
    <div class="well">
    <div id="cont" class="container">


        <form action="" id="singleanswer">
        <h4><strong>Where is Finland located?</strong></h4>

            <input id="a1" type="radio" name="answer" value="Answer1">
            <label for="a1">North america</label><br>

            <input id="a2" type="radio" name="answer" value="Answer2">
            <label for="a2">Asia</label><br>

            <input id="a3" type="radio" name="answer" value="Answer3">
            <label for="a3">Antarctica</label><br>

            <input id="a4" type="radio" name="answer" value="Answer4">
            <label for="a4">Europe</label><br>

        </form>

        <form action="" id="multianswer">
            <h4><strong>Which of these are Chinese cities?</strong></h4>

            <input id="b1" type="checkbox" name="answer0" value="Answer1">
            <label for="b1">Helsinki</label><br>

            <input id="b2" type="checkbox" name="answer1" value="Answer2">
            <label for="b2">Shanghai</label><br>

            <input id="b3" type="checkbox" name="answer2" value="Answer3">
            <label for="b3">Stockholm</label><br>

            <input id="b4" type="checkbox" name="answer3" value="Answer4">
            <label for="b4">Suzhou</label><br>



        </form>

        </div>

    </div>



</div>

<script>


</script>
