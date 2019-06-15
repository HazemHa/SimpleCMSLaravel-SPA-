<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'subject', 'content'];
}
