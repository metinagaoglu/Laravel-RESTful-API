<?php

namespace App\Interfaces;

use App\Http\Resources\AppointmentCollection;
use App\Http\Resources\AppointmentResource;
use Illuminate\Support\Collection;

interface AppointmentRepositoryInterface
{
    public function all(): Collection;

    public function find(int $id): ?AppointmentResource;

    public function filterAndPaginate(?string $date,int $pagelimit): AppointmentCollection;

    public function create(array $attributes);

    public function update(array $attributes,int $id): void;

    public function destroy(int $id): bool;
}
