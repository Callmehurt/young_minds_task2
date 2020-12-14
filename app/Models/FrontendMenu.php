<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontendMenu extends Model
{
    protected $fillable = [
        'link_name', 'link_url'
    ];
}
