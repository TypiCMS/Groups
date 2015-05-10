<?php
namespace TypiCMS\Modules\Groups\Models;

use Cartalyst\Sentry\Groups\Eloquent\Group as SentryGroupModel;
use InvalidArgumentException;
use Laracasts\Presenter\PresentableTrait;
use Log;

class Group extends SentryGroupModel
{

    use PresentableTrait;

    protected $presenter = 'TypiCMS\Modules\Groups\Presenters\ModulePresenter';

    /**
     * Get back office’s edit url of model
     *
     * @return string|void
     */
    public function editUrl()
    {
        try {
            return route('admin.' . $this->getTable() . '.edit', $this->id);
        } catch (InvalidArgumentException $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Get front office uri
     *
     * @param  string $locale
     * @return null
     */
    public function uri($locale)
    {
        return null;
    }

    /**
     * Get back office’s index of models url
     *
     * @return string|void
     */
    public function indexUrl()
    {
        try {
            return route('admin.' . $this->getTable() . '.index');
        } catch (InvalidArgumentException $e) {
            Log::error($e->getMessage());
        }
    }
}
