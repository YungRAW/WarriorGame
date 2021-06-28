<?php

namespace Razvan\Emagia\Controllers;

use Razvan\Emagia\Models\Action\AttackAction;
use Razvan\Emagia\Models\Action\DefenceAction;
use Razvan\Emagia\Models\Outputer\BattleOutputer;
use Razvan\Emagia\Models\Setting\BattleSetting;
use Razvan\Emagia\Models\Skill\SkillDamageInterface;
use Razvan\Emagia\Models\Warrior\BaseWarrior;
use Razvan\Emagia\Models\Warrior\WarriorSkillInterface;
use Razvan\Emagia\Models\WarriorFactory\BeastFactory;
use Razvan\Emagia\Models\WarriorFactory\HeroFactory;

class BattleController
{

  private int $currentTurn = 0;

  private array $battleSettings;

 
  private BaseWarrior $attacker;

 
  private BaseWarrior $defender;

  private BattleOutputer $outputer;


  
  public function __construct(BattleSetting $battleSetting, BattleOutputer $battleOutputer)
  {
    $this->battleSettings = $battleSetting->getSettings();
    $this->outputer = $battleOutputer;
  }

  
  public function startBattle(): void
  {
    $this->outputer->output('Emagia battle simulator.');
    $this->init();
  }

  
  private function init(): void
  {
    $this->addPlayers();
    $this->firstAttack();
  }

  
  private function addPlayers(): void
  {
    $this->attacker = HeroFactory::creator();
    $this->defender = BeastFactory::creator();

    $this->outputer->output('Warriors initialized.');
  }

  
  private function firstAttack(): void
  {
    switch (true) {
      case $this->attacker->getSpeed() < $this->defender->getSpeed():
        $this->switchRoles();
        break;
      case $this->attacker->getSpeed() == $this->defender->getSpeed():
        switch (true) {
          case $this->attacker->getLuck() < $this->defender->getLuck():
            $this->switchRoles();
            break;
          case $this->attacker->getLuck() == $this->defender->getLuck():
            if (mt_rand(1, 2) == 2) {
              $this->switchRoles();
            }
            break;
        }
        break;
    }

    $this->outputer->output(sprintf('First attacker: %s', $this->attacker->getName()));
  }

  
  private function switchRoles(): void
  {
    $tmp = $this->defender;
    $this->defender = $this->attacker;
    $this->attacker = $tmp;
  }

  
  public function nextTurn(): bool
  {
    $this->currentTurn++;

    if ($this->attacker->getHealth() <= 0 || $this->defender->getHealth() <= 0)
      return false;

    if ($this->currentTurn > $this->battleSettings['nr_turns'])
      return false;

    return true;
  }

  
  public function playTurn(): void
  {
    $this->outputer->output(PHP_EOL);
    $this->outputer->output(sprintf('Characters stats before turn %d start', $this->currentTurn));
    $this->outputer->characterStats($this->attacker);
    $this->outputer->characterStats($this->defender);
    $this->outputer->output(sprintf('Turn %d - Beginining', $this->currentTurn));

    $damage = $this->attacker->getStrength() - $this->defender->getDefence();
    $damage = $this->damageGeneratedBySkill($damage, $this->attacker, AttackAction::ACTION);
    $damage = $this->damageGeneratedBySkill($damage, $this->defender, DefenceAction::ACTION);

    $this->outputer->output(sprintf('Attacker: %s --> Defender: %s',
      $this->attacker->getName(),
      $this->defender->getName()
    ));
    $this->outputer->output(sprintf('%s attacks %s with a final damage of %d',
      $this->attacker->getName(),
      $this->defender->getName(),
      $damage
    ));

    $this->defender->setHealth(max($this->defender->getHealth() - $damage, 0));
    $this->outputer->output(sprintf('Turn %d - End', $this->currentTurn));
    $this->outputer->output(sprintf('Characters health after turn %d end', $this->currentTurn));
    $this->outputer->characterHealth($this->attacker);
    $this->outputer->characterHealth($this->defender);
    $this->switchRoles();
  }


  private function damageGeneratedBySkill(int $damage, BaseWarrior $character, string $action): int
  {
    if($character instanceof WarriorSkillInterface) {
      foreach ($character->getSkills() as $skill) {
        if($skill instanceof SkillDamageInterface && $skill->getAction() == $action && $skill->isUsed()) {
          $damage = $skill->specialDamage($damage);

          switch ($action) {
            case $action == AttackAction::ACTION:
              $this->outputer->output(sprintf('%s activates %s skill for attack. Damage: %d',
                $character->getName(),
                $skill->getName(),
                $damage
              ));
              break;
            case $action == DefenceAction::ACTION:
              $this->outputer->output(sprintf('%s activates %s skill for defence. Damage: %d',
                $character->getName(),
                $skill->getName(),
                $damage
              ));
              break;
          }
        }
      }
    }

    return $damage;
  }

  public function endBattle(): void
  {
    $this->outputer->output(PHP_EOL);
    $this->outputer->output('Battle has ended');
    $this->outputer->characterStats($this->attacker);
    $this->outputer->characterStats($this->defender);

    switch (true) {
      case $this->attacker->getHealth() <= 0:
        $this->outputer->output(sprintf('Winner: %s', $this->defender->getName()));
        break;
      case $this->defender->getHealth() <= 0:
        $this->outputer->output(sprintf('Winner: %s', $this->attacker->getName()));
        break;
      case $this->currentTurn > $this->battleSettings['nr_turns']:
        $this->outputer->output('Tied Game');
        break;
    }
  }
}
