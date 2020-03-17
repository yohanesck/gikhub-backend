<?php

namespace App\Exceptions;

use Exception;

class DuplicateEmailException extends Exception
{
    public static function render()
    {
        return response()->json([
            'message' => 'The email has already been taken.'
        ], 409);
    }
}
