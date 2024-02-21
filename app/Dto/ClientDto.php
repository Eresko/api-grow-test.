<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Collection;
class ClientDto
{
    public function __construct(
        public string $name,
        public string $phone,
        public string|null $email,
        public string $birthday,
    ) {
    }

    public function toArray():array {
        $res = [];
        foreach ($this as $key => $item) {
            $res[$key] = $item;
        }
        return $res;
    }

}