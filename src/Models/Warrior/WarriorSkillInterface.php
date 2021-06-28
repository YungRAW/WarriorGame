<?php

namespace Razvan\Emagia\Models\Warrior;

use Razvan\Emagia\Models\Skill\BaseSkill;


interface WarriorSkillInterface
{

  public function getSkills(): array;


  public function addSkill(BaseSkill $skill): self;


  public function removeSkill(BaseSkill $skill): bool;
}
