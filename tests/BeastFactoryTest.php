<?php

namespace Razvan\Emagia\Tests;

use Razvan\Emagia\Models\Warrior\HeroWarrior;
use Razvan\Emagia\Models\WarriorFactory\HeroFactory;
use PHPUnit\Framework\TestCase;

class BeastFactoryTest extends TestCase
{
  private object $beast;


  public function testCreator(): void
  {
    $this->beast = HeroFactory::creator();

    $this->assertIsObject($this->beast);
    $this->assertInstanceOf(HeroWarrior::class, $this->beast);
  }
}