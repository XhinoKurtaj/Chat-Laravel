<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Message extends Model
{
    protected $fillable = [
        'message','attachment','conversation_id','sender_id'
    ];

    public $timestamps = false;

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
        return $this->hasMany(Attachment::class);
    }
}
