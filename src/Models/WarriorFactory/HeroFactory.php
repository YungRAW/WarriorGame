<?php

namespace Razvan\Emagia\Models\WarriorFactory;


use Razvan\Emagia\Models\Warrior\BaseWarrior;
use Razvan\Emagia\Models\Warrior\HeroWarrior;
use Razvan\Emagia\Models\Setting\StatSetting;
use Razvan\Emagia\Models\Setting\SkillSetting;
use Razvan\Emagia\Models\WarriorFactory\FactoryInterface;



final class HeroFactory implements FactoryInterface
{

  public static function creator(): BaseWarrior
  {
    $stats = (new StatSetting())->getHeroStats();
    $skills = (new SkillSetting())->getHeroSkills();
    $hero = new HeroWarrior();

    $hero
      ->setName('Orderus')
      ->setHealth(mt_rand($stats['health']['min'], $stats['health']['max']))
      ->setStrength(mt_rand($stats['strength']['min'], $stats['strength']['max']))
      ->setDefence(mt_rand($stats['defence']['min'], $stats['defence']['max']))
      ->setSpeed(mt_rand($stats['speed']['min'], $stats['speed']['max']))
      ->setLuck(mt_rand($stats['luck']['min'], $stats['luck']['max']))
    ;

    foreach ($skills as $skill) {
      $className = "\\Razvan\Emagia\\Models\\Skill\\" . $skill['class_name'];
      $hero->addSkill((new $className())
        ->setName($skill['name'])
        ->setChance($skill['chance'])
        ->setValue($skill['value'])
        ->setAction($skill['action']))
      ;
    }

    return $hero;
  }
}
