<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'path', 'status_id'];

    public function status(){
        return $this->belongsTo("App\Status");
    }
}
