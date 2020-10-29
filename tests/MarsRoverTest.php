<?php
use PHPUnit\Framework\TestCase;
use App\MarsRover;

final class RoverTest extends TestCase 
{   
    public function test_Rover_turns_right()
    {
        $rover = new MarsRover;

        $this->assertEquals([0, 0, 'E'], $rover->move(['R']));
        $this->assertEquals([0, 0, 'S'], $rover->move(['R', 'R']));
        //$this->assertEquals([0, 0, 'W'], $rover->move([0, 0, 'N'], ['R', 'R', 'R']));
        //$this->assertEquals([0, 0, 'N'], $rover->move([0, 0, 'N'], ['R', 'R', 'R', 'R']));
        //$this->assertEquals([0, 0, 'E'], $rover->move([0, 0, 'N'], ['R', 'R', 'R', 'R', 'R']));
        //$this->assertEquals([0, 0, 'N'], $rover->move([0, 0, 'N'], ['R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R']));
    }
    /*
    public function  test_Rover_turns_left()
    {   
        $rover = new MarsRover();
        $this->assertEquals([0, 0, 'W'], $rover->move([0, 0, 'N'], ['L']));
    }
    */
}