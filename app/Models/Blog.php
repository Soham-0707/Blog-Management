<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'short_description',
        'content',
        'category',
        'image',
        'publish_date'
    ];
}