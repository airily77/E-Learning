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
    <div class="col-lg-10 col-md-10">
        <div class="well">
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Account</th>
                    <th>Username</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Lastloginip</th>
                    <th>Loginnum</th>
                    <th>create time</th>
                    <th>update time</th>
                    <td>
                        <button onclick="window.location='{{route('register-view')}}'">Add</button>
                    </td>
                </tr>
                </thead>
                @foreach($users as $user)
                    <tfoot>
                    <tr>
                        @foreach($user as $piece)
                            @if(empty($piece))
                                <th>Null</th>
                            @else
                                <th>{{$piece}}</th>
                            @endif
                        @endforeach
                        <form action="{{route('remove-user')}}" method="post">
                            <input type="hidden" id="account" name="account" value="{{$user->account}}">
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
