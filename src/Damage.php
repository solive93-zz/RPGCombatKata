<?php
namespace App;

final class Damage
{
    const MIN_DAMAGE = 1;
    const MAX_DAMAGE = 100;
    
    private $amount;

    public function __construct()
    {
        $this->amount = random_int(self::MIN_DAMAGE, self::MAX_DAMAGE);
    }

    public function amount()
    {
        return $this->amount;
    }
    
}