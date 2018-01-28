<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'id', 'title', 'description', 'image_url', 'url', 'date'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function remove_image()
    {
        $image_url =$this->image_url;

        if (\File::exists($image_url)) {
            \File::delete($image_url);
        }

    }

    public static function store_image($image)
    {
        $ext = $image->extension();
        $filename = uniqid() . '.' . $ext;
        request()->file('image')->move(public_path('news_images'), $filename);
        
        return $filename;
    }
}
