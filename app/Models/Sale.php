<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = ['reciept_no'];



    public function items()
{
    return $this->hasMany(SaleItem::class);
}

   

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function purchase()
{
    return $this->belongsTo(Purchase::class);
}


}
