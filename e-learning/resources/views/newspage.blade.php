<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<style>

    #newstitle {
        text-align: center;
        color: black;
    }

    #bt1, #bt2, #toggle {
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

@include('inc.manager.banner')
@include('inc.home.popup')
<div class="container">
    <div class="well">

        <h2 id="newstitle">News Title</h2><!-- /TODO news Title -->

        <p id="paragraph"></p>

        <div id="Finish">

            <button id="bt2" style="position: absolute; right: 10%; top: 22%"> Upload News </button> <!-- //TODO upload content-->  <!-- document.getElementById("paragraph").innerText; -->

        </div>
    </div>

    <button id="toggle" onclick="toggleEditor()" style="position: absolute; right: 10%; top: 27% " >Edit news</button>


    <script>
        function toggleEditor() {
            @if (auth()->guard('managers')->check())
            var x = document.getElementById("richtext");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
            @endif
        }
    </script>

    <div id="richtext" style="display: none">@include('inc.news.richtexteditor')</div>

</div>