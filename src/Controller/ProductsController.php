<?php

namespace App\Controller;

use App\Controller\PaymentProcessors\PaypalPaymentProcessor;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    #[Route('/api/products/price/{id}', name: 'api_get_price', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function getPrice(Request $request, int $id): Response
    {
        $couponCode = $request->query->get('voucher');
        $taxNumber = $request->query->get('taxNumber');
        $tax = 0;//Процентная ставка для Франции не была указана, так что оставлю default 0
        if (!empty($taxNumber)) {
            switch (mb_substr($taxNumber, 0, 2)) {
                case 'DE':
                    $tax = 0.19;
                    break;
                case 'IT':
                    $tax = 0.22;
                    break;
                case 'GR':
                    $tax = 0.24;
                    break;
            }
        }
        /*
        Я делаю через switch case, потому что в данном тестовом задании не было сказано использовать базу данных,
        но грамотнее, само собой, тянуть цены и налоговые ставки из базы
        */
        $price = 0;
        switch ($id) {
            case 1:
                $price = 100;
                break;
            case 2:
                $price = 20;
                break;
            case 3:
                $price = 10;
                break;
        }
        if (!empty($couponCode)) {//Так как метод только для выяснения цены для одного товара, то купон на все покупки действовать не сможет, только с фиксированной скидкой
            $finalPrice = ($price - ($price * $couponCode)) + ($tax * ($price - ($price * $couponCode)));
        } else {
            $finalPrice = $price + ($tax * $price);
        }
        return $this->json(['price' => $finalPrice]);
    }

    /**
     * @throws Exception
     * Довольно абстрактный метод, так как много нюансов не было оговорено в ТЗ(без системного аналитика трудновато), но
     * если рассуждать, то для проведения оплаты нужны текущие параметры, которые я описал, в частности, должен быть предварительно вызван метод
     * просчитывания цены и получение уже итогового параметра цены, но я не стал делать вызов сам на себя, так как это не совсем корректно для API
     *
     * Готов обговорить свои решения и как бы я мог поступить иначе или дополнить
     */
    #[Route('/api/products/sale/', name: 'api_execute_sale')]
    public function executeSale(Request $request): Response
    {
        $product = $request->query->get('product');
        $taxNumber = $request->query->get('taxNumber');
        $couponCode = $request->query->get('couponCode');
        $price = $request->query->get('price');
        if (!empty($price) && !empty($taxNumber) && !empty($product)) {
            $paypalPay = (new PaypalPaymentProcessor())->pay($price);
            $params = [
                'status' => 'success',
                'productId' => $product,
                'taxNumber' => $taxNumber,
                'couponCode' => !empty($couponCode) ? $couponCode : '',
                'paymentProcessor' => $paypalPay === true ? 'paypal' : null
            ];
            return $this->json($params);
        } else {
            return $this->json([
                'status' => 'error',
                'message' => 'some parameters are empty'
            ], 400);
        }
    }
}
