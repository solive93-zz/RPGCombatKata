<?php
namespace App;

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
        $damage = Damage::random();
        $this->dealDamage($character, $damage);
                
        return $damage;
    }

    private function dealDamage(Character $character, int $damage)
    {
        if($character->isItself($this))
        {
            return self::CANNOT_ATTACK_YOURSELF;
        }

        if($character->health - $damage < 0)
        {
            return $character->die();
        }
        
        if($this->is5OrMoreLevelsAbove($character))
        {
            $character->health -= round($damage/2);
            return $damage;        
        }
        if($character->is5OrMoreLevelsAbove($this))
        {
            $character->health -= round($damage*2);
            return $damage; 
        }
        $character->health -= $damage;
    }

    private function isItself($character) :bool
    {
        return $character == $this;
    }

    private function is5OrMoreLevelsAbove(Character $character) :bool
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