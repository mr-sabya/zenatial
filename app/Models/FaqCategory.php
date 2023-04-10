<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public function faqs()
    {
    	return $this->hasMany('App\Models\Faq','category_id');
    }

    public function getSlug()
    {
    	return strtolower(str_replace(' ', '-', $this->name));
    }
}
