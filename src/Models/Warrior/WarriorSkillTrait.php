<?php

namespace Razvan\Emagia\Models\Warrior;

use Razvan\Emagia\Models\Skill\BaseSkill;


trait WarriorSkillTrait
{
  
  protected array $skills = [];



  public function getSkills(): array
  {
    return $this->skills;
  }


  public function addSkill(BaseSkill $skill): self
  {
    $this->skills[$skill->getClassName()] = $skill;

    return $this;
  }

 
  public function removeSkill(BaseSkill $skill): bool
  {
    $key = array_search($skill, $this->skills, true);

    if ($key === false) {
      return false;
    }

    unset($this->skills[$key]);

    return true;
  }
}
