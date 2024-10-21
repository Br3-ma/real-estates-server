<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'company_id',
        'plan_id',
        'user_id',
        'amount', //independent field
        'is_promo',
        'promo_name',
        'promo_duration',
        'promo_duration_value',
        'promo_code',
        'discount',
        'status', //'cancelled, active, disabled, expired' - auto setting
        'cancellation_run_at' //date to change status to cancelled
    ];

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function billing(){
        // return $this->hasMany(Billing::class);
    }
}
