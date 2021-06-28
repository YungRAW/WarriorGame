<?php

namespace Razvan\Emagia\Models\Setting;

use Symfony\Component\Yaml\Yaml;

class StatSetting
{

  private array $stats = [];


  public function __construct()
  {
    $this->stats = Yaml::parseFile(dirname(__DIR__, 2) . '/config/stats.yaml');
  }


  public function getHeroStats(): array
  {
    return $this->stats['stats']['hero'];
  }


  public function getBeastStats(): array
  {
    return $this->stats['stats']['beast'];
  }
}
