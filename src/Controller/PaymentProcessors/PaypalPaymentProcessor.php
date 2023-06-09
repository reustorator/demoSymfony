<?php

namespace App\Controller\PaymentProcessors;

use Exception;

class PaypalPaymentProcessor
{
    /**
     * @throws Exception in case of a failed payment
     */
    public function pay(int $price): bool
    {
        if ($price > 100) {
            throw new Exception('Too high price');
        } else {
            return true;
        }

        //process payment logic
    }
}