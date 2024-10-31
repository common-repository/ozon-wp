<?php


namespace Ipol\Ozon\Ozon\Entity;


use Ipol\Ozon\Api\Entity\Response\ErrorResponse;
use Ipol\Ozon\Api\Entity\Response\PostingTicket as ResponseObj;

/**
 * Class GetBarcodeResult
 * @package Ipol\Ozon\Application
 * @subpackage Result
 * @method ResponseObj|ErrorResponse getResponse
 */
class GetBarcodeResult extends AbstractResult
{
    /**
     * @var string - base64 encoded array, when decoded - content for .pdf file
     */
    private $barcode;

    /**
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }

    /**
     * @param string $barcode
     * @return GetBarcodeResult
     */
    public function setBarcode(string $barcode): GetBarcodeResult
    {
        $this->barcode = $barcode;
        return $this;
    }

    public function parseFields(): void
    {
        if($this->getResponse()) {
            $this->setBarcode($this->getResponse()->getBarcode());
        }
        parent::parseFields();
    }
}