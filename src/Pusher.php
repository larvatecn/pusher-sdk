<?php
/**
 * This is NOT a freeware, use is subject to license terms
 */
declare(strict_types=1);

namespace Larva\Pusher;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin Forge
 * @author Tongle Xu <xutongle@msn.com>
 */
class Pusher extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Forge::class;
    }
}