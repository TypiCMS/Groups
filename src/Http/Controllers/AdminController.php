<?php
namespace TypiCMS\Modules\Groups\Http\Controllers;

use TypiCMS\Http\Controllers\AdminSimpleController;
use TypiCMS\Modules\Groups\Http\Requests\FormRequest;
use TypiCMS\Modules\Groups\Repositories\GroupInterface;
use View;

class AdminController extends AdminSimpleController
{

    /**
     * __construct
     *
     * @param GroupInterface $group
     */
    public function __construct(GroupInterface $group)
    {
        parent::__construct($group);

        // Establish Filters
        $this->beforeFilter('inGroup:Admins');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit($model)
    {
        $this->title['child'] = trans('groups::global.Edit');
        $permissions = $model->getPermissions();

        return view('core::admin.edit')
            ->with(compact('permissions', 'model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FormRequest $request
     * @return Redirect
     */
    public function store(FormRequest $request)
    {
        $model = $this->repository->create($request->all());
        return $this->redirect($request, $model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $model
     * @param  FormRequest $request
     * @return Redirect
     */
    public function update($model, FormRequest $request)
    {
        $this->repository->update($request->all());
        return $this->redirect($request, $model);
    }
}
