<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Code Challenge</title>
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: sans-serif;
            height: 100vh;
            margin: 50px;
        }

        .full-height {
            height: 100vh;
        }

        .result {
        }
    </style>
</head>
<body>
<div class="full-height">
    <div class="result">
        Your Search Term Was: <b>{{$searchTerm}}</b>
    </div>

    {!! Form::open(array('url' => 'searchSpotify', 'method' => 'POST', 'id' => 'form')) !!}
    {!! Form::token() !!}
    {!! Form::hidden('access_token', null, array('id' => 'token')) !!}
    {!! Form::hidden('query', $searchTerm) !!}
    {!! Form::close() !!}
</div>
<script>
    let form = document.getElementById('form');

    // This challenge had 'no ajax' requirement. Spotify returns access_tokens
    // via a hash segment of a redirect url - which can not be consumed by PHP server-side
    // this is a workaround however with more creative control I would have used ajax to make the
    // authenticating request.

    if (window.location.hash.length > 0) {
        let access_token = window.location.hash.slice(1).substr(13);
        access_token = access_token.substr(0, access_token.indexOf('&'));
        document.getElementById('token').value = access_token;
        form.submit();
    } else {
        let form = document.getElementById('form');
        form.parentNode.removeChild(form);
    }
</script>
</body>
</html>
