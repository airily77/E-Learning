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
    <div><h3 onclick="window.location='{{route('user-information')}}'" id="row1">Information</h3></div>
    <div><h3 onclick="window.location='{{route('user-changepassword')}}'" id="row1">Change Password</h3></div>
</div><br>

