<?php

namespace Modules\Blog\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\UCP\Entities\User;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_title',
        'post_content',
        'post_content_short',
        'post_category_id',
        'post_image',
        'post_status',
        'post_created_at',
        'post_author',
        'post_book',
        'created_at',
        'updated_at',
        ];

    public static function getAllPostsSortedPaginated() {
        return self::orderBy('id', 'desc')->paginate(25);
    }

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\PostsFactory::new();
    }

    public function author() {
        return $this->belongsTo(User::class, 'post_author');
    }
}
