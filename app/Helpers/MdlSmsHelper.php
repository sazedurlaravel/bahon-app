<?php
namespace App\Helpers;

use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class MdlSmsHelper
{
    /**
     * mdlSmsSend
     *
     * @param  mixed $contacts
     * @param  mixed $message
     * @return void
     */
    public function send($contacts, $message)
    {
        /**
         * app environment is local send sms in message log
         */
        if(app()->environment('local')) {
            Log::channel('message')->info($message);
            return true;
        }

        try {
            /**
             * get mdlsms information
             * send sms via mdlsms to contacts
             */
            $response = Http::get(config('mdlsms.url'), [
                'api_key'  => config('mdlsms.api_key'),
                'type'     => 'text',
                'contacts' => $contacts,
                'senderid' => config('mdlsms.senderid'),
                'msg'      => $message,
            ]);
    
            return $response;
        } catch(Throwable $e) {
            report($e);
            return false;
        }
    }
}