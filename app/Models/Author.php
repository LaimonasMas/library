<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;



class Author extends Model
{
    use HasFactory;
    public static function create(Request $request)
    {
        $author = new self;
        $author->name = $request->author_name;
        $author->surname = $request->author_surname;
        $file = $request->file('author_portret'); //failo aprasas
        if (!empty($file)) {
            $name = rand(100000, 9999999999) . '.' . $file->getClientOriginalExtension(); // random pavadinimas
            $file->move(public_path('img'), $name); // perkeliam is tmp folderio i ten kur reikia
            $author->portret = 'http://localhost/nd/library/public/img/' . $name; // irasome i db + kelias iki paveiksliuko
        }
        $author->save();
    }

    public function edit(Request $request)
    {
        $file = $request->file('author_portret'); //failo aprasas
        if (!empty($file)) {
            $name = rand(100000, 9999999999) . '.' . $file->getClientOriginalExtension(); // random pavadinimas
            $file->move(public_path('img'), $name); // perkeliam is tmp folderio i ten kur reikia
            $this->portret = 'http://localhost/nd/library/public/img/' . $name; // irasome i db + kelias iki paveiksliuko
        }
        $this->name = $request->author_name;
        $this->surname = $request->author_surname;
        $this->save();
    }


    public function authorBooks()
    {
        return $this->hasMany('App\Models\Book', 'author_id', 'id');
    }
}
