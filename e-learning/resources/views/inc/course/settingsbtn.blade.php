<style>
    #row1 {
        margin-top: 0px;
        border-top-right-radius: 10px;

    }

    #row2{

        margin-top: -11px;

    }

    #row1, #row2{
        border-top: 1px solid black;
        border-right: 1px solid black;
        background-color: gainsboro;
        margin-left: -15px;
        padding: 10px;

    }

    #row2 {
        border-bottom: 1px solid black;
        border-bottom-right-radius: 10px;
    }

    #row1:hover, #row2:hover{
        background-color: grey;
        cursor: hand;
    }

    .col-lg-2 {
        color: black;
    }
</style>
<div class="col-lg-2">
    <div><h3 onclick="window.location='{{route('user-information')}}'" id="row1">Information</h3></div>
    <div><h3 onclick="window.location='{{route('user-changepassword')}}'" id="row2">Change Password</h3></div>
</div><br>

