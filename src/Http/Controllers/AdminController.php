<?php

namespace TypiCMS\Modules\Groups\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Groups\Http\Requests\FormRequest;
use TypiCMS\Modules\Groups\Models\Group;
use TypiCMS\Modules\Groups\Repositories\GroupInterface;

class AdminController extends BaseAdminController
{
    public function __construct(GroupInterface $group)
    {
        parent::__construct($group);
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->getModel();

        return view('core::admin.create')
            ->with(compact('model'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Group $group, $child = null)
    {
        return view('core::admin.edit')
            ->with([
                'model'       => $group,
                'permissions' => $group->permissions,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Groups\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $group = $this->repository->create($request->all());

        return $this->redirect($request, $group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Groups\Models\Group              $group
     * @param \TypiCMS\Modules\Groups\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Group $group, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $group);
    }
}
