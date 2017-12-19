<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<title>Article creation page</title>
@include('inc.manager.banner')
<style>
    input[type=text] {
        width: 70%;
        padding: 1px 10px;
        margin: 8px 0;
        font: normal 80%/100% 'Verdana';
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
        width: 4%;
    }
    #submit {
        width: 8%;
    }
    button:hover {
        background: #2b2b2b;
    }
</style>
<div class="container">
    <div class="well">
        <h1>Create a Article</h1>
        <form action="{{route('modify-arc-post')}}" method="post">
            <input hidden value="{{$article->articleid}}" name="articleid">
            <h3>Title</h3>
            <input type="text" value="{{$article->title}}" name="title" required>
            <h3>Content</h3>
            <textarea id="editor" cols="30" rows="100" name="content" required>{{$article->content}}</textarea>
            <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
            <script>
                CKEDITOR.replace('editor');
                CKEDITOR.config.height="1000px";
            </script>
            <h3>Source</h3>
            <input type="text" value="{{$article->source}}" name="source">
            <h3>Keyword</h3>
            <input type="text" value="{{$article->keyword}}" name="keyword" required>
            <h3>Tags</h3>
            <input type="text" value="{{$article->tags}}"name="tags" required>
            <h3>Status</h3>
            <input type="text" value="{{$article->status}}" name="status" required>
            <br>
            <button type="submit" id="submit">Submit</button>
        </form>
    </div>
</div>