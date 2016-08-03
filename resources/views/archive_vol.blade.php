<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Archive Vol</title>
</head>
<body>
    <div>
        @foreach($archive_vol as $href)
            {!! Form::open(array('url' => '/info')) !!}
                <p>{{$href}}</p><br>
                {!! Form::hidden('link', $href) !!}
                {!! Form::submit('Click Me!') !!}
            {!! Form::close() !!}
        @endforeach
    </div>
</body>
</html>