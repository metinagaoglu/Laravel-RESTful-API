<?php

namespace App\Repository\Eloquent;

use App\Models\Appointment;
use App\Interfaces\AppointmentRepositoryInterface;
use Illuminate\Support\Collection;

class AppointmentRepository extends BaseRepository implements AppointmentRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Appointment $model
     */
    public function __construct(Appointment $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }
}
