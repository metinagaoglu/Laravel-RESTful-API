<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;
}
