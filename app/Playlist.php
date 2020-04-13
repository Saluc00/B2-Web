<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{

    protected $fillable = [
        'name', 'image', 'description',
    ];

    public function musiques()
    {
        return $this->belongsToMany(Musique::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
