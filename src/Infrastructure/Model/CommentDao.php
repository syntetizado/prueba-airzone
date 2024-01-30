<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentDao extends Model
{
    public $timestamps = false;
    protected $table = 'comments';
    protected $casts = [
        'datetime' => 'datetime',
        'content' => 'string',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(
            PostDao::class,
            'post_id'
        );
    }

    public function writer(): BelongsTo
    {
        return $this->belongsTo(
            UserDao::class,
            'user'
        );
    }
}
