<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface ContactRepositoryInterface
{
    public function all(): Collection;
}
