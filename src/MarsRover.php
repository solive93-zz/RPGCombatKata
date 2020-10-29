<?php
namespace App;

final class MarsRover 
{

  protected $direction = 'N';

  public function move(array $commands) :array
  {
    foreach ($commands as $command)
    {
      $this->direction = $this->turnRight();
    }

    return [0, 0, $this->direction];
  }

  private function turnRight()
  {
    if ($this->direction == 'N')
    {
      $this->direction = 'E';
    }

    if ($this->direction == 'E')
    {
      $this->direction = 'S';
    }
        
  }
}