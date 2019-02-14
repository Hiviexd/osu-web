<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Http\Controllers\Payments;


use App\Models\Store\Order;
use Exception;
use Log;
use App\Libraries\OrderCheckout;

class ShopifyController extends Controller
{
    private $params;

    public function callback()
    {
        // X-Shopify-Hmac-Sha256
        // X-Shopify-Order-Id
        // X-Shopify-Shop-Domain
        // X-Shopify-Test
        // X-Shopify-Topic

        $orderId = $this->getOrderId();
        if ($orderId === null) {
            throw new Exception('missing orderId');
        }

        $order = Order::findOrFail($orderId);

        $type = $this->getWebookType();
        switch ($type) {
            case 'orders/create':
                (new OrderCheckout($order))->completeCheckout();
                break;
            case 'orders/paid':
                break;
            default:
                Log::error("Didn't understand {$type}");
                break;
        }

        return response([], 204);
    }

    private function getWebookType()
    {
        return request()->header('X-Shopify-Topic');
    }

    private function getOrderId()
    {
        // array of name-value pairs.
        $attributes = $this->getParams()['note_attributes'];

        foreach ($attributes as $attribute) {
            if ($attribute['name'] === 'orderId') {
                return get_int($attribute['value']);
            }
        }
    }

    private function getParams()
    {
        if ($this->params === null) {
            $this->params = static::extractParams(request());
        }

        return $this->params;
    }
}
