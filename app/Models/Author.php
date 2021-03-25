<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class Author extends Model
{
    use HasFactory;
    public static function create($request)
    {
        $author = new self;
        $author->name = $request->author_name;
        $author->surname = $request->author_surname;
        $author->save();
    }


    public function authorBooks()
    {
        return $this->hasMany('App\Models\Book', 'author_id', 'id');
    }
}
