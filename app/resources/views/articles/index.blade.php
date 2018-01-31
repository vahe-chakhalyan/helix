@extends('layouts.sole')

@section('content')

    @if(!count($articles))
        <h1 class="text-center">No articles to show</h1>
    @else
        <div class="container" style="margin-top: 90px">
            <div class="row">
                <div class="col-xs-12">
                    <h1>Articles</h1>
                </div>
            </div>
            @foreach($articles as $article)
                <div class="row">
                    <div class="col-xs-12" style="float: left; padding: 20px">
                        <a href="/articles/{{ $article->id }}">
                            <img src="{{ $article->image_url }}"
                                 style="float: left; margin: 0 14px 7px 0;"
                                 width="80px" height="80px">
                        </a>
                        <p style="font-size: 10px">
                            {{ $article->date }}
                        </p>
                        <h4><a href="/articles/{{ $article->id }}"> {{ $article->title }}</a>

                            <button type="button" class="btn btn-danger btn-sm delete-article" data-article-id="{{ $article->id }}">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                            <a href="/articles/{{$article->id}}/edit" class="btn btn-primary btn-sm">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                        </h4>

                        <p>
                            <a href="/articles/{{ $article->id }}">
                                @if(strlen($article->description) > 2000)
                                    {{ substr($article->description, 0, 2000) }}...
                                @else
                                    {{ $article->description }}
                                @endif
                            </a>

                        </p>
                        <div>
                            <a target="_blank" href="{{ $article->url }}">Original source</a>
                        </div>
                    </div>
                </div>
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