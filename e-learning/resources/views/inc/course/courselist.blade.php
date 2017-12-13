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
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <div class="col-md-1 col-lg-3">
        @for($i = 0; $i<sizeof($coursedata);$i++)
            @php $coursedatum = $coursedata[$i]@endphp
            <div class="well"  id="clickable" name="{{$coursedatum->title}}">
                <h4>
                    <div id="{{$coursedatum->title}}">
                        {{\database\connectors\CourseData::getClass($coursedatum->class_id)->classname}}</div>
                </h4>
                <div id="passed">

                </div>
            </div>
        @endfor
    </div>
</div>


<meta id="token" name="token" content="{ { csrf_token() } }">
            <div id="more-info"></div>
            <script>
                $(document).ready(function(){
                    $('#clickable').on('click',function(){
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        var element = document.getElementById('clickable');
                        var data_id = element.getAttribute('name');
                        $.ajax({
                            url: 'course/content',
                            type: 'POST',
                            beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
                            data: {_token:'{{csrf_token()}}',id: data_id},
                            success: function(data){
                                $('#more-info').html(data);
                            },
                            error: function(jqXHR, textStatus, errorThrown){
                                console.log(jqXHR);
                                alert(errorThrown);
                            }
                        });
                    });
                });
            </script>

<!-- include('specific-course',['exams'=>$specific[0]['exams'],'coursedata'=>$specific[0]['coursedata'],'userexamresults'=>$specific[0]['userexamresults']]) --!>