<?php

namespace App\Exceptions;

use Exception;

class ForbiddenException extends Exception
{
    public static function render()
    {
        return response()->json([
            'message' => 'Data could not be processed'
        ], 403);
    }
}
