<?php
namespace TypiCMS\Modules\Groups\Repositories;

use TypiCMS\Modules\Groups\Models\Group;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;

class EloquentGroup extends RepositoriesAbstract implements GroupInterface
{

    public function __construct(Group $model)
    {
        $this->model = $model;
    }

    /**
     * Get all models
     *
     * @param  array       $with Eager load related models
     * @param  boolean     $all  Show published or all
     * @return Collection|NestedCollection
     */
    public function all(array $with = array(), $all = false)
    {
        return $this->make($with)->order()->get();
    }

}
