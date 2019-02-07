<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['custom_name','custom_photo'];

    const GROUP_TYPE = 'group';
    const DEFAULT_TYPE = 'default';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_conversations', 'conversation_id', 'user_id');
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }

    public function attachment()
    {
        return $this->hasMany(Attachment::class);
    }
}
