<?php


namespace Ipol\Ozon\Api\Entity\Response;


/**
 * Class PostingTicket
 * @package Ipol\Ozon\Api\Entity\Response
 */
class PostingTicket extends AbstractResponse
{
    /**
     * @var string
     */
    protected $barcode;

    /**
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }

    /**
     * @param string $barcode
     * @return PostingTicket
     */
    public function setBarcode(string $barcode): PostingTicket
    {
        $this->barcode = $barcode;
        return $this;
    }
}