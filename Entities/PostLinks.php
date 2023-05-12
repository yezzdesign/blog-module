<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostLinks extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_name',
        'link_address',
        'link_icon',
        'post_id'
    ];

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\PostLinksFactory::new();
    }
}

//php artisan make:filament-resource Customer
