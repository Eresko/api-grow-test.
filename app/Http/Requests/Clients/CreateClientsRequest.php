<?php

declare(strict_types=1);

namespace App\Http\Requests\Clients;


use App\Http\Requests\BaseRequest;
use Illuminate\Support\Carbon;
use App\Dto\ClientDto;

class CreateClientsRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'sometimes|string',
            'birthday' => 'required|string',

        ];
    }

    public function toDTO(): ClientDto
    {
        return new ClientDto(
            $this->get('name'),
            $this->get('phone'),
            $this->get('email'),
            Carbon::parse($this->get('birthday'))->format('Y-m-d'),
        );
    }
}
