<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<title>Register page</title>
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
        width: 6%;
    }
    button:hover {
        background: #2b2b2b;
    }
</style>
<div class="row" >
    <div class="col-sm-3"></div>
    <div class="col-sm-9" id="center">
        <h1>Create a user</h1>
        <div>
            <form action="{{route('create-user')}} " method="post">
                <h3>User Account Name</h3>
                <input type="text" placeholder="Enter the User Account Name" name="account" id='account'>
                <h3>User Name</h3>
                <input type="text" placeholder="Enter the User Name" name="username" id="username">
                <h3>Password</h3>
                <input type="password" placeholder="Enter the Users Password" name="password" id="password">
                <h3>Password again</h3>
                <input type="password" placeholder="Enter the Users Password again" name="password2" id="password2">
                <h3>Department</h3>
                <input type="text" placeholder="Enter the Department" name="department" id="department">
                <h3>Position</h3>
                <input type="text" placeholder="Enter the Position" name="position" id="position">
                <h3>Status</h3>
                <input type="text" placeholder="Enter the Status (Number)" name="status" id="status">
                <br>
                <a href="{{session()->previousUrl()}}">Back</a>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>