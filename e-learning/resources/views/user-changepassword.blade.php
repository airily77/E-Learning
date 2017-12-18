<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<title>User settings</title>
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
@include('inc.course.banner2')
@include('inc.course.settingsbtn')
<div class="row" >
    <div class="col-sm-3"></div>
    <div class="col-sm-9" id="center">
        <h1>Update user information</h1>
        <div>
            <form action="{{route('user-changepassword-post')}}" method="post">
                <h3>Current Password</h3>
                <input type="password" value="" name="currentpw" id="currentpw">
                <h3>New Password</h3>
                <input type="password" value="" name="newpw" id="newpw">
                <h3>New Password Again</h3>
                <input type="password" value="" name="newpw2" id="newpw2">
                <br>
                <a href="{{session()->previousUrl()}}">Back</a>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>