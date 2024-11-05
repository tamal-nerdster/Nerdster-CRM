<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Suppliers;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'name',
        'bandwidth',
        'base_price'
    ];


    public function supplier(){
        return $this->belongsTo(Suppliers::class);
    }
}
