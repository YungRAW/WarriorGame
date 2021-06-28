<?php

namespace Razvan\Emagia\Models\Setting;

use Symfony\Component\Yaml\Yaml;

class SkillSetting
{

  private array $skills = [];


  public function __construct()
  {
    $this->skills = Yaml::parseFile(dirname(__DIR__, 2) . '/config/skills.yaml');
  }


  public function getHeroSkills(): array
  {
    return $this->skills['skills']['hero'];
  }
}
