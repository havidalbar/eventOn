<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<form action="{{ route('register') }}" method="POST">
        {{ csrf_field() }}
        <input name="username">
        <input name="email">
        <input name="password">
        <button type="submit">submit</button>
    </form>
</body>
</html>
