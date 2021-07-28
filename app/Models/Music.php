<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $fillable = ['name','band','img','release','playlists_id'];

    protected $hidden   = ['created_at','updated_at'];

}
