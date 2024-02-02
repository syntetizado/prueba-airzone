<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Repository\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CategoryDao extends Model
{
    public $timestamps = false;
    protected $table = 'categories';
    protected $casts = [
        'visible' => 'boolean',
        'name' => 'string',
        'slug' => 'string',
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(
            PostDao::class,
            CategoryPostDao::TABLE,
            'category',
            'blog'
        );
    }
}
