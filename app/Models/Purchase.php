<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;


      protected $fillable = [
        'product_id',
        'supplier_id', 
        'qty',
        'unit',
        'original_price',
        'selling_price',
    
    ];



    public function product()
{
    return $this->belongsTo(Product::class);
}

public function supplier()
{
    return $this->belongsTo(Supplier::class);
}

    
}
