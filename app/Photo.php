<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
      'photo','user_id',
    ];
    protected $hidden = [
        'user_id',
    ];

    public function photo()
    {
        return $this->belongsTo(User::class);
    }
}
