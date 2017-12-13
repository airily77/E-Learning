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

        color:Black;

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
                        <th>Description</th>
                        <th>Videopath</th>
                        <th>Videoimg</th>
                        <th>Videotime</th>
                        <th>Showimg</th>
                        <th>Learnnum</th>
                        <th>Viewnum</th>
                        <th>IsTesting</th>
                        <th>IsShow</th>
                        <th>Creationtime</th>
                        <th>UpdateTime</th>
                        <th>Class</th>
                        <td><button onclick="window.location='{{route('coursecreation')}}'">Add</button></td>
                    </tr>
                </thead>
                @foreach($courses as $course)
                        <tfoot>
                            <tr>
                                <form action="{{route('remove-course')}}" method="post">
                                    <input type="hidden" id="title" name="title" value= "{{$course->title}}">
                                    @foreach($course as $piece)
                                        @if(empty($piece))
                                            <th>Null</th>
                                        @else
                                            <th>{{$piece}}</th>
                                        @endif
                                    @endforeach
                                    <td><button type="submit">Remove</button></td>
                                </form>
                            </tr>
                        </tfoot>
                @endforeach
            </table>
            </div>
        </div>
    </div>
</div>
