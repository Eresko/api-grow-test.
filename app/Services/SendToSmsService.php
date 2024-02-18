<?php

namespace App\Services;

use App\Repository\ResultDispatchesRepository;
use Illuminate\Support\Facades\Http;
class SendToSmsService
{

    public function __construct(
        private ResultDispatchesRepository $resultDispatchesRepository
    )
    {
    }

    /**
     * @param string $phone
     * @param string $message
     * @param int $clientId
     * @param int $dispatchId
     * @return bool
     */
    public function run(string $phone,string $message,int $clientId,int $dispatchId):bool
    {
        $endpoint = 'https://smsc.ru/sys/send.php?';
        $query['login'] = config('services.smsc.login');
        $query['psw'] = config('services.smsc.password');
        $query['phones'] = $phone;
        $query['mes'] = $message;
        $query = http_build_query($query);
        $result = Http::get( $endpoint. $query);
        $res = $result->getBody()->getContents();
        if (strpos('1'.$res,'OK')>0 ) {
            $this->resultDispatchesRepository->create($clientId,$dispatchId,"OK","");
            return true;
        }
        $this->resultDispatchesRepository->create($clientId,$dispatchId,"FALSE",$res);
        return false;

        
    }


}