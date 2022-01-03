<?php

namespace App\Repository\Eloquent;

use App\Http\Resources\AppointmentCollection;
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
        $appointments->with('User');
        $appointments->with('Contact');
        $appointments = $appointments->paginate($pagelimit);
        return new AppointmentCollection($appointments);
    }

    public function update(array $attributes,$id) {
            $appointment = $this->model->where('appointment_id',$id)->first();
            $appointment->update($attributes);
    }

    public function destroy(int $id): bool
    {
        if (!is_int($id)) {
            return false;
        }
        $appointment = $this->model->find($id);
        if (!$appointment) {
            return false;
        }
        return $appointment->delete();
    }
}
