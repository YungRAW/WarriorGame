<?php

namespace Razvan\Emagia\Models\WarriorFactory;

use Razvan\Emagia\Models\Warrior\BaseWarrior;
use Razvan\Emagia\Models\Warrior\BeastWarrior;
use Razvan\Emagia\Models\Setting\StatSetting;
use Razvan\Emagia\Models\WarriorFactory\FactoryInterface;


final class BeastFactory implements FactoryInterface
{

  public static function creator(): BaseWarrior
  {
    $stats = (new StatSetting())->getBeastStats();
    $beast = new BeastWarrior();

    $beast
      ->setName('Wild Beast')
      ->setHealth(mt_rand($stats['health']['min'], $stats['health']['max']))
      ->setStrength(mt_rand($stats['strength']['min'], $stats['strength']['max']))
      ->setDefence(mt_rand($stats['defence']['min'], $stats['defence']['max']))
      ->setSpeed(mt_rand($stats['speed']['min'], $stats['speed']['max']))
      ->setLuck(mt_rand($stats['luck']['min'], $stats['luck']['max']))
    ;

    return $beast;
  }
}
