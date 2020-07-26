<?php

namespace App\TranslationBundle\Translation;

interface TranslationInterface
{
    public function getTranslation();

    public function setTranslatableProperties($lang, $value);
}
