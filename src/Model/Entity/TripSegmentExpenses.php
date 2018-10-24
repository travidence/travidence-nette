<?php

namespace Travidence\Model\Entity;

/**
 * Class TripSegmentExpenses
 * @package Travidence\Model\Entity
 *
 * @property float $beddingExpenses
 * @property float $foodExpenses
 * @property int $foodServings
 * @property float $otherExpenses
 */
class TripSegmentExpenses extends BaseEntity
{
    /** @var float */
    protected $beddingExpenses = 0;

    /** @var float */
    protected $foodExpenses = 0;

    /** @var int */
    protected $foodServings = 0;

    /** @var float */
    protected $otherExpenses = 0;

    /**
     * @return float
     */
    public function getBeddingExpenses(): float
    {
        return $this->beddingExpenses;
    }

    /**
     * @param float $beddingExpenses
     */
    public function setBeddingExpenses(float $beddingExpenses): void
    {
        $this->beddingExpenses = $beddingExpenses;
    }

    /**
     * @return float
     */
    public function getFoodExpenses(): float
    {
        return $this->foodExpenses;
    }

    /**
     * @param float $foodExpenses
     */
    public function setFoodExpenses(float $foodExpenses): void
    {
        $this->foodExpenses = $foodExpenses;
    }

    /**
     * @return int
     */
    public function getFoodServings(): int
    {
        return $this->foodServings;
    }

    /**
     * @param int $foodServings
     */
    public function setFoodServings(int $foodServings): void
    {
        $this->foodServings = $foodServings;
    }

    /**
     * @return float
     */
    public function getOtherExpenses(): float
    {
        return $this->otherExpenses;
    }

    /**
     * @param float $otherExpenses
     */
    public function setOtherExpenses(float $otherExpenses): void
    {
        $this->otherExpenses = $otherExpenses;
    }

    /**
     * @return float
     */
    public function getTotalExpenses()
    {
        return $this->beddingExpenses + $this->foodExpenses + $this->otherExpenses;
    }

    public function asArray()
    {
        $data = parent::asArray();
        $data['total'] = $this->getTotalExpenses();

        return $data;
    }


}