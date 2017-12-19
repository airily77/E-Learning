<style>
    .container {
        padding: 15px;
    }

    #well {
        height: 50px;
        width: 170px;
    }

    .title {
        color: black;
        margin: -16px -10px;
    }

    .title:hover {
        text-decoration: underline;
        cursor: hand;
    }
    clickable{
        color:black;
    }
    img {
        float: right;
    }
</style>

<div id="left">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <div class="col-md-1 col-lg-3">
        @for($i = 0; $i<sizeof($coursedata);$i++)
            @php $coursedatum = $coursedata[$i]@endphp
            <div class="well" id="well">
                <h4>
                    <div class="title" id="{{$coursedatum->title}}">
                        {{\database\connectors\CourseData::getClass($coursedatum->class_id)->classname}}</div>
                </h4>
            </div>
        @endfor
    </div>
</div>


<meta id="token" name="token" content="{ { csrf_token() } }">
@for($i = 0; $i < sizeof($coursedata);$i++)
    <div id="more-info"></div>
@endfor
<script>
    $(document).ready(function () {
        $('.title').on('click', function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var data_id = this.getAttribute('id');
            console.log(data_id);
            $.ajax({
                url: 'course/content/' + data_id,
                type: 'POST',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                },
                data: {_token: '{{csrf_token()}}', id: data_id},
                success: function (data) {
                    $('#more-info').html(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    alert(errorThrown);
                }
            });
        });
    });
</script>

<!-- include('specific-course',['exams'=>$specific[0]['exams'],'coursedata'=>$specific[0]['coursedata'],'userexamresults'=>$specific[0]['userexamresults']]) --!>