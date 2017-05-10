<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'user','user/doLogin','order','admin/merchant/ajax_agents','api/wxapi/index','api/wxapi/menu','api/buy','api/batchBuy','api/orderBuy',
        'admin/agent/ajax_products','api/lxBuy',
    ];
}
