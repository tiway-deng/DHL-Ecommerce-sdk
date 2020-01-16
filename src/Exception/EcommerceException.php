<?php

namespace Tiway\DhlEcommerce\Exception;

/**
 * Class EcommerceException
 * @package App\Packages\Ecommerce\Exception
 */
class EcommerceException extends \Exception
{

    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}