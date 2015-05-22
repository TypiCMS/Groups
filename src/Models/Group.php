<?php
namespace TypiCMS\Modules\Groups\Models;

use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Group extends Base
{

    use Historable;
    use PresentableTrait;

    protected $presenter = 'TypiCMS\Modules\Groups\Presenters\ModulePresenter';

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
     * One group has many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsToMany('TypiCMS\Modules\Users\Models\User');
    }

    /**
     * Mutator for giving permissions.
     *
     * @param  mixed  $permissions
     * @return array  $_permissions
     */
    public function getPermissionsAttribute($permissions)
    {
        if (! $permissions) {
            return [];
        }
        if (is_array($permissions)) {
            return $permissions;
        }
        return json_decode($permissions, true);
    }
}
