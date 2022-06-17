<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'Comments';
    protected $guarded = 'id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
