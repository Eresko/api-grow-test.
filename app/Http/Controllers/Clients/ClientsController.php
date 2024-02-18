<?php

namespace App\Http\Controllers\Clients;


use Illuminate\Http\Request;
use App\Services\ClientsService;


class ClientsController {

    public function __construct(
        private ClientsService $clientsService
    ) {
    }




    /**
     * @OA\Get(
     *     path="/api/clients",
     *     tags={"Пользователи"},
     *     summary="Список клиентов",
     *     @OA\Parameter(
     *        name="page",
     *        in="query",
     *        @OA\Schema(
     *                type="integer"
     *            )
     *       ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         @OA\Schema(
     *                 type="string"
     *             )
     *        ),
     *     @OA\Response(
     *          response="200",
     *          description="",
     *          @OA\JsonContent(
     *                  type="object",
     *                  required={"result"},
     *                  @OA\Property(
     *                      property="result",
     *                      type="object",
     *                      required={"currentPage","perPage","total","lastPage","data"},
     *                    @OA\Property(
     *                       property="currentPage",
     *                       type="integer",
     *                   ),
     *                   @OA\Property(
     *                        property="perPage",
     *                        type="integer",
     *                    ),
     *                   @OA\Property(
     *                        property="total",
     *                        type="integer",
     *                    ),
     *                  @OA\Property(
     *                         property="lastPage",
     *                         type="integer",
     *                     ),
     *                    @OA\Property(
     *                        property="data",
     *                        type="array",
     *                      @OA\Items(
     *                       @OA\Property(property="id", type="integer"),
     *                       @OA\Property(property="name", type="string"),
     *                       @OA\Property(property="phone", type="string"),
     *                       @OA\Property(property="birthday", type="string"),
     *                       @OA\Property(property="created_at", type="string"),
     *                       @OA\Property(property="updated_at", type="string"),
     *                     )
     *                    ),
     *                  ),
     *           ),
     *      )
     * )
     */
    public function getClients(Request $request)
    {

        return response()->json([
            'result' => $this->clientsService->list(intval($request->page),empty($request->search) ? "" : $request->search)
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/clients/count",
     *     tags={"Пользователи"},
     *     summary="кол-во пользователей",
     *     @OA\Response(
     *          response="200",
     *          description="",
     *          @OA\JsonContent(
     *                  type="object",
     *                  required={"result"},
     *                  @OA\Property(
     *                      property="result",
     *                      type="number",
     *
     *
     *                  ),
     *           ),
     *      )
     * )
     */
    public function getCountClients(Request $request)
    {

        return response()->json([
            'result' => $this->clientsService->count()
        ]);
    }



}