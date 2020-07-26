<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\EntityInterface;

class TranslationService
{
    public function translateEntity(Request $request, EntityInterface $entity)
    {
        $requestData = json_decode($request->getContent());
        $translations = $requestData->translation;
        foreach ($translations as $lang => $value) {
            $entity->setTranslatableProperties($lang, $value);
        }
        // In order to persist new translations, call mergeNewTranslations method, before flush
        $entity->mergeNewTranslations();
        return $entity;
    }
}