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
    <div class="col-lg-10 col-md-10">
        <div class="well">
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ImageName</th>
                        <th>ImageType</th>
                        <th>ImageSize</th>
                        <th>Title</th>
                        <th>Isshow</th>
                        <th>CreationTime</th>
                        <th>UpdateTime</th>
                        <td><button onclick="window.location='{{route('create-image-view')}}'">Add</button></td>
                    </tr>
                </thead>
                @foreach($images as $image)
                        <tfoot>
                            <tr>
                                <form action="{{route('remove-image')}}" method="post">
                                    <input type="hidden" name="title" value="{{$image->title}}">
                                    @foreach($image as $piece)
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
