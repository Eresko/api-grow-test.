<?php

namespace App\Http\Controllers\Dispatch;

use App\Http\Requests\Dispatch\DispatchRequest;
use Illuminate\Http\Request;
use App\Services\DispatchService;
use App\Repository\ResultDispatchesRepository;
use Illuminate\Support\Carbon;
use App\Services\SendToSmsService;
class DispatchController {

    public function __construct(
        private DispatchService $dispatchService,
    ) {
    }
    /**
     * @OA\Post(
     *     path="/api/dispatch",
     *     tags={"Отправка"},
     *     summary="создвание рассылки",
     *    @OA\RequestBody(
     *          @OA\JsonContent(
     *                  type="object",
     *                  required={"daily","time","text", "before", "after","name"},
     *                 @OA\Property(
     *                      property="daily",
     *                      type="boolean",
     *                      description="Флаг ежедневности",
     *                      example=true,
     *                  ),
     *                @OA\Property(
     *                      property="time",
     *                      type="string",
     *                      description="время выполнения",
     *                      example="10:30",
     *                  ),
     *               @OA\Property(
     *                      property="text",
     *                      type="string",
     *                      description="тест рассылки",
     *                      example="1",
     *                      example="Как дела",
     *                  ),
     *               @OA\Property(
     *                      property="before",
     *                      type="number",
     *                      description="Кол-во дней до",
     *                      example="4",
     *                  ),
     *               @OA\Property(
     *                       property="after",
     *                       type="number",
     *                       description="Кол-во дней после",
     *                       example="0",
     *                   ),
     *               @OA\Property(
     *                        property="name",
     *                        type="string",
     *                        description="Название рассылки",
     *                        example="10000",
     *                    ),
     *           )
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Упешная отправка",
     *         @OA\JsonContent(
     *                 type="object",
     *                 required={"success","result"},
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean",
     *                 ),
     *          ),
     *     )
     * )
     */
    public function create(DispatchRequest $request)
    {
        $res = $this->dispatchService->create($request->toDto());
        return response()->json([
            'success' => $res
        ]);
    }



    /**
     * @OA\Get(
     *     path="/api/dispatch",
     *     tags={"Отправка"},
     *     summary="Статистика",
     *     @OA\Parameter(
     *        name="page",
     *        in="query",
     *        @OA\Schema(
     *                type="integer"
     *            )
     *       ),
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
     *                       @OA\Property(property="countOk", type="integer"),
     *                       @OA\Property(property="countFalse", type="integer"),
     *                       @OA\Property(property="id", type="integer"),
     *                       @OA\Property(property="name", type="string"),
     *                     )
     *                    ),
     *                  ),
     *           ),
     *      )
     * )
     */
    public function statistic(Request $request)
    {

        return response()->json([
            'result' =>$this->dispatchService->getStatistics(intval($request->page)),
        ]);
    }



}