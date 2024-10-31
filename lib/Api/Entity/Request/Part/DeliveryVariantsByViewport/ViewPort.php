<?php


namespace Ipol\Ozon\Api\Entity\Request\Part\DeliveryVariantsByViewport;


use Ipol\Ozon\Api\Entity\AbstractEntity;

/**
 * Class ViewPort
 * @package Ipol\Ozon\Api\Entity\Request\Part\DeliveryVariantsByViewport
 */
class ViewPort extends AbstractEntity
{
    /**
     * @var Coordinates
     */
    protected $rightTop;
    /**
     * @var Coordinates
     */
    protected $leftBottom;
    /**
     * @var int|null //TODO check
     */
    protected $zoom;

    /**
     * @return Coordinates
     */
    public function getRightTop(): Coordinates
    {
        return $this->rightTop;
    }

    /**
     * @param Coordinates $rightTop
     * @return ViewPort
     */
    public function setRightTop(Coordinates $rightTop): ViewPort
    {
        $this->rightTop = $rightTop;
        return $this;
    }

    /**
     * @return Coordinates
     */
    public function getLeftBottom(): Coordinates
    {
        return $this->leftBottom;
    }

    /**
     * @param Coordinates $leftBottom
     * @return ViewPort
     */
    public function setLeftBottom(Coordinates $leftBottom): ViewPort
    {
        $this->leftBottom = $leftBottom;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getZoom(): ?int
    {
        return $this->zoom;
    }

    /**
     * @param int|null $zoom
     * @return ViewPort
     */
    public function setZoom(?int $zoom): ViewPort
    {
        $this->zoom = $zoom;
        return $this;
    }
}