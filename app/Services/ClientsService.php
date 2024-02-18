<?php

namespace App\Services;


use App\Repository\ClientRepository;
use App\Dto\PaginationRequestDto;

class ClientsService
{

    public function __construct(
        private ClientRepository $clientRepository,
        private PaginationService $paginationService,
    )
    {
    }

    /**
     * @param int $page
     * @param string $search
     * @return PaginationRequestDto
     */
    public function list(int $page = 1,string $search = ""):PaginationRequestDto
    {

        $files = $this->clientRepository->get($search);
        return $this->paginationService->toPagination($files,$page,10);
    }

    /**
     * @return int
     */
    public function count():int
    {

        return $this->clientRepository->count();

    }


}