<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Collection;
class DispatchDto
{
    public function __construct(
        public bool $daily,
        public string $time,
        public string $text,
        public int $before,
        public int $after,
        public string $name,
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