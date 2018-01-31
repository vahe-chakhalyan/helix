<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{

    protected $records_per_page = 10;
    protected $images_path = 'news_images';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $articles = Article::orderBy('date', 'desc')->paginate($this->records_per_page);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date_format:"Y-m-d H:i:s"',
            'image' => 'required|image',
            'url' => 'required|url',
        ];

        $request->validate($rules);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $filename = Article::store_image($request->file('image'));
            $data['image_url'] = env('APP_URL') . '/' . $this->images_path . '/' . $filename;
        }

        Article::create($data);
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date_format:"Y-m-d H:i:s"',
            'url' => 'required|url',
        ];

        if ($request->has('image')) {
            $rules['image'] = 'image';
        }
        $request->validate($rules);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $article->remove_image();
            $filename = Article::store_image($request->file('image'));

            $article->image_url = env('APP_URL') . '/' . $this->images_path . '/' . $filename;
        }

        $article->title = $data['title'];
        $article->description = $data['description'];
        $article->date = $data['date'];
        $article->url = $data['url'];

        $article->saveOrFail();
        return redirect()->route('articles.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::findOrFail($id)->delete();
        return redirect()->route('articles.index');
    }
}
