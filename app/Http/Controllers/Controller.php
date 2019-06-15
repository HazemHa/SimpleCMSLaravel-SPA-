<?php
namespace AppHttpControllers;

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $messgeSuccess = array('success' => 'task completed successfully');


    public $messageError = array('error' => 'task not completed successfully');
    public function createResponseMessage($result)
    {
        if ($result) {
            return response()->json($this->messgeSuccess);
        } else {
            return response()->json($this->messageError);
        }
    }
}