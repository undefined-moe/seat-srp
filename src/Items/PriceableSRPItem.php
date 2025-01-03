<?php

namespace CryptaTech\Seat\SeatSrp\Items;

use CryptaTech\Seat\SeatSrp\Enum\SRPCategoryEnum;
use Seat\Eveapi\Models\Sde\InvType;
use Seat\Services\Contracts\HasTypeID;
use Seat\Services\Contracts\IPriceable;
use Seat\Services\Items\EveType;

/**
 * A basic implementation od IPriceable.
 */
class PriceableSRPItem extends EveType implements IPriceable
{
    protected float $price;
    protected float $amount;
    protected float $modifier;
    protected float $flag;

    /**
     * @param  int|HasTypeID  $type_id  The eve type to be appraised
     * @param  float  $amount  The amount of this type to be appraised
     */
    public function __construct(int|HasTypeID $type_id, int $flag, float $amount, float $modifier = 1.0)
    {
        parent::__construct($type_id);
        $this->price = 0;
        $this->amount = $amount;
        $this->modifier = $modifier;
        $this->flag = $flag;
    }

    /**
     * @return int get the SRP item category
     */
    public function getSRPCategory(): SRPCategoryEnum
    {

        // Fitted Item
        if ((($this->flag >= 11) && ($this->flag <= 34)) || ($this->flag == 87)) {
            return SRPCategoryEnum::FITTING;
        }

        // Cargo Items
        if (($this->flag == 5) || ($this->flag == 155)) {
            return SRPCategoryEnum::CARGO;
        }

        // The SHIP
        if ($this->flag == 0) {
            return SRPCategoryEnum::SHIP;
        }

        return SRPCategoryEnum::MISC;

    }

    /**
     * @return int The amount of this item to be appraised
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param  float  $price  The new price of this item stack
     * @return void
     */
    public function incrementAmount(int $amount = 1): void
    {
       $this->amount += $amount;
    }

    /**
     * @return float The price of this item stack
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param  float  $price  The new price of this item stack
     * @return void
     */
    public function setPrice(float $price): void
    {
       $this->price = $price;
    }

    /**
     * @param  float  $price  The new price of this item stack
     * @return void
     */
    public function setModifier(float $modifier): void
    {
       $this->modifier = $modifier;
    }

    /**
     * @return float The price of this item stack as an srp item
     */
    public function getSRPPrice(): float
    {
        return $this->price * $this->modifier;
    }

    public function type()
    {
        return InvType::find($this->type_id);
    }
}
