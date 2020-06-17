<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bukumodel extends Model
{
    protected $table = 'books';
    protected $fillable = ['title', 'author', 'penerbit'];
}
