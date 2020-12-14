<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title', 'content', 'notice_date', 'user_id', 'banner_image'
    ];
}
