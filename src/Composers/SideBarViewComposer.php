<?php
namespace TypiCMS\Modules\Groups\Composers;

use Illuminate\View\View;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        $view->menus['users']->put('groups', [
            'weight' => config('typicms.groups.sidebar.weight'),
            'request' => $view->prefix . '/groups*',
            'route' => 'admin.groups.index',
            'icon-class' => 'icon fa fa-fw fa-user',
            'title' => 'Groups',
        ]);
    }
}
