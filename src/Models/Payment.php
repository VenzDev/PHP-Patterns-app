<?php

namespace App\Models;

class Payment extends BaseModel
{
    protected string $type;
    protected float $tax;
    protected float $amount;


    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setTax(float $tax)
    {
        $this->tax = $tax;
    }

    public function getTax(): float
    {
        return $this->tax;
    }

    public function setAmount(float $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setProductId(int $id)
    {
        $this->productId = $id;
    }


}