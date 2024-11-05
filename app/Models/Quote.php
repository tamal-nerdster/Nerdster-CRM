<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Customer,CustomerSite,Product,User};
class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
        'product_id',
        'site_id',
        'term_months',
        'monthly_price',
        'installation_fee',
        'status'
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }
    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }
    public function site(){
        return $this->hasOne(CustomerSite::class,'id','site_id');
    }
}
