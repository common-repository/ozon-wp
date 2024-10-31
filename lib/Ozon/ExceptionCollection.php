<?php


namespace Ipol\Ozon\Ozon;


use Exception;
use Ipol\Ozon\Core\Entity\Collection;

class ExceptionCollection extends Collection
{
    public function __construct()
    {
        parent::__construct('errors');
    }

    public function getAllMessages(): string
    {
        $this->reset();
        if ($current = $this->getNext()) {
            /**@var $current Exception*/
            $strReturn = $current->getMessage();
        } else {
            return '';
        }

        while ($current = $this->getNext()) {
            /**@var $current Exception*/
            $strReturn .= ', ' . $current->getMessage();
        }

        return $strReturn;
    }
}