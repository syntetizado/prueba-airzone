<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryPostDao extends Pivot
{
    public const TABLE = 'category_post';

    public $timestamps = false;
    protected $table = self::TABLE;
}
