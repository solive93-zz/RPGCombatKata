<?php
use PHPUnit\Framework\TestCase;
use App\Character;

final class CharacterTest extends TestCase
{
    public function test_character_has_health1000_level1_and_statusAlive_when_created()
    {
        $character = new Character();

        $this->assertEquals(1000, $character->getHealth());
        $this->assertEquals(1, $character->getLevel());
        $this->assertEquals('alive', $character->getStatus());
    }

    public function test_character_can_deal_damage_to_characters()
    {
        $character1 = new Character();
        $character2 = new Character(999, 1, 'alive');

        $damage = $character1->attack($character2);

        $this->assertEquals(999-$damage, $character2->getHealth());
    }

    public function test_character_dies()
    {
        $character1 = new Character();
        $character2 = new Character(1, 1, 'alive');

        $character1->attack($character2);

        $this->assertEquals('dead', $character2->getStatus());
        $this->assertEquals(0, $character2->getHealth());
    }

    public function test_character_can_only_heal_himself()
    {
        $currentHealth = 10;

        $character = new Character($currentHealth, 1, 'alive');

        $healingPoints = $character->heal();

        $this->assertEquals($currentHealth + $healingPoints, $character->getHealth());
    }

    public function test_dead_characters_cannot_be_healed()
    {
        $currentHealth = 0;
        
        $character1 = new Character();
        $character2 = new Character($currentHealth, 1, 'dead');

        $character1->heal($character2);

        $this->assertEquals(0, $character2->getHealth());
        $this->assertEquals('dead', $character2->getStatus());
    }

    public function test_healing_cannot_raise_health_above_1000()
    {
        $currentHealth = 1000;
        
        $character1 = new Character();
        $character2 = new Character($currentHealth, 1, 'alive');

        $character1->heal($character2);

        $this->assertEquals(1000, $character2->getHealth());
    }

    public function  test_character_cannot_deal_damage_to_itself()
    {       
        $character = new Character();

        $result = $character->attack($character);

        $this->assertEquals(1000, $character->getHealth());
    }

    public function test_damage_is_reduced_50pc_when_target_is_5plus_levels_above()
    {
        $attacker = new Character();
        $target = new Character(1000, 6, 'alive');

        $damage = $attacker->attack($target);

        $this->assertEquals(1000 - round($damage/2), $target->getHealth());
    }

    public function test_damage_is_increased_50pc_when_target_is_5plus_levels_below()
    {
        $target = new Character();
        $attacker = new Character(1000, 6, 'alive');

        $damage = $attacker->attack($target);

        $this->assertEquals(1000 - round($damage*2), $target->getHealth());
    }
}