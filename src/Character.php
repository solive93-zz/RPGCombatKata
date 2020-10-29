<?php
namespace App;

final class Character
{
    public $health = 1000;
    public $level = 1;
    public $status = true;

    public function attack($character, $damage)
    {
        $character->health -= $damage;
        if($character->health <= 0){
            $character->health = 0;
            $character->status = false;
        }

    }

}