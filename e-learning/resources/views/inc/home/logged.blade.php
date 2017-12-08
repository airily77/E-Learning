<style>
    #upper {
        height: 10%;
        width: 100%;
    }
    #name {
        display: flex;
        justify-content: center;
        position: relative;
        bottom: 30px;
        color: black;
    }
    #logoutbt {
        display: flex;
        justify-content: center;
        margin: -86px 254px;
        padding: 20px 0px;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
        border: none;
        color: black;
    }
    button {
        padding: 5px;
        margin: 8px 0;
        cursor: pointer;
        width: 30%;
        background-color: #50b066;
        font-weight: bold;
        align-content: center;
    }
    button:hover, #coursebt:hover {
        background: #2b2b2b;
    }
    #coursebt {
        display: flex;
        justify-content: center;
        margin: 20px 0px;
        border: solid 1px black;
        font-size: larger;
        border-radius: 5px;
        background-color: #4caf50;
        font-weight: bold;
        padding: 40px 174px;
        color: black;
    }
</style>

<div class="well" id="upper">
    <div class="row">
        <div class="col-lg-10">
            <h2 id="name">Welcome, {{auth()->guard('users')->id()}}!</h2>

            <form action="{{route('logout')}}" method="post">
                <button id="logoutbt" type="submit">Logout</button>
            </form>
        </div>
    </div>
</div>
<button id="coursebt" onclick="window.location='{{ route("course") }}'"> Course Center</button>