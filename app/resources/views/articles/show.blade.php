@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-4"><a href="/articles/{{ $article->id }}" class=""><img
                            src="{{ $article->image_url }}" class="img-responsive"></a>
            </div>
            <div class="col-sm-8">
                <a href="/articles/{{ $article->id }}"><h3 class="title">{{ $article->title }}</h3></a>

                <span class="glyphicon glyphicon-calendar">{{ $article->date }}</span>
                <p>
                    {{ $article->description }}
                </p>
                <p class="text-muted">Original source: <a target="_blank" href="{{ $article->url }}">www.tert.am</a></p>
            </div>
        </div>
    </div>
    <form action="" method="post" id="article_delete_form">
        {{csrf_field()}}
        {{ method_field('DELETE') }}
    </form>

@endsection