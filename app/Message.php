<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message', 'attachment', 'conversation_id', 'sender_id'
    ];


    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function attachment()
    {
        return $this->hasOne(Attachment::class, 'message_id');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
