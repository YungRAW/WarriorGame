<?php

namespace Razvan\Emagia\Models\Warrior;

use Razvan\Emagia\Models\Warrior\BaseWarrior;
use Razvan\Emagia\Models\Skill\BaseSkill;


class HeroWarrior extends BaseWarrior implements WarriorSkillInterface
{
  use WarriorSkillTrait;
}
