<?php declare(strict_types=1);

namespace Tests\Double\Fake\Collection;

use Airzone\Shared\Collection;
use Tests\Double\Dummy\Foo;

final class FooCollectionFake extends Collection
{
    protected const TYPE = Foo::class;
}
