<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Product extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = ['name','description'];
    
    protected $fillable = [
    'name','description','category_id','image','purchase_price','sale_price','stock',
];
protected $appends = ['image_path','profit_percent'];

public function category(){
    return $this->belongsTo(Category::class);
}
public function getImagePathAttribute(){
    return asset('storage/uploads/product_images/'.$this->image);
}
public function getProfitPercentAttribute(){
$profit = $this->sale_price - $this->purchase_price;
$profit_percent = $profit * 100 / $this->purchase_price;
return number_format($profit_percent,2);

}
public function orders(){

    return $this->belongsToMany(Order::class,'product_order');
}

}
