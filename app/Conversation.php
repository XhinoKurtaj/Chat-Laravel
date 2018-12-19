<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $primaryKey = 'conversation_id';
    protected $fillable = ['custom_name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'usrcon');
    }
}
