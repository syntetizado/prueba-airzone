<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserDao extends Model
{
    public $timestamps = false;
    protected $table = 'user';
    protected $casts = [
        'username' => 'string',
        'full_name' => 'string',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(
            CommentDao::class,
            'user'
        );
    }
}
