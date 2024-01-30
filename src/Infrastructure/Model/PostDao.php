<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Model;

use Illuminate\Database\Eloquent\Model;

class PostDao extends Model
{
    const UPDATED_AT = 'updated';
    const CREATED_AT = 'added';

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
}
