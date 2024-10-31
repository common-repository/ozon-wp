<?php


namespace Ipol\Ozon\Api\Entity\Common\Part;


use Ipol\Ozon\Api\Entity\AbstractEntity;

/**
 * Class Buyer
 * @package Ipol\Ozon\Api
 * @subpackage Entity
 */
class Person extends AbstractEntity
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $phone;
    /**
     * @var string
     */
    protected $email;
    /**
     * @var string ("NaturalPerson" - fiz. / "LegalPerson" - ur.)
     */
    protected $type;
    /**
     * @var string
     */
    protected $legalName;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Person
     */
    public function setName(string $name): Person
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Person
     */
    public function setPhone(string $phone): Person
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Person
     */
    public function setEmail(string $email): Person
    {
        $this->email = $email;
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
     * @return Person
     */
    public function setType(string $type): Person
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getLegalName(): ?string
    {
        return $this->legalName;
    }

    /**
     * @param string|null $legalName
     * @return Person
     */
    public function setLegalName(?string $legalName): Person
    {
        $this->legalName = $legalName;
        return $this;
    }

}