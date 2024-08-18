<html>
<body style="text-align: center; padding:10px">
    <h1>{{ $notification['title'] }}</h1>
    <h2>{{ $notification['message'] }}</h2>
    <a style="margin:8px ;padding: 10px;
        background-color: #6ee7b7;
        text-decoration: none;
        font-size: 20px;
        color: black;
        border-radius: 10px;" href="{{ $notification['url'] }}">
        Visualizar
    </a>
</body>

</html>
