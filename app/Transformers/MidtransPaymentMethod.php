<?php

namespace App\Transformers;

class MidtransPaymentMethod
{
    public static function convert($request)
    {
        $method = $request['payment_type'];

        $paymentMethod = 'unknow method';

        switch ($method) {
            case 'credit_card':
                $paymentMethod = 'Credit card '.$request['bank'] ?: '';
                break;
            case 'gopay':
                $paymentMethod = 'Gopay';
                break;
            case 'bank_transfer':
                $paymentMethod = 'Bank Transfer'.$request['va_numbers'] ? \strtoupper($request['va_numbers']['bank']) : '';
                break;
            case 'echannel':
                $paymentMethod = 'Mandiri Bill';
                break;
            case 'bca_klikpay':
                $paymentMethod = 'BCA Klikpay';
                break;
            case 'bca_klikbca':
                $paymentMethod = 'Klikbca';
                break;
            case 'mandiri_klikpay':
                $paymentMethod = 'Mandiri klikpay';
                break;
            case 'cimb_clicks':
                $paymentMethod = 'CIMB Clicks';
                break;
            case 'danamon_online':
                $paymentMethod = 'Danamon Online';
                break;
            case 'cstore':
                $paymentMethod = \ucfirst($request['store']) ?: 'Convenient Store';
                break;
            case 'akulaku':
                $paymentMethod = 'Akulaku';
                break;
            case 'bri_epay':
                $paymentMethod = 'BRI Epay';
                break;
        }

        return $paymentMethod;
    }
}
