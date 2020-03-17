<?php

namespace App\Exceptions;

use Exception;

class DuplicateKTPException extends Exception
{
    public static function render()
    {
        return response()->json([
            'message' => 'The KTP number has already been taken.'
        ], 409);
    }
}
