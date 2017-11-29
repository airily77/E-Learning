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

<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
