<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';
    protected $primaryKey  = 'id';
    protected $fillable = ['user_id', 'title', 'content', 'category_id', 'image', 'status_id'];


    public function comments()
    {
        return $this->hasMany('App\Comments','post_id','id');
    }
    public function user()
    {
        return $this->belongsTo('App\Users');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }
}