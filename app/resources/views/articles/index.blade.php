@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Last News</h1>
            </div>
        </div>
        @if(!count($articles))
            <h1 class="text-center">No articles to show</h1>
        @else
            @foreach($articles as $article)
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

                        <p class="text-muted">Original source: <a target="_blank"
                                                                  href="{{ $article->url }}">www.tert.am</a></p>

                    </div>
                </div>
                <hr>
            @endforeach
    </div>
    <form action="" method="post" id="article_delete_form">
        {{csrf_field()}}
        {{ method_field('DELETE') }}
    </form>
    <div class="col-xs-12 text-center">
        {{ $articles->links() }}
    </div>
    @endif

@endsection