<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdImage extends Model
{
    /** @use HasFactory<\Database\Factories\AdImageFactory> */
    use HasFactory;

    protected $fillable = ['ad_id', 'name'];
}
