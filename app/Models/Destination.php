<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;
    protected $table = 'destinations';
    protected $guarded = 'id';

    public function Image(){
        return $this->hasMany(Image_Destionation::class, 'destination_id');
    }
}