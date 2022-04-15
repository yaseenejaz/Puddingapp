<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use DB;

class Zipcodes extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'zipcodes';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'slug', 'zipcode', 'url'];
}
