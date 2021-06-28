<?php

namespace Razvan\Emagia\Tests;

use Razvan\Emagia\Models\Skill\RapidStrike;
use PHPUnit\Framework\TestCase;

class RapidStrikeTest extends TestCase
{
  private object $skill;

  private array $values = [
    'name' => 'Magic',
    'value' => 2,
    'chance' => 30,
    'action' => 'attack'
  ];


  public function setUp(): void
  {
    $this->skill = $this->getMockForAbstractClass(RapidStrike::class);
    $this->skill
      ->setName($this->values['name'])
      ->setValue($this->values['value'])
      ->setChance($this->values['chance'])
      ->setAction($this->values['action'])
    ;
  }

  public function testAllGetters(): void
  {
    $this->assertEquals($this->values['name'], $this->skill->getName());
    $this->assertEquals($this->values['value'], $this->skill->getValue());
    $this->assertEquals($this->values['chance'], $this->skill->getChance());
    $this->assertEquals($this->values['action'], $this->skill->getAction());
  }

  public function testSpecialDamage(): void
  {
    $this->assertEquals(80, $this->skill->specialDamage(40));
  }

  public function testIsUsed(): void
  {
    $this->assertIsBool($this->skill->isUsed());
  }
}