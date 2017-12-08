<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<title>Exam creation page</title>
@include('inc.manager.banner')
<style>
    input[type=text]{
        width: 70%;
        padding: 1px 10px;
        margin: 8px 0;
        font: normal 80%/100% 'Verdana';
    }
    #center{
        align-content: center;
    }
    button {
        background-color: #6b9dbb;
        color: white;
        padding: 5px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 4%;
    }
    button:hover {
        background: #2b2b2b;
    }
</style>
<div class="row" >
    <div class="col-sm-3"></div>
    <div class="col-sm-9" id="center">
        <h1>Create a Exam</h1>
            <form action="" method="post">
                <h3>Title</h3>
                <input type="text" placeholder="Enter the title" name="title">
                <h3>Course name</h3>
                <input type="text" placeholder="Enter the courses name" name="course">

                <h3>Questions</h3>
                <div id="questions">
                    @include('inc.manager.exam.question')
                    @include('inc.manager.exam.question')
                    @include('inc.manager.exam.question')
                </div>
                <button type="button" onclick="createQuestion()">+</button>
                <h3>Options</h3>
                <div id="options">
                    @include('inc.manager.exam.option')
                    @include('inc.manager.exam.option')
                    @include('inc.manager.exam.option')
                </div>
            </form>
        <script>
            function createQuestion() {
                var parent = document.getElementById('questions');
                var question = document.createElement('input');
                question.setAttribute('placeholder','Enter the question here');
                question.setAttribute('type','text');
                question.setAttribute('name','question');
                parent.appendChild(question);
            }
        </script>
    </div>
</div>