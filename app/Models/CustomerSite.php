<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class CustomerSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'site_name',
        'street',
        'city',
        'state',
        'zip_code',
        'country'
    ];

    public function customer(){ 
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
