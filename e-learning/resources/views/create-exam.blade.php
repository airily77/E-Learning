<!-- Extends HTML structure from layouts/app.blade -->
@extends('layouts.app')
<title>Exam creation page</title>
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
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-9" id="center">
        <h1>Create a Exam</h1>
        <form action="{{route('create-exam-post')}}" method="post">
            <h3>Title</h3>
            <input type="text" placeholder="Enter the title" name="title">
            <h3>Course name</h3>
            <input type="text" placeholder="Enter the courses name" name="course">

            <h3>Questions</h3>
            <div id="questions">
                <input type="text" placeholder="Enter the question here" name="question0">
                <input type="text" placeholder="Enter the question here" name="question1">
                <input type="text" placeholder="Enter the question here" name="question2">
            </div>
            <button type="button" onclick="createQuestion()">+</button>
            <div id="options">
                <script>
                    var parent = document.getElementById('options');
                    var questions = document.getElementById('questions');
                    var count = questions.childElementCount;
                    for (var i = 0; i < count; i++) {
                        createOptionsForQuestion(i + 1, parent);
                    }

                    function createOptionsForQuestion(questionnumber, parent) {
                        var optiondiv = document.createElement('div');
                        optiondiv.setAttribute('name', 'options'+questionnumber);
                        optiondiv.setAttribute('id', questionnumber);
                        var h3 = document.createElement('h3');
                        h3.innerHTML = "Options for question " + questionnumber;
                        optiondiv.appendChild(h3);
                        for (var i = 0; i < 4; i++) {
                            createOption(optiondiv,i,questionnumber)
                        }
                        parent.appendChild(optiondiv);
                        var addoptionbutton = document.createElement('button');
                        addoptionbutton.setAttribute('type','button');
                        console.log("questionumber"+questionnumber);
                        addoptionbutton.setAttribute('onclick','createOption(document.getElementById('+questionnumber+'))');
                        addoptionbutton.innerHTML = "+";
                        optiondiv.appendChild(document.createElement('br'));
                        parent.appendChild(addoptionbutton);
                    }
                    function createOption(optiondiv){
                        console.log('create');
                        var optionnumber = findOptionNumber(optiondiv);
                        var questionnumber = optiondiv.getAttribute('id').replace( /^\D+/g, '');
                        console.log("optiondiv length " + optiondiv.childNodes.length);
                        console.log('option div '+ optiondiv);
                        console.log(optionnumber);
                        if(optionnumber == null){
                            var option = document.createElement('input');
                            option.setAttribute('placeholder', 'Enter the option here here');
                            option.setAttribute('type', 'text');
                            option.setAttribute('name', 'option'+0+'question'+questionnumber);
                            optiondiv.appendChild(option);
                        }else{
                            var option = document.createElement('input');
                            option.setAttribute('placeholder', 'Enter the option here here');
                            option.setAttribute('type', 'text');
                            option.setAttribute('name', 'option'+optionnumber+'question'+questionnumber);
                            optiondiv.appendChild(option);
                        }
                    }
                    function findOptionNumber(optiondiv){
                        for(var i = optiondiv.childNodes.length-1; i > 0;i--){
                            const lastelement = optiondiv.childNodes.item(i);
                            if(lastelement.nodeName=="INPUT"){
                                return parseInt(lastelement.getAttribute('name').match(/\d+/)[0])+1;
                            }
                        }
                    }
                </script>
            </div>
            <br></br>
            <button type="submit" id="submit">Submit</button>
        </form>
        <script>
            function createQuestion() {
                var questionnumber = findQuestionNumber();
                console.log('questionnumber ='+questionnumber);
                var parent = document.getElementById('questions');
                var question = document.createElement('input');
                question.setAttribute('placeholder', 'Enter the question here');
                question.setAttribute('type', 'text');
                question.setAttribute('name', 'question'+questionnumber);
                parent.appendChild(question);
                var count = parent.childElementCount;
                createOptionsForQuestion(count,document.getElementById('options'));
            }
            function findQuestionNumber(){
                var questions = document.getElementById('questions');
                var length = questions.childNodes.length-1;
                for(var i = length;i>0;i--){
                    var lastelement = questions.childNodes.item(i);
                    if(lastelement.nodeName=="INPUT"){
                        return parseInt(lastelement.getAttribute('name').match(/\d+/)[0])+1;
                    }
                }
            }
        </script>
    </div>
</div>