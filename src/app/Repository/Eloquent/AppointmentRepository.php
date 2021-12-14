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

    /**
     * @param string|null $date
     * @param int $pagelimit
     * @return mixed
     */
    public function filterAndPaginate(?string $date,int $pagelimit)
    {
        $appointments = $this->model;
        if ($date) {
            $appointments=$this->model->where('appointment_date','>',$date);
        }
        $appointments = $appointments->paginate($pagelimit);
        return $appointments;
    }

    public function update(array $attributes,$id) {
        return $this->model->where('appointment_id',$id)->update($attributes);
    }

    public function destroy(int $id) {
        if (!is_int($id)) {
            return null;
        }
        return $this->model->find($id)->delete();
    }
}
