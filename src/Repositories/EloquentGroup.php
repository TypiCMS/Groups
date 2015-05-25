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
        $model = $this->model;

        $groupData = array_except($data, ['_method','_token', 'id', 'exit']);
        $groupData['permissions'] = $this->permissions($data);

        foreach ($groupData as $key => $value) {
            $model->$key = $value;
        }

        if ($model->save()) {
            return $model;
        }

        return false;
    }

    /**
     * Update an existing model
     *
     * @param  array  $data
     * @return boolean
     */
    public function update(array $data)
    {
        $group = $this->model->find($data['id']);

        $groupData = array_except($data, ['_method', '_token', 'exit']);
        $groupData['permissions'] = $this->permissions($data);

        foreach ($groupData as $key => $value) {
            $group->$key = $value;
        }

        if ($group->save()) {
            return true;
        }

        return false;

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
