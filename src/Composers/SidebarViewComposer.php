<?php

namespace TypiCMS\Modules\Groups\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.users'), function (SidebarGroup $group) {
            $group->addItem(trans('groups::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.groups.sidebar.icon', 'icon fa fa-fw fa-users');
                $item->weight = config('typicms.groups.sidebar.weight');
                $item->route('admin.groups.index');
                $item->append('admin.groups.create');
                $item->authorize(
                    $this->auth->hasAccess('groups.index')
                );
            });
        });
    }
}
