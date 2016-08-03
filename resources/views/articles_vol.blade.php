<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Articles Vol</title>
</head>
<body>
    <div>
        @foreach($articles_vol as $article)
            {!! Form::open(array('url' => '/detail')) !!}
                <p>{{$article}}</p><br>
                {!! Form::hidden('article', $article) !!}
                {!! Form::submit('Click Me!') !!}
            {!! Form::close() !!}
        @endforeach
    </div>
</body>
</html>