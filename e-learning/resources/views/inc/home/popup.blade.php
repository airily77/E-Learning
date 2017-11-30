<style>

    body {
        background-size: cover;
        height: 100vh;
    }

    h1 {
        text-align: center;
        color: #06D85F;
        margin: 80px 0;
    }



    .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        transition: opacity 200ms;
        visibility: hidden;
        opacity: 0;
    }
    .overlay:target {
        visibility: visible;
        opacity: 1;
    }

    .popup {
        margin: 70px auto;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        width: 30%;
        position: relative;
    }

    .popup h2 {
        margin-top: 0;
        color: #333;
    }
    .popup .close {
        position: absolute;
        top: 20px;
        right: 30px;
        transition: all 200ms;
        font-size: 30px;
        font-weight: bold;
        text-decoration: none;
        color: #333;
    }
    .popup .close:hover {
        color: #06D85F;
    }




</style>



<div id="popup1" class="overlay">
    <div class="popup">
        <h2>Wrong Credentials</h2>
        <a class="close" href="#">&times;</a>

    </div>
</div>

<div id="popup2" class="overlay">
    <div class="popup">
        <h2>Username or Password invalid</h2>
        <a class="close" href="#">&times;</a>

    </div>
</div>

<div id="popup3" class="overlay">
    <div class="popup">
        <h2>Something went wrong</h2>
        <a class="close" href="#">&times;</a>

    </div>
</div>

<div id="popup4" class="overlay">
    <div class="popup">
        <h2>You are not in this course!</h2>
        <a class="close" href="#">&times;</a>

    </div>
</div>

<div id="popup5" class="overlay">
    <div class="popup">
        <h2>You do not have permission to enter this exam</h2>
        <a class="close" href="#">&times;</a>

    </div>
</div>

<div id="popup6" class="overlay">
    <div class="popup">
        <h2>You got 69 points</h2><!--//TODO pistemäärä-->
        <a class="close" href="#">&times;</a>

    </div>
</div>

<div id="popup7" class="overlay">
    <div class="popup">
        <h2>Access denied</h2>
        <a class="close" href="#">&times;</a>

    </div>
</div>
