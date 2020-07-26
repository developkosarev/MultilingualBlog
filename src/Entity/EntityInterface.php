<?php

namespace App\Entity;

use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use App\TranslationBundle\Translation\TranslationInterface;

interface EntityInterface extends TranslatableInterface, TranslationInterface
{

}