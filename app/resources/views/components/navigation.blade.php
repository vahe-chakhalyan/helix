<nav class="navbar navbar-inverse navbar-fixed-top1">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Tert.am Clone</a>
        </div>

        @if(Route::getCurrentRoute()->getAction()['as'] == 'articles.index')
            <ul class="nav navbar-nav navbar-right nav-btn">
                <a href="{{ route('articles.create') }}" class="btn btn-success">
                    <i class="glyphicon glyphicon-plus"></i> Create New Article
                </a>
            </ul>
        @elseif(Route::getCurrentRoute()->getAction()['as'] == 'articles.edit')
            <ul class="nav navbar-nav navbar-right nav-btn">
                <buton class="btn btn-danger delete-article" data-article-id="{{ $article->id }}">
                    <i class="glyphicon glyphicon-trash"></i> Delete Article
                </buton>
            </ul>
        @elseif(Route::getCurrentRoute()->getAction()['as'] == 'articles.show')
            <ul class="nav navbar-nav navbar-right nav-btn">
                <a href="{{ $article->id }}/edit" class="btn btn-success">
                    <i class="glyphicon glyphicon-pencil"></i> Edit Article
                </a>
            </ul>

            <ul class="nav navbar-nav navbar-right  nav-btn">
                <buton class="btn btn-danger delete-article" data-article-id="{{ $article->id }}">
                    <i class="glyphicon glyphicon-trash"></i> Delete Article
                </buton>
            </ul>
        @endif
    </div>
</nav>