<?php


namespace Ipol\Ozon\Api\Methods;


use Ipol\Ozon\Api\Adapter\CurlAdapter;
use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\EncoderInterface;
use Ipol\Ozon\Api\Entity\Request\Order as ObjRequest;
use Ipol\Ozon\Api\Entity\Response\Order as ObjResponse;

class Order extends GeneralMethod
{
    /**
     * Order constructor.
     * @param ObjRequest $data
     * @param CurlAdapter $adapter
     * @param EncoderInterface|null $encoder
     * @throws BadResponseException
     */
    public function __construct(ObjRequest $data, CurlAdapter $adapter, $encoder = null)
    {
        parent::__construct($data, $adapter, ObjResponse::class, $encoder);
    }

	/**
	 * @param array $data
	 */
	public function setData($data)
	{
		if (isset($data['source'])) {
			$this->setDataGet(['utm_source' => $data['source']]);
			unset($data['source']);
		}

		return parent::setData($data);
	}
}