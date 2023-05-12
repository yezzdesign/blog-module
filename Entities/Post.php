<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Acc\Entities\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'author_id',
        'book_id',
        'content',
        'content_short',
        'launch_date',
        'is_launched',
        'cover_image_path',
        'categories',

    ];

	public static function getLastActivePosts(int $numberOfPosts)
	{
        return self::where([['is_launched', '=', 1]])
            ->orderBy('launch_date', 'desc')
            ->take($numberOfPosts)
            ->get();
	}

    public static function getAllActivePostsSortedPaginated() {
        return self::orderBy('launch_date', 'desc')->where('is_launched', '=', 1)->paginate(25);
    }

    protected function getRandomBlogs(int $numberOfRandomBlogs = 4) {
        return self::all()
            ->where('is_launched', '=', '1')
            ->random($numberOfRandomBlogs);
    }


	protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\PostFactory::new();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->performOnCollections('blog')
            ->crop('crop-center', 60, 60)
            ->nonQueued();

        $this->addMediaConversion('preview')
            ->performOnCollections('blog')
            ->crop('crop-center', 300, 300)
            ->nonQueued();

        $this->addMediaConversion('larger')
            ->performOnCollections('blog')
            ->crop('crop-center', 600, 600)
            ->nonQueued();

    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function links(): HasMany
    {
        return $this->hasMany(PostLinks::class);
    }
}
