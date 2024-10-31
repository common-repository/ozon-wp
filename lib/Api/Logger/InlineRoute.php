<?php


namespace Ipol\Ozon\Api\Logger;


/**
 * Class FileRoute
 * @package Ipol\Ozon\Api
 * @subpackage Logger
 */
class InlineRoute extends Route
{
    /**
     * @param string $dataString
     */
    public function log(string $dataString): void
    {
        echo $dataString . PHP_EOL . '--------------------------------------------' . PHP_EOL;
    }

    public function read(): string
    {
        //you can read it where you log it. It's INLINE logger after all
        return '';
    }
}