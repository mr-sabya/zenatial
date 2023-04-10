<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['photo','subtitle','title','description','link','type'];
    public $timestamps = false;
}
