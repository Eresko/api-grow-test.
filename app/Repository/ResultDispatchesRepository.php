<?php

namespace App\Repository;

use App\Dto\DispatchDto;
use App\Models\ResultDispatches;
use App\Models\DispatchList;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
class ResultDispatchesRepository
{

    public function __construct(
        private ClientRepository $clientRepository,
    )
    {
    }

    /**
     * @param int $clientId
     * @param int $dispatchId
     * @param string $status
     * @param string $error
     * @return bool
     */
    public function create(int $clientId,int $dispatchId,string $status,string $error):bool
    {
        $res = ResultDispatches::create([
            'client_id' => $clientId,
            'dispatch_id' => $dispatchId,
            'status' => $status,
            'error' => $error,
        ]);
        return (!empty($res));
    }

    /**
     * @return Collection
     */
    public function stat():Collection
    {
        return ResultDispatches::query()
            ->join('dispatches', 'result_dispatches.dispatch_id', '=', 'dispatches.id')
            ->select([
                DB::raw('COUNT(result_dispatches.status = "OK" OR NULL) AS countOk'),
                DB::raw('COUNT(result_dispatches.status = "FALSE" OR NULL) AS countFalse'),
                "dispatches.id AS id",
                "dispatches.name AS name",
            ])
            ->groupBy("dispatches.id")
            ->get();
    }
    

}