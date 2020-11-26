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
      $levelDifference = abs($character->level - $this->level);
      //var_dump($levelDifference);
      if ($levelDifference < 5)
      {

        $character->health -= $damage_value;
        
        //var_dump($character->health);
      }
      if ($levelDifference >= 5)
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