<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<title>Course creation page</title>
@include('inc.manager.banner')
<style>
    input[type=text]{
        width: 70%;
        padding: 1px 10px;
        margin: 8px 0;
        font: normal 80%/100% 'Verdana';
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
        width: 4%;
    }
    button:hover {
        background: #2b2b2b;
    }
</style>
<div class="row" >
    <div class="col-sm-3"></div>
    <div class="col-sm-9" id="center">
        <h1>Create a Course</h1>
            <form action="{{route('create-course-post')}}" method="post">
                <h3>Title</h3>
                <input type="text" placeholder="Enter the title (Courses name)" name="title" required>
                <h3>Class name</h3>
                <input type="text" placeholder="Enter the courses class" name="class" required>
                <h3>Description</h3>
                <input type="text" placeholder="Enter the courses description" name="description" required>
                <h3>Video Imgage</h3>
                <input type="text" placeholder="Enter the video image" name="videoimg" required>
                <h3>Video Path</h3>
                <input type="text" placeholder="Enter the path to the video" name="videopath" required>
                <h3>Video Time</h3>
                <input type="text" placeholder="Enter the video time" name="videotime" required>
                <h3>Show Image</h3>
                <input type="text" placeholder="Enter show image" name="showimg" required>
                <h3>Is Testing</h3>
                <input type="text" placeholder="Enter 1 if testing exists,0 if testing doesn't exist" name="istesting" required>
                <h3>Is Show</h3>
                <input type="text" placeholder="Enter the courses name" name="isshow" required>
                <button type="submit">Submit</button>
            </form>
    </div>
</div>