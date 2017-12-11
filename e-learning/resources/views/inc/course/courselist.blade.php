<style>
    .container {
        padding: 15px;
    }

    #well {
        height: 50px;
        width: 200px;
    }

    #name {
        color: black;
        margin: -16px -10px;
    }
    #name:hover {
        text-decoration: underline;
        cursor: hand;
    }
    img{
        float: right;
    }
</style>

<div id="left">


    <div class="col-md-1 col-lg-3">
        @for($i = 0; $i<sizeof($coursedata);$i++)
            @php $coursedatum = $coursedata[$i]@endphp
            <div class="well" id="well">
                <h4>
                    <div id="name" for="course">
                        {{\database\connectors\CourseData::getClass($coursedatum->class_id)->classname}}</div>
                </h4>
                <div id="passed">
                   <!-- @foreach($usercoursedata as $usercoursedatum)

                        @if($usercoursedatum->course_id==$coursedatum->courseid && $usercoursedatum->status==1)
                            @include('inc.course.passed')
                        @elseif($usercoursedatum->course_id==$coursedatum->courseid && $usercoursedatum->status==0)
                            @include('inc.course.progress')
                                    <img src="{{$coursedatum->videoimg}}" alt="NO PHOTO" width="auto" height="35px">
                        @endif
                    @endforeach -->

                </div>
            </div>
        @endfor 
            <script type="text/javascript">
            </script>
    </div>
</div>
<!-- include('specific-course',['exams'=>$specific[0]['exams'],'coursedata'=>$specific[0]['coursedata'],'userexamresults'=>$specific[0]['userexamresults']]) --!>