<style>
    input[type=text]{
        width: 70%;
        padding: 1px 10px;
        margin: 8px 0;
        font: normal 80%/100% 'Verdana';
    }
    input[type=password]{
        width: 70%;
        padding: 1px 10px;
        margin: 8px 0;
    }
</style>

<div id="usertocourse">
    <h3>Add user to course</h3>
    <form action="{{route('usertocourse')}}" method="post">
        <p>User account</p>
        <input type="text" placeholder="User account" name="account">
        <p>Course title</p>
        <input type="text" placeholder="Course title" name="coursetitle">
        <p>Complition time</p>
        <input type="text" placeholder="Complition time" name="completetime">
        <button type="submit">Submit</button>
    </form>
</div>

