<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryDao extends Model
{
    public $timestamps = false;
    protected $table = 'categories';
    protected $casts = [
        'visible' => 'boolean',
        'name' => 'string',
        'slug' => 'string',
    ];
}
