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

    protected $fillable = [
        'name',
        'permissions',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions' => 'array',
    ];

    /**
     * Get front office uri.
     *
     * @param string $locale
     *
     * @return string
     */
    public function uri($locale = null)
    {
        return '/';
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
}
