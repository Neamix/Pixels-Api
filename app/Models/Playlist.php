<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $hidden   = ['created_at','upload_at'];

    public function music() 
    {
        return $this->hasMany(Music::class,'playlists_id','id');
    }
}
