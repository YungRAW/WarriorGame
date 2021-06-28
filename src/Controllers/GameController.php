<?php

namespace Razvan\Emagia\Controllers;

class GameController
{

  private BattleController $battle;
  public function __construct(BattleController $battle)
  {
    $this->battle = $battle;
  }

  public function start(): void
  {
    $this->battle->startBattle();

    while ($this->battle->nextTurn()) {
      $this->battle->playTurn();
    }

    $this->battle->endBattle();
  }
}
