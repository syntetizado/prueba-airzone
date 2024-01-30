<?php declare(strict_types=1);

namespace Airzone\Shared;

use Illuminate\Support\Facades\DB;

final class DbHelper
{
    public static function nextIdForTable(string $table): int
    {
        $statement = DB::select("SELECT id + 1 as id FROM $table ORDER BY id DESC LIMIT 1");

        return $statement[0]?->id ?? 0;
    }

}
