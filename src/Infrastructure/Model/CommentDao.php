<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Model;

use Illuminate\Database\Eloquent\Model;

class CommentDao extends Model
{
    public $timestamps = false;
    protected $table = 'comments';
    protected $casts = [
        'datetime' => 'datetime',
        'content' => 'string',
    ];
}
