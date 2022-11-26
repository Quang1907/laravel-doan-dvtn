<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = [
        "user_id",
        "tracking_no",
        "fullname",
        "phonenumber",
        "email",
        "pincode",
        "address",
        "status_message",
        "payment_id",
        "payment_mode",
    ];

    public function orderItems() {
        return $this->hasMany( OrderItem::class, "order_id", "id" );
    }

    public function scopeFilter( $query ) {
        if ( $data = request()->date ) {
            $query->whereDate( "created_at", $data );
        } else {
            $query->whereDate( "created_at", Carbon::today() );
        }

        if ( $status = request()->status ) {
            $query->where( "status_message", $status );

        }

    }
}
