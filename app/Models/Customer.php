<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{User,CustomerSite};
class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'contact_name',
        'email',
        'phone',
        'street',
        'city',
        'state',
        'zip_code',
        'country'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function customerSites(){
        return $this->hasMany(CustomerSite::class, 'customer_id');
    }
}
