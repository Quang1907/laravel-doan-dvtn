<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'birthday',
        'address',
        'phonenumber',
        'manager',
        'google_id',
        'password',
        "avata",
        'role_id',
        'github_id',
        'auth_type',
        "is_active",
        "token",
        "email_verified_at",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() {
        return $this->belongsTo( Role::class );
    }

    public function hasPermission( $name ) {
        return $this->role->permissions()->where( "name", $name )->exists();
    }

    public function scopeSearch( $query ) {

        if ( $search = request()->search ) {
            $query->where( "name", $search )->orWhere( "email", $search );
        }

        if ( $created_at = request()->date ) {
            $query->where( "created_at" , "like", "%" . $created_at ."%"  );
        }

        if ( request()->softdelete == "on" ) {
            $query->onlyTrashed();
        }

        $is_active =  request()->is_active;
        if ( !empty( $is_active) &&  $is_active == 1 ) {
            $query->where( "is_active" , true );
        }

        if ( !empty( $is_active) &&  $is_active == 2 ) {
            $query->where( "is_active" , false );
        }

        return $query;
    }
}
