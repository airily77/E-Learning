<div id="bt">
    <button id="bt1" onclick="textToDiv()"><div class="arrow-up"></div></button>
</div>



<textarea id="editor" cols="30" rows="100"></textarea>



<script>
    function textToDiv() {
        var x = CKEDITOR.instances.editor.getData();
        document.getElementById("paragraph").innerHTML = x;
    }  </script>






</div>


<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
    CKEDITOR.config.height="1000px";
</script>