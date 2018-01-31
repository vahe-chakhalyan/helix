@extends('layouts.sole')

@section('content')

    <div class="container" style="margin-top: 90px">
        <div class="row">
            <div class="col-xs-12">
                <h1>
                    {{ $article->title }}
                    <button type="button" class="btn btn-danger btn-sm delete-article"
                            data-article-id="{{ $article->id }}">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                    <a href="/articles/{{$article->id}}/edit" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12" style="float: left">
                <img src="{{ $article->image_url }}"
                     style="float: left; margin: 0 14px 7px 0;">
                <p style="font-size: 10px">
                    {{ $article->date }}
                </p>

                <p>
                    {{ $article->description }}
                </p>
            </div>

            <div class="col-xs-12">
                <a target="_blank" href="{{ $article->url }}">Original source</a>
            </div>
        </div>
    </div>
    <form action="" method="post" id="article_delete_form">
        {{csrf_field()}}
        {{ method_field('DELETE') }}
    </form>

@endsection