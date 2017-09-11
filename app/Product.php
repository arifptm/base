<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
	use Sluggable;
	
    protected $guarded = ['id'];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function sluggable()
    {
      return [
        'slug' => [
          'source' => 'name'
        ]
      ];
    }
}
