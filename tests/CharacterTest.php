<?php
use PHPUnit\Framework\TestCase;
use App\Character;

final class CharacterTest extends TestCase
{
    public function test_characters_should_have_initial_level_status()
    {
        $character = new Character();
        $this->assertEquals(1000, $character->health);
        $this->assertEquals(1, $character->level);
        $this->assertTrue($character->status);
    }

    public function test_can_deal_damage_to_others()
    {
        $damage_value = 600;
        $character1 = new Character();
        $character2 = new Character();
        $character2->attack($character1, $damage_value);
        $this->assertEquals(1000 - $damage_value, $character1->health);
        $character2->attack($character1, $damage_value);
        $this->assertEquals(0, $character1->health);
        $this->assertFalse($character1->status);
    }

    public function test_iteration_character_dead()
    {
        $healing_value = 500;
        $character1 = new Character();
        $character2 = new Character();
        $character1->status = false; 
        $character1->health = 0;
        $character2->heal($character1, $healing_value);
        $this->assertEquals($character1->health, 0);
        $this->assertEquals($character1->status, false);  
    }

    public function test_iteration_character_cannot_heal_above_1000()
    {
        $healing_value = 110;
        $character1 = new Character(); 
        $character1->health = 900;
        $character1->heal($character1, $healing_value);
        $this->assertEquals($character1->health, 1000);   
    }

    public function test_iteration_2_cant_attack_itself()
    {
        $damage_value = 600;
        $character = new Character();
        $character->attack($character, $damage_value);
        $this->assertEquals(1000, $character->health);  
    }

    public function test_iteration_2_can_only_heal_itself()
    {
        $healing_value = 110;
        $character1 = new Character();
        $character2 = new Character();
        $character1->health = 800;
        $character2->health = 800;
        $character1->heal($character1, $healing_value);
        $this->assertEquals($character1->health, 910);
        $character1->heal($character2, $healing_value);
        $this->assertEquals($character2->health, 800);   
    }
}