<?php
namespace App;

use App\Damage;

final class Character
{
    const MAX_HEALTH = 1000;
    const CANNOT_ATTACK_YOURSELF = 'You cannot attack yourself!';

    private $health;
    private $level;
    private $status;

    public function __construct($health = 1000, $level = 1, $status = 'alive')
    {
        $this->health = $health;
        $this->level = $level;
        $this->status = $status;
    }

    public function getHealth()
    {
        return $this->health;
    }
    
    public function getLevel()
    {
        return $this->level;
    }
    
    public function getStatus()
    {
        return $this->status;
    }

    public function attack(Character $character)
    {
        $damage = new Damage();

        $this->dealDamage($character, $damage->amount());
                
        return $damage->amount();
    }

    private function dealDamage(Character $character, $damage)
    {
        if($character->is_itself($this))
        {
            return self::CANNOT_ATTACK_YOURSELF;
        }

        if($character->healthIsBelow0($damage))
        {
            return $character->die();
        }
        
        if($this->is5OrMoreLevelsBelow($character))
        {
            $character->health -= round($damage/2);
            return $damage;        
        }
        
        if($character->is5OrMoreLevelsBelow($this))
        {
            $character->health -= round($damage*2);
            return $damage; 
        }
        $character->health -= $damage;
    }

    private function is_itself(Character $character) :bool
    {
        return $character == $this;
    }

    private function healthIsBelow0($damage) :bool
    {
        return $this->health - $damage < 0;
    }

    public function is5OrMoreLevelsBelow(Character $character) :bool
    {
        return ($this->level - $character->level) <= -5;
    }

    private function die()
    {
        $this->health = 0;
        $this->status = 'dead';
    }

    public function heal() 
    {
        $heal = random_int(1, 100);

        if($this->isDead() || $this->hasFullHealth())
        {
            return $heal;
        }
        $this->health += $heal;

        return $heal;
    }

    private function isDead() :bool
    {
        return $this->health <= 0 || $this->status == 'dead';
    }

    private function hasFullHealth() :bool
    {
        return $this->health == self::MAX_HEALTH;
    }
}