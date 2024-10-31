<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class ReportList
 * @package Ipol\Ozon\Api\Entity\Request
 */
class ReportList extends AbstractRequest
{
    /**
     * @var string "PrincipalReport"|"AgentReportPrincipalRevenue"
     */
    protected $reportType;
    /**
     * @var string|null DateTime
     */
    protected $dateFrom;
    /**
     * @var string|null DateTime
     */
    protected $dateTo;

    /**
     * @return string
     */
    public function getReportType(): string
    {
        return $this->reportType;
    }

    /**
     * @param string $reportType
     * @return ReportList
     */
    public function setReportType(string $reportType): ReportList
    {
        $this->reportType = $reportType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateFrom(): ?string
    {
        return $this->dateFrom;
    }

    /**
     * @param string|null $dateFrom
     * @return ReportList
     */
    public function setDateFrom(?string $dateFrom): ReportList
    {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateTo(): ?string
    {
        return $this->dateTo;
    }

    /**
     * @param string|null $dateTo
     * @return ReportList
     */
    public function setDateTo(?string $dateTo): ReportList
    {
        $this->dateTo = $dateTo;
        return $this;
    }

}