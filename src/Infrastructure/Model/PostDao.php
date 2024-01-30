<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class PostDao extends Model
{
    public const UPDATED_AT = 'updated';
    public const CREATED_AT = 'added';

    protected $table = 'posts';
    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'marks' => 'string',
        'picture' => 'string',
        'short_content' => 'string',
        'content' => 'string',
        'comment' => 'boolean',
        'pending' => 'boolean',
        'public' => 'boolean',
        'active' => 'boolean',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            CategoryDao::class,
            CategoryPostDao::TABLE,
            'blog',
            'category'
        );
    }

    public function comments(): HasMany
    {
        return $this->hasMany(
            CommentDao::class,
            'post_id'
        );
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(
            UserDao::class,
            'user'
        );
    }

    public function writers(): BelongsToMany
    {
        return $this->belongsToMany(
            UserDao::class,
            'comments',
            'post_id',
            'user'
        );
    }
}
