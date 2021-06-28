<?php

namespace Razvan\Emagia\Models\Skill;


abstract class BaseSkill
{

  protected string $name;


  protected int $chance;

 
  protected int $value;

  protected string $action;


  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

 
  public function getName(): string
  {
    return $this->name;
  }

 
  public function setChance(int $chance): self
  {
    $this->chance = $chance;

    return $this;
  }

  public function getChance(): int
  {
    return $this->chance;
  }

  
  public function setValue(int $value): self
  {
    $this->value = $value;

    return $this;
  }

 
  public function getValue(): int
  {
    return $this->value;
  }


  public function setAction(string $action): self
  {
    $this->action = $action;

    return $this;
  }

  public function getAction(): string
  {
    return $this->action;
  }


  public function isUsed(): bool
  {
    return mt_rand(0, 100) <= $this->chance;
  }


  public function getClassName(): string
  {
    return static::class;
  }
}
