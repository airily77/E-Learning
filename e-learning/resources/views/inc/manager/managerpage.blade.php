<style>

    input[type=text], input[type=password] {

        width: 200px;
        padding: 1px 10px;
        margin: 8px 0;
        font: normal 80%/100% 'Verdana';
    }

    button {
        background-color: #6b9dbb;
        color: white;
        padding: 5px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 30%;
    }
    button:hover {
        background: #2b2b2b;
    }
    .container {
        padding: 5px;
    }
   



</style>


<div class="well" id="well">
    <div class="row">



        <div class="col-lg-10">
            <button onclick="window.location='{{route('register-view')}}'">Create a user</button>
            <button onclick="window.location='{{route('coursecreation')}}'">Create a course</button>
            <button onclick="window.location='{{route('examcreation')}}'">Create a exam</button>
            <button onclick="window.location='{{route('newspage')}}'">Create a news article</button>
        </div>
    </div>
</div>