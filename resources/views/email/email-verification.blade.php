<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Check</title>
</head>
<body>
<div class="container">
    <h3>Hello, {{ $user->name }}</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias, cumque cupiditate dolores eaque, est facere hic illum ipsa labore maiores odio possimus, quia ratione temporibus tenetur unde voluptatem voluptates?</p>
    <a href="{{ route('verify.email',['id'=>$user->id , 'hash'=>$user->email_verification_token ]) }}">Verify Email</a>
</div>
</body>
</html>
