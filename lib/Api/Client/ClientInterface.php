<?php


namespace Ipol\Ozon\Api\Client;


interface ClientInterface
{
    public function get($args = array());

    public function post($args = array());
}