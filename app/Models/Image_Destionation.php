<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image_Destionation extends Model
{
    use HasFactory;
    protected $table = 'image__destinations';
    protected $guarded = 'id';
    public $timestamps = false;
}
