<?php

namespace Astrogoat\Cloudflare;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Astrogoat\Cloudflare\Cloudflare
 */
class CloudflareFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cloudflare';
    }
}
