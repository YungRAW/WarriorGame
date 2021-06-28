<?php

namespace Razvan\Emagia\Models\Skill;


interface SkillDamageInterface
{
  public function specialDamage(int $damage): int;
}
