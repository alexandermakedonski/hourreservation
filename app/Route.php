<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model {

	protected $fillable = [
        'role_id',
        'route'
    ];
}
