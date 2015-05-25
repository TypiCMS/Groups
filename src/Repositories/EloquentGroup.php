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

    /**
     * Create a new model
     *
     * @param  array $data
     * @return mixed Model or false on error during save
     */
    public function create(array $data)
    {
        $data['permissions'] = $this->permissions($data);
        return parent::create($data);
    }

    /**
     * Update an existing model
     *
     * @param  array  $data
     * @return boolean
     */
    public function update(array $data)
    {
        $data['permissions'] = $this->permissions($data);
        return parent::update($data);
    }

    /**
     * get extract and encode permissions from array
     *
     * @param  array $data
     * @return string|null
     */
    private function permissions($data)
    {
        if (isset($data['permissions'])) {
            return json_encode($data['permissions']);
        }
        return null;
    }

}
