<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    protected $primaryKey  = 'id';
    protected $fillable = ['name', 'description'];

    public function posts()
    {
        return $this->hasMany('App\Posts');
    }
    public function gallery()
    {
        return $this->hasMany('App\Gallery');
    }
}