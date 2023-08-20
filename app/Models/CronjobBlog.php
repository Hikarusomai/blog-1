<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CronjobBlog extends Model
{
    use HasFactory;

    protected $table = 'cronjob_blogs';
    protected $fillable = [
        'title',
        'content',
        'categories',
        'keywords',
        'image',
        'status',
        'wp_status',
        'link'
    ];
}
