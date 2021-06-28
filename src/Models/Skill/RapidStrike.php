<?php

namespace Razvan\Emagia\Models\Skill;


class RapidStrike extends BaseSkill implements SkillDamageInterface
{
  
  public function specialDamage(int $damage): int
  {
    return $damage * $this->value;
  }
}
