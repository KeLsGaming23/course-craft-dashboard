<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget Password</title>
</head>
<body>
    Hi<br>
    Change your password <a href="http://localhost:3000/reset/{{$token}}">Click here</a>
    Pin: {{$token}}
</body>
</html>