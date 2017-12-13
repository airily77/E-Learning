<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<title>Management</title>
@include('inc.manager.banner')
<style>


    #row1 {
        margin-top: 0px;
        border-top-right-radius: 10px;

    }

    #row2, #row3, #row4, #row5 {

        margin-top: -11px;

    }

    #row1, #row2, #row3, #row4, #row5 {
        border-top: 1px solid black;
        border-right: 1px solid black;
        background-color: gainsboro;
        margin-left: -15px;
        padding: 10px;

    }

    #row5 {
        border-bottom: 1px solid black;
        border-bottom-right-radius: 10px;
    }

    .col-lg-2 {
        color: black;
    }

    .col-lg-10 {

        color:;

    }

</style>
<div class="col-lg-2">


    <div><h3 id="row1">User manager</h3></div>
    <div><h3 id="row2">Course manager</h3></div>
    <div><h3 id="row3">Exam manager</h3></div>
    <div><h3 id="row4">Picture manager</h3></div>
    <div><h3 id="row5">News manager</h3></div>


</div> <br>

<div class="container">
    <div class="col-lg-10 col-md-10">
        <div class="well">
            <h2>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci cum ea eaque eligendi hic, nobis,
                quasi qui quidem quos rem, sunt veniam. Aliquam cupiditate deleniti dicta dolorem ipsam officia
                veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci aliquid aspernatur
                assumenda at blanditiis cupiditate deserunt, dolores ea magnam nobis non, odio quasi, quisquam repellat
                saepe velit veritatis voluptates. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aut
                beatae cum cupiditate delectus deleniti fugiat ipsam itaque iure magni, nesciunt, nobis recusandae sit
                sunt totam velit voluptas voluptate voluptatum?
            </h2>
        </div>
    </div>
</div>
