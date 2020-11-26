<?php
namespace App;

final class Character
{
    public $health = 1000;
    public $level = 1;
    public $status = true;


    public function attack($character, $damage_value)
    {
      if ($character === $this)
      {
        echo "You cannot attack yourself"; 
        return;
      }
      if ($character->level == $this->level)
      {
        $character->health -= $damage_value;
      }

      $levelDifference = abs($character->level - $this->level);
      
      if ($levelDifference < 5 && $this->level > $character->level)
      {
        $damage_value = $damage_value + ($damage_value / 2);  
        $character->health = $character->health - $damage_value;
      }
      if ($levelDifference >= 5 )
      {
        $character->health -= ($damage_value / 2);
      }

      if($character->health <= 0)
        {
          $character->die();
        }
    }

    private function die()
    {
      $this->health = 0;
      $this->status = false;
    }

    public function isDead()
    {
      return $this->status === false;
    }

    public function heal($character, $healing_value)
    {
        if($character->isDead() || $character->health == 1000 || $character != $this)
        {
          return $character;
        }

        $character->health += $healing_value;
        if ($character->health > 1000)
        {
          $character->health = 1000;
        }
    }

}