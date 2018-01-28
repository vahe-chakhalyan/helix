@extends('layouts.sole')

@section('content')

    <a href="{{ route('articles.create') }}" class="btn btn-success pull-right" style="margin:20px 0;">
        <i class="glyphicon glyphicon-plus"></i> Create New Article
    </a>
    @if(!count($articles))
        <h1 class="text-center">No articles to show</h1>
    @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th class="dont-show">Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Url</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>
                            <div class="glyphicon-bold">
                                {{$article['title']}}
                            </div>
                        </td>
                        <td>
                            <div>
                                {{$article['description']}}
                            </div>
                        </td>
                        <td>
                            <div>
                                {{$article['image_url']}}
                            </div>
                        </td>
                        <td>
                            <div>
                                {{$article['date']}}
                            </div>
                        </td>
                        <td>
                            <div>
                                {{$article['url']}}
                            </div>
                        </td>
                        <td>
                            <span class="btn-group btn-list">
                                <a href="{{ route('articles.show',$article->id) }}"
                                   data-placement="top" title="Show" class="btn btn-info btn-xs">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                </a>
                                <a href="{{ route('articles.edit',$article->id) }}"
                                   data-placement="top" title="Edit" class="btn btn-primary btn-xs">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('articles.destroy',$article->id) }}"
                                      class="form-del-article">
                                    {{csrf_field()}}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-xs  btn-del-article"
                                            data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="glyphicon glyphicon-remove"></i>
                                    </button>
                                </form>
                            </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $articles->links() }}
    @endif

@endsection