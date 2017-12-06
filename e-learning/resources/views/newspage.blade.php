<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<style>

    #newstitle {
        text-align: center;
        color: black;
    }

    #bt1, #bt2 {
        background-color: #4caf50;
        border: solid 2px black;
        border-radius: 10px;
        color: black;
        font-weight: bold;
        align-content: center;


    }

    #bt {
        display: flex;
        justify-content: center;
        margin: 2% 0px;

    }

    .arrow-up {
        border-left: 20px solid transparent;
        border-right: 20px solid transparent;
        border-bottom: 40px solid black;
        margin:5px 5px;
    }

</style>

<title>News page</title><!-- //TODO Pull news header from DB-->

@include('inc.course.banner2')
@include('inc.home.popup')
<div class="container">
    <div class="well">

        <h2 id="newstitle">News Title</h2><!-- /TODO news Title -->

        <p id="paragraph"></p>

    </div>


    <div id="bt">
        <button id="bt1" onclick="textToDiv()"><div class="arrow-up"></div></button>
        </div>



    <textarea id="editor" cols="30" rows="100"></textarea>


    <script>
        function textToDiv() {
            var x = CKEDITOR.instances.editor.getData();
            document.getElementById("paragraph").innerHTML = x;
        }  </script>




</div>


<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
    CKEDITOR.config.height="1000px";
</script>