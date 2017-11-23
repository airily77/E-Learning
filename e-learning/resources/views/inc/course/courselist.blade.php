<style>
    .container {
         padding: 15px;
     }

    #passed{

    }

    #name:hover{
        text-decoration: underline;
        cursor: hand;
    }


</style>

<div id="left">


    <div class="col-md-10 col-lg-8">
        @foreach($coursedata as $coursedatum)
            <div class="well">
                <div id="name">{{\database\connectors\CourseData::getClass($coursedatum->class_id)->classname}}</div>
                <div id="passed">
                    @foreach($usercoursedata as $usercoursedatum)
                        @if($usercoursedatum->course_id==$coursedatum->courseid && $usercoursedatum->status==1)
                            @include('inc.course.passed')
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach

    </div>
</div>


<div id="right">
    <div class="col-md-2 col-lg-5">
    </div>
</div>

