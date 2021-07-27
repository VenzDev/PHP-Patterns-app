<?php

namespace App\Models;

class Product extends BaseModel
{
    protected string $name;
    protected string $material;
    protected int $windowAmount;
    protected string $size;
    protected bool $isGarage;
    protected int $floors;
    /**
     * @foreign
     */
    protected int $userId;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  string  $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getMaterial(): string
    {
        return $this->material;
    }

    /**
     * @param  string  $material
     */
    public function setMaterial(string $material): void
    {
        $this->material = $material;
    }

    /**
     * @return int
     */
    public function getWindowAmount(): int
    {
        return $this->windowAmount;
    }

    /**
     * @param  int  $windowAmount
     */
    public function setWindowAmount(int $windowAmount): void
    {
        $this->windowAmount = $windowAmount;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @param  string  $size
     */
    public function setSize(string $size): void
    {
        $this->size = $size;
    }

    /**
     * @return bool
     */
    public function isGarage(): bool
    {
        return $this->isGarage;
    }

    /**
     * @param  bool  $isGarage
     */
    public function setIsGarage(bool $isGarage): void
    {
        $this->isGarage = $isGarage;
    }

    /**
     * @return int
     */
    public function getFloors(): int
    {
        return $this->floors;
    }

    /**
     * @param  int  $floors
     */
    public function setFloors(int $floors): void
    {
        $this->floors = $floors;
    }

    /**
     * @return int
     */
    public function getPaymentId(): int
    {
        return $this->paymentId;
    }

    /**
     * @param  int  $paymentId
     */
    public function setPaymentId(int $paymentId): void
    {
        $this->paymentId = $paymentId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param  int  $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }


}