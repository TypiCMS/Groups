<?php
namespace TypiCMS\Modules\Groups\Presenters;

use Laracasts\Presenter\Presenter;

class ModulePresenter extends Presenter
{

    /**
     * Get title
     *
     * @return string
     */
    public function title()
    {
        return $this->entity->name;
    }
}
