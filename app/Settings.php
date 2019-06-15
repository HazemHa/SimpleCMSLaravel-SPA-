<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
    protected $primaryKey  = 'id';
    protected $fillable = ['site_name', 'site_email', 'site_location', 'site_aboutUs'];
}
