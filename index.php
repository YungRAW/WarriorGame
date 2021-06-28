<?php

use Razvan\Emagia\Models\Outputer\BattleOutputer;
use Razvan\Emagia\Controllers\GameController;
use Razvan\Emagia\Controllers\BattleController;
use Razvan\Emagia\Models\Setting\BattleSetting;

require __DIR__ . '/vendor/autoload.php';

$battleSetting = new BattleSetting();
$battleOutputer = new BattleOutputer($battleSetting);
$battle = new BattleController($battleSetting, $battleOutputer);

(new GameController($battle))->start();
