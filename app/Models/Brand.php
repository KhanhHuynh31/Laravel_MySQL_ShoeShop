<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'brand_name', 'brand_desc', 'brand_status', 'brand_parent', 'brand_order'
    ];
    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_brand';

    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }
}
