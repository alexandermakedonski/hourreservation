<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model {

    protected $fillable = ['category_id','name','price','time'];

    public function category()
    {
        return $this->belongsTo('App\Category_service','category_id');
    }

}
