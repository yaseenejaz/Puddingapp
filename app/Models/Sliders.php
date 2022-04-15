<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;

class Sliders extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table        = 'sliders';
    protected $primaryKey   =  'id';

    protected $fillable     = ['name', 'slug', 'slide_text', 'bg_image', 'front_image'];
}
