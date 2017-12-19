<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<title>Modify User</title>
<style>
    input[type=text] {
        width: 70%;
        padding: 1px 10px;
        margin: 8px 0;
        font: normal 80%/100% 'Verdana';
    }

    input[type=password] {
        width: 70%;
        padding: 1px 10px;
        margin: 8px 0;
    }

    #center {
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
    .removeGroup{
        width: 100%;
    }
</style>
@include('inc.manager.banner')
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-9" id="center">
        <h1>Modify User</h1>
        <div>
            <form action="{{route('modify-user-post')}}" method="post">
                <h3>User Account Name</h3>
                <input type="text" value="{{$user->account}}" name="account" id='account' readonly>
                <h3>User Name</h3>
                <input type="text" placeholder="{{$user->username}}" name="username" id="username">
                <h3>Department</h3>
                <input type="text" placeholder="{{$user->department}}" name="department" id="department">
                <h3>Position</h3>
                <input type="text" placeholder="{{$user->position}}" name="position" id="position">
                <h3>Status</h3>
                <input type="text" placeholder="{{$user->status}}" name="status" id="status">
                <br>
                <a href="{{session()->previousUrl()}}">Back</a>
                <button type="submit">Submit</button>
            </form>
            <h3>Courses {{$user->username}} has attended</h3>
            <table id="example" class="table table-striped table-bordered" style="column-fill: auto" cellspacing="0">
                <thead>
                <tr>
                    <th>Coursetitle</th>
                    <th>Begintime</th>
                    <th>Completetime</th>
                    <th></th>
                </tr>
                </thead>
                @foreach($usercourses as $usercourse)
                    <tbody>
                    <th>{{\database\connectors\CourseData::getCourseTitle($usercourse->course_id)}}</th>
                    <th>{{$usercourse->begintime}}</th>
                    <th>{{$usercourse->completetime}}</th>
                    <form action="{{route('remove-user-course')}}" method="post">
                        <th>
                            <input type="hidden" name="coursetitle" value="{{\database\connectors\CourseData::getCourseTitle($usercourse->course_id)}}">
                            <input type="hidden" name="account" value="{{$user->account}}">
                            <button type="submit" class="removeGroup">Remove from course</button>
                        </th>
                    </form>
                    </tbody>
                @endforeach
            </table>
            <h3>Exams {{$user->username}} has attended</h3>
            <table id="example" class="table table-striped table-bordered" style="column-fill: auto" cellspacing="0">
                <thead>
                <tr>
                    <th>Exam title</th>
                    <th>Course title</th>
                    <th>User Answers</th>
                    <th>Score</th>
                    <th>Started</th>
                    <th>Result</th>
                    <th></th>
                </tr>
                </thead>
                @foreach($userexams as $userexam)
                    <tbody>
                    <th>{{\database\connectors\ExamData::getExam($userexam->exam_id)->title}}</th>
                    <th>{{\database\connectors\ExamData::getCourseByExam($userexam->exam_id)->title}}</th>
                    <th>{{$userexam->useranswers}}</th>
                    <th>{{$userexam->score}}</th>
                    <th>{{$userexam->started}}</th>
                    <th>{{$userexam->result}}</th>
                    <form action="{{route('remove-user-exam')}}" method="post">
                        <th>
                            <input type="hidden" name="examid" value="{{$userexam->exam_id}}">
                            <input type="hidden" name="account" value="{{$user->account}}">
                            <button type="submit" class="removeGroup">Remove user exam result</button>
                        </th>
                    </form>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>