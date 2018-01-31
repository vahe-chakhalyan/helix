<!doctype html>
<html lang="hy">
<head>
    <title>Tert.am Clone</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>.
    <link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css">

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top ">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Tert.am Clone</a>
        </div>

        <ul class="nav navbar-nav navbar-right" style="margin-right: 0;padding: 15px 15px;">
            <a href="{{ route('articles.create') }}" class="btn btn-success" style="">
                <i class="glyphicon glyphicon-plus"></i> Create New Article
            </a>
        </ul>
    </div>
</nav>

@yield('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/src/js/bootstrap-datetimepicker.js"></script>
<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>