<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class NavigationGroups extends Model
{
    protected $table = 'navigation_groups';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'slug'];

    public function navs()
    {
        return $this->hasMany('App\Navigations', 'group_id', 'id');
    }
}
