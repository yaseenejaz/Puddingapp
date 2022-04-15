<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;

class Products extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table        = 'products';
    protected $primaryKey   = 'id';

    protected $fillable     = ['name', 'slug', 'price', 'image', 'is_favourite'];
}
