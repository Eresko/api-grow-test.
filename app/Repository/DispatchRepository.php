<?php

namespace App\Repository;

use App\Dto\DispatchDto;
use App\Models\Dispatch;
use App\Models\DispatchList;
use Illuminate\Support\Collection;
class DispatchRepository
{

    public function __construct(
        private ClientRepository $clientRepository,
    )
    {
    }

    /**
     * @param DispatchDto $dto
     * @param string|null $type
     * @return bool
     */
    public function create(DispatchDto $dto,string | null $type = null):bool {

        $dispatch = Dispatch::create($dto->toArray());
        
        if ((!empty($dispatch)) && ($type == "all")){
            $this->createListDispatch($dispatch->id);

        }
        return (!empty($dispatch));
    }

    /**
     * @param int $dispatchId
     * @return void
     */
    protected function createListDispatch(int $dispatchId):void
    {
        $clients = $this->clientRepository->get("");
        foreach ($clients as $client) {
            DispatchList::create([
                'client_id' => $client->id,
                'dispatch_id' => $dispatchId,
            ]);
        }
    }
    

}