<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservedHours extends Model {

    protected $table = 'service_user';

    public function services()
    {
        return $this->belongsToMany('App\Service','service_user','id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User','service_user','id');
    }

}
