<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class ReportBinary
 * @package Ipol\Ozon\Api\Entity\Request
 */
class ReportBinary extends AbstractRequest
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string - "PrincipalReport"|"AgentReportPrincipalRevenue"
     */
    protected $type;
    /**
     * @var string - "PDF"|"XLS"
     */
    protected $format;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ReportBinary
     */
    public function setId(int $id): ReportBinary
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return ReportBinary
     */
    public function setType(string $type): ReportBinary
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @param string $format
     * @return ReportBinary
     */
    public function setFormat(string $format): ReportBinary
    {
        $this->format = $format;
        return $this;
    }

}