<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo;

use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;


/**
 * Class Property
 * @package Ipol\Ozon\Api\Entity\Response\Part\PickupExtendedInfo
 */
class Property extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var string
     */
    protected $name;
    /**
     * @var bool
     */
    protected $enabled;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Property
     */
    public function setName(string $name): Property
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return Property
     */
    public function setEnabled(bool $enabled): Property
    {
        $this->enabled = $enabled;
        return $this;
    }

}