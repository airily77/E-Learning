<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<title>Management</title>
@include('inc.manager.banner')
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

    .col-lg-10 {

        color: Black;

    }

</style>
@include('inc.manager.managementbuttons')

<div class="container">
    <div class="col-lg-12 col-md-10">
        <div class="well">
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Questions</th>
                    <th>Options</th>
                    <th>CorrectAnswers</th>
                    <th>Creationtime</th>
                    <th>Updatetime</th>
                    <th>Medianscore</th>
                    <th>Donenum</th>
                    <th></th>
                    <td>
                        <button onclick="window.location='{{route('examcreation')}}'">Add</button>
                    </td>
                </tr>
                </thead>
                @foreach($exams as $exam)
                    <tfoot>
                    <tr>
                        @foreach($exam as $piece)
                            @if(empty($piece))
                                <th>Null</th>
                            @else
                                <th>{{$piece}}</th>
                            @endif
                        @endforeach
                            <td><button onclick="window.location='{{route('modify-exam',['title'=>$exam->title])}}'">Modify</button></td>
                        <form action="{{route('remove-exam')}}" method="post">
                            <input type="hidden" id="title" name="title" value="{{$exam->title}}">
                            <td>
                                <button type="submit">Remove</button>
                            </td>
                        </form>
                    </tr>
                    </tfoot>
                @endforeach
            </table>
        </div>
    </div>
</div>
</div>
