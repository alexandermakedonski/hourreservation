<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_service extends \Kalnoy\Nestedset\Node {

	public $timestamps = false;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

}
