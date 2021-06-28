<?php

namespace Razvan\Emagia\Models\WarriorFactory;

use Razvan\Emagia\Character\BaseCharacter;
use Razvan\Emagia\Models\Warrior\BaseWarrior;

interface FactoryInterface
{
  public static function creator(): BaseWarrior;
}
