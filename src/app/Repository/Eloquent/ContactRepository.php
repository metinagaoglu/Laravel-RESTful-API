<?php

namespace App\Repository\Eloquent;

use App\Models\Contact;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Collection;

class ContactRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(Contact $model)
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
