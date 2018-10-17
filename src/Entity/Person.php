<?php

namespace Travidence\Entity;


class Person extends BaseEntity
{
    /** @var string */
    protected $name;
    /** @var string */
    protected $surname;

    /** @var string */
    protected $department;
    /** @var string */
    protected $workStation;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getDepartment(): string
    {
        return $this->department;
    }

    /**
     * @param string $department
     */
    public function setDepartment(string $department): void
    {
        $this->department = $department;
    }

    /**
     * @return string
     */
    public function getWorkStation(): string
    {
        return $this->workStation;
    }

    /**
     * @param string $workStation
     */
    public function setWorkStation(string $workStation): void
    {
        $this->workStation = $workStation;
    }
}