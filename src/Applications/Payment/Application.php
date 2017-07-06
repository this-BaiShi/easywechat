<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyWeChat\Applications\Payment;

use EasyWeChat\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \EasyWeChat\Applications\Payment\Coupon\Client $coupon
 * @property \EasyWeChat\Applications\Payment\Redpack\Client $redpack
 * @property \EasyWeChat\Applications\Payment\Transfer\Client $transfer
 *
 * @method \EasyWeChat\Applications\Payment\Client sandboxMode(bool $enabled = false)
 * @method string scheme(string $productId)
 * @method mixed pay(\EasyWeChat\Applications\Payment\Order $order)
 * @method mixed prepare(\EasyWeChat\Applications\Payment\Order $order)
 * @method mixed query(string $orderNo)
 * @method mixed queryByTransactionId(string $transactionId)
 * @method mixed close(string $tradeNo)
 * @method mixed reverse(string $orderNo)
 * @method mixed reverseByTransactionId(string $transactionId)
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        ServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $defaultConfig = [
        'http' => [
            'timeout' => 5.0,
            'base_uri' => 'https://api.mch.weixin.qq.com/',
        ],
    ];

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this['payment'], $name], $arguments);
    }
}
