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
</style>
<div class="col-lg-2">
<div><h3 onclick="window.location='{{route('user-panel')}}'" id="row1">User manager</h3></div>
<div><h3 onclick="window.location='{{route('course-panel')}}'"id="row2">Course manager</h3></div>
<div><h3 onclick="window.location='{{route('exam-panel')}}'" id="row3">Exam manager</h3></div>
<div><h3 onclick="window.location='{{route('image-panel')}}'" id="row4">Picture manager</h3></div>
<div><h3 onclick="window.location='{{route('news-panel')}}'"id="row5">News manager</h3></div>
</div><br>

