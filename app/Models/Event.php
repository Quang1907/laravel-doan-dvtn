<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable =  [ "id", "title", "content", "start", "end" ];

    public function users() {
        return $this->belongsToMany( User::class, "users_events", "event_id", "user_id" );
    }
}
