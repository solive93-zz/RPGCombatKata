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

    public function test_iteration_1_2()
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

    public function test_iteration_1_3()
    {
        $healing_value = 500;
        $character1 = new Character();
        $character2 = new Character();
        $character2->heal($character1, $healing_value);
        $this->assertTrue($character1->health > 500);

    }
}