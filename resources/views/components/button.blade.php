
<a class="submit"   href="@yield('route', '#')">@yield('linkValue', 'Default ')</a>

<style>
    .submit{
    padding: 5px;
    border-radius: 5px;
    background-color: #333;
    border: 2px solid #333;
    color: white;
    border-radius:15px;
    width: 300px;
    position: absolute;
    top:115px;
    right:75%;
    cursor: pointer;
    text-align:center;
    text-decoration: none;
    font-size: 18px;
    font-weight: bold;
    }

    .submit:hover{
        background-color: #eee;
        color: #333;
    }
</style>
