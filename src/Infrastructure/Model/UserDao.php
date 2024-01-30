<?php declare(strict_types=1);

namespace Airzone\Infrastructure\Model;

use Illuminate\Database\Eloquent\Model;

class UserDao extends Model
{
    public $timestamps = false;
    protected $table = 'user';
    protected $casts = [
        'username' => 'string',
        'full_name' => 'string',
    ];
}
