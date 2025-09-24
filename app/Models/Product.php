<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
      protected $fillable = [
        
        'item_name',
        'category',
        'unit',
        
    
    ];
public function products()
    {
        return $this->hasMany(Product::class);
    }

    
public function sales()
{
    return $this->hasMany(Sale::class);
}

public function purchases()
{
    return $this->hasMany(Purchase::class);
}

public function getStockAttribute()
{
    return $this->purchases()->sum('qty');
}

}
