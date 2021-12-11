<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface AppointmentRepositoryInterface
{
    public function all(): Collection;
}
