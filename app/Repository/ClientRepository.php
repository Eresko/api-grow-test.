<?php

namespace App\Repository;

use Illuminate\Support\Carbon;
use App\Models\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Dto\ClientDto;

class ClientRepository
{

    /**
     * @param string $search
     * @return Collection
     */
    public function get(string $search):Collection {

        if (trim($search) == "") {
            return Client::query()->get();
        }

        return Client::query()->where("name",'LIKE','%'.$search.'%')->get();
    }


    /**
     * @return Collection
     */
    public function getListWithDispatch():Collection {
        return Client::query()
            ->leftJoin('dispatch_list', 'dispatch_list.client_id', '=', 'clients.id')
            ->leftJoin('dispatches', 'dispatch_list.dispatch_id', '=', 'dispatches.id')
            ->where('dispatches.time',Carbon::now()->format('H:i:00'))
            ->select([
                DB::raw('DATE_FORMAT(DATE_SUB(clients.birthday,INTERVAL dispatches.before DAY),"%m%d")  as date_before'),
                DB::raw('DATE_FORMAT(DATE_ADD(clients.birthday,INTERVAL dispatches.after DAY),"%m%d")  as date_after'),
                "clients.id AS id",
                "clients.name AS name",
                "clients.email AS email",
                "clients.phone AS phone",
                "clients.birthday AS birthday",
                "dispatches.text AS text",
                "dispatches.id AS dispatch_id"
            ])
            ->get()->where('date_before','<',Carbon::now()->format('md'))->where('date_after','>',Carbon::now()->format('md'));


    }

    public function count():int {
        return Client::query()->count();
    }


    public function create(ClientDto $dto):bool {

       
        $client = Client::create($dto->toArray());


        return (!empty($client));
    }


}