<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class Suppliers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'api_endpoint',
        'api_key'
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }
}
