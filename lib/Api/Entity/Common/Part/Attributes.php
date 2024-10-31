<?php


namespace Ipol\Ozon\Api\Entity\Common\Part;


use Ipol\Ozon\Api\Entity\AbstractEntity;

/**
 * Class Attributes
 * @package Ipol\Ozon\Api
 * @subpakage Entity
 */
class Attributes extends AbstractEntity
{
    /**
     * @var bool|null
     */
    protected $isDangerous;

    /**
     * @return bool
     */
    public function getIsDangerous(): ?bool
    {
        return $this->isDangerous;
    }

    /**
     * @param bool $isDangerous
     * @return Attributes
     */
    public function setIsDangerous(?bool $isDangerous)
    {
        $this->isDangerous = $isDangerous;
        return $this;
    }
}