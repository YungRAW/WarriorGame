<?php

namespace Razvan\Emagia\Models\Warrior;


abstract class BaseWarrior
{

  protected string $name;
  protected int $health;
  protected int $strength;
  protected int $defence;
  protected int $speed;
  protected int $luck;


  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getName(): string
  {
    return $this->name;
  }


  public function setHealth(int $health): self
  {
    $this->health = $health;

    return $this;
  }


  public function getHealth(): int
  {
    return $this->health;
  }

  
  public function setStrength(int $strength): self
  {
    $this->strength = $strength;

    return $this;
  }

 
  public function getStrength(): int
  {
    return $this->strength;
  }

  
  public function setDefence(int $defence): self
  {
    $this->defence = $defence;

    return $this;
  }

  
  public function getDefence(): int
  {
    return $this->defence;
  }

 
  public function setSpeed(int $speed): self
  {
    $this->speed = $speed;

    return $this;
  }

  
  public function getSpeed(): int
  {
    return $this->speed;
  }

  
  public function setLuck(int $luck): self
  {
    $this->luck = $luck;

    return $this;
  }


  public function getLuck(): int
  {
    return $this->luck;
  }
}
