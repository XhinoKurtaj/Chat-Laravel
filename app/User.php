<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Authenticatable
{
    use HasApiTokens;
    use AuthenticableTrait;
    use Searchable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'facebook_id',
        'photo',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'fullName'
    ];

    public $timestamps = false;

    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'user_conversations', 'user_id', 'conversation_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class,'sender_id');
    }


}
