<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<title>Admin Login</title>

<style>



#login{
    width: 300px;
    height: 200px;
    background-color: transparent;
    position: absolute;
    top:0;
    bottom: 0;
    left: 0;
    right: 0;

    margin: auto;
}

</style>
<img src="/img/adminImage.jpg" alt="NO PHOTO" width="100%" height="100%">
<div id="login">

    @include('inc.admin.admin-login')

</div>