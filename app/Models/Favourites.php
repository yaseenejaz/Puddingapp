<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;

class Favourites extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table =  'favourite_products';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'slug', 'product_url', 'product_image'];
}
