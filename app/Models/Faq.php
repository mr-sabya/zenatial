<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['title','details', 'category_id', 'status'];

    public $timestamps = false;

    public function category()
    {
    	return $this->belongsTo('App\Models\FaqCategory','category_id')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('Deleted');
			}
		});
    }    

}
