<?php

namespace TypiCMS\Modules\Groups\Repositories;

use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;
use TypiCMS\Modules\Groups\Models\Group;

class EloquentGroup extends RepositoriesAbstract implements GroupInterface
{
    public function __construct(Group $model)
    {
        $this->model = $model;
    }

    /**
     * Get all models.
     *
     * @param array $with Eager load related models
     * @param bool  $all  Show published or all
     *
     * @return Collection|NestedCollection
     */
    public function all(array $with = [], $all = false)
    {
        return $this->make($with)->order()->get();
    }
}
