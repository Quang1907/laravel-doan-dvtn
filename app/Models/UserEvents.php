<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEvents extends Model
{
    use HasFactory;
    protected $table = "users_events";
    protected $fillable = ["user_id", "user_create", "event_id", "active", "refuse", "allow_absence", "content_refuse" ];

    public function user() {
        return $this->belongsTo( User::class, "user_id", "id" );
    }

    public function event() {
        return $this->belongsTo( Event::class, "event_id", "id" );
    }
}
