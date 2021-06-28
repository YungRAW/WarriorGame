<?php

namespace Razvan\Emagia\Models\Setting;

use Symfony\Component\Yaml\Yaml;

class BattleSetting
{

  private array $settings = [];


  public function __construct()
  {
    $this->settings = Yaml::parseFile(dirname(__DIR__, 2) . '/config/battle.yaml');
  }

  public function getSettings(): array
  {
    return $this->settings['battle'];
  }
}
