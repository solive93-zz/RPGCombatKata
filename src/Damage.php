<?php
namespace App;

final class Damage
{
    const MIN_DAMAGE = 1;
    const MAX_DAMAGE = 100;

    public static function random()
    {
        return random_int(1, 100);
    }
}