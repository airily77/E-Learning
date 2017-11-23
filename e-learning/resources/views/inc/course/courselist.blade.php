<style>
    .container {
         padding: 15px;
     }

    #passed{

    }

    #name:hover{
        text-decoration: underline;
        cursor: hand;
    }


</style>

<div id="left">


    <div class="col-md-10 col-lg-8">


        <div class="well">
            <div id="name"><h3>Math</h3></div>
            <div id="passed">@include('inc.course.passed')</div>
            </div>
        <div class="well">

            <div id="name"><h3>Physics</h3></div>
            <div id="passed">@include('inc.course.passed')</div>

        </div>

        <div class="well">

            <div id="name"><h3>Science</h3></div>
            <div id="passed">@include('inc.course.passed')</div>

        </div>

    </div>
</div>


<div id="right">
    <div class="col-md-2 col-lg-5">
    </div>
</div>

