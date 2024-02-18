<?php

declare(strict_types=1);

namespace App\Http\Requests\Dispatch;


use App\Http\Requests\BaseRequest;
use Illuminate\Support\Carbon;
use App\Dto\DispatchDto;

class DispatchRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'daily' => 'required|boolean',
            'time' => 'required|string',
            'text' => 'required|string',
            'before' => 'required|integer|digits_between:1,30',
            'after' => 'required|integer|digits_between:1,30',
            'name' => 'required|string',
        ];
    }

    public function toDTO(): DispatchDto
    {
        return new DispatchDto(
            $this->get('daily'),
            $this->get('time'),
            $this->get('text'),
            $this->get('before'),
            $this->get('after'),
            $this->get('name'),
        );
    }
}
