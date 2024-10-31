<?php

namespace Ipol\Ozon\Api\Entity;

/**
 * Interface EncoderInterface
 * @package Ipol\Ozon\Others
 * Encodes handle from API-server into cms encoding
 */
interface EncoderInterface
{
    public function encodeToAPI($handle);

    public function encodeFromAPI($handle);
}