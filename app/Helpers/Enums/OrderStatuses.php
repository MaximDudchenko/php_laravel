<?php

namespace App\Helpers\Enums;

enum OrderStatuses: string
{
    case InProcess = "In Process";
    case Paid = "Paid";
    case Completed = "Completed";
    case Canceled = "Canceled";

    public static function findByKey(string $key) {
        return constant("self::$key");
    }
}
