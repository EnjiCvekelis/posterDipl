<?php

namespace App\Http\Controllers\Client;


use App\Core\Services\Infrastructure\IMailService;

use App\Http\Controllers\Client\Base\ClientControllerBase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class RequestController extends ClientControllerBase
{

    /**

     * @var IMailService

     */

    private $_mailService;

    public function __construct(IMailService $mailService)

    {
        $this->_mailService = $mailService;
    }


    public function add(Request $request)
    {
        $validator = \Validator::make(
            $request->all(),
            [
                'name' => 'bail|required|max:255',
                'email' => 'bail|required|max:255|email',
                'message' => 'bail|required'
            ],

            [],
//
            []


        );

        if (!$validator->passes()) {

            return response()->json(['errors' => $validator->errors()]);

        }

        $this->_mailService->send();



        return response()->json('success');

    }

}