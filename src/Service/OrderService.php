<?php


namespace App\Service;


use DateTime;

class OrderService
{
    public function makeOrder($name, $phone, $date, $time, $comment, $promotion)
    {

        try {
            $date = $date ? new DateTime($date . ' ' . $time) : null;
        } catch (\Exception $e) {
            $date = null;
        }

        dump($date);
    }
}