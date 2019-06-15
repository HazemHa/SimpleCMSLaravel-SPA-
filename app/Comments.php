<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'post_id', 'name', 'email', 'subject', 'message'];
    public function user()
    {
        return $this->belongsTo('App\Users');
    }
    public function post(){
        return $this->belongsTo('App\Posts');
    }
}
