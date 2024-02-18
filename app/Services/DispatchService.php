<?php

namespace App\Services;


use App\Dto\PaginationRequestDto;
use App\Repository\DispatchRepository;
use App\Repository\ResultDispatchesRepository;
use App\Dto\DispatchDto;
use App\Repository\ClientRepository;
class DispatchService
{

    public function __construct(
        private DispatchRepository $dispatchRepository,
        private ClientRepository $clientRepository,
        private ResultDispatchesRepository $resultDispatchesRepository,
        private SendToSmsService $sendToSmsService,
        private PaginationService $paginationService,
    )
    {
    }

    /**
     * @param DispatchDto $dto
     * @return bool
     */
    public function create(DispatchDto $dto):bool
    {

        return $this->dispatchRepository->create($dto,"all");

    }


    /**
     * @return void
     */
    public function send():void {
        $listDispatches = $this->clientRepository->getListWithDispatch();
        $listDispatches->map( function ($listDispatch) {
            $this->sendToSmsService->run($listDispatch->phone,$listDispatch->text,$listDispatch->id,$listDispatch->dispatch_id);
        });
    }

    /**
     * @param int $page
     * @return PaginationRequestDto
     */

    public function getStatistics(int $page = 1):PaginationRequestDto {
        $statistics = $this->resultDispatchesRepository->stat();
        return $this->paginationService->toPagination($statistics,$page,10);
    }

}