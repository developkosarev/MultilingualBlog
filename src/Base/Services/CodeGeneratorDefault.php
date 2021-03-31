<?php

namespace App\Base\Services;

use App\Base\Interfaces\CodeGeneratorInterface;

class CodeGeneratorDefault implements CodeGeneratorInterface
{
    public function generateCode()
    {
        return 'new_code1';
    }
}
