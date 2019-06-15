<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Navigations extends Model
{
    protected $table = 'navigations';
    protected $primaryKey = 'id';
    protected $fillable = ['link_text', 'url', 'description', 'group_id', 'click_count'];

    public function group()
    {
        return $this->belongsTo('App\NavigationGroups','id','group_id');
    }
}
