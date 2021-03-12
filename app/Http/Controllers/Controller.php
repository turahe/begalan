<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

/**
 * Class Controller.
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * get formatting error from Exception.
     *
     * @param mixed $e
     * @return string
     */
    public function eMessage($e): string
    {
        return $e->getCode().': '.$e->getMessage().' : '.$e->getFile().' : '.$e->getLine().' : '.request()->ip().' : '.request()->url();
    }
}
