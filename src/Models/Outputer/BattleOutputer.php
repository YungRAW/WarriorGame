<?php

namespace Razvan\Emagia\Models\Outputer;

use Razvan\Emagia\Models\Warrior\BaseWarrior;
use Razvan\Emagia\Models\Setting\BattleSetting;


class BattleOutputer
{

  private array $battleSettings;

  public function __construct(BattleSetting $battleSetting)
  {
    $this->battleSettings = $battleSetting->getSettings();
  }

  public function output(string $msg): void
  {
    echo $msg . PHP_EOL;
    usleep($this->battleSettings['sleep']);
  }


  public function characterStats(BaseWarrior $character): void
  {
    $msg = sprintf('Character %s has health: %s, strenght: %s, defence: %s, speed: %s, luck: %s',
      $character->getName(),
      $character->getHealth(),
      $character->getStrength(),
      $character->getDefence(),
      $character->getSpeed(),
      $character->getLuck()
    );

    $this->output($msg);
  }

  public function characterHealth(BaseWarrior $character): void
  {
    $msg = sprintf('Character %s has health: %s', $character->getName(), $character->getHealth());
    $this->output($msg);

  }
}
