<?php
namespace TypiCMS\Modules\Groups\Http\Controllers;

use TypiCMS\Http\Controllers\AdminSimpleController;
use TypiCMS\Modules\Groups\Repositories\GroupInterface;
use TypiCMS\Modules\Groups\Services\Form\GroupForm;
use View;

class AdminController extends AdminSimpleController
{

    /**
     * __construct
     *
     * @param GroupInterface $group
     * @param GroupForm     $groupForm
     */
    public function __construct(GroupInterface $group, GroupForm $groupForm)
    {
        parent::__construct($group, $groupForm);
        $this->title['parent'] = trans_choice('groups::global.groups', 2);

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
        $permissions = $group->getPermissions();

        return view('core::admin.edit')
            ->with(compact('permissions', 'model'));
    }
}
