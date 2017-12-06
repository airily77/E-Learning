<style>

    #news {
        width: 730px;

    }


    #newsheader{
        margin: auto;
        width: 15%;
    }


    .news:hover {
        text-decoration: underline;
    }



</style>

<div id="news">
    <div class="well">
        <div id="newsheader"><h3>News</h3></div>
        @foreach($news as $new)
            <span class="news">
                <h4>{{$new->title}}</h4>
            </span>
        @endforeach
    </div>
</div>



