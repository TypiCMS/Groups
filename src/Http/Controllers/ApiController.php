<?php
namespace TypiCMS\Modules\Groups\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Groups\Repositories\GroupInterface as Repository;

class ApiController extends BaseApiController
{
    public function __construct(Repository $repository)
    {
        parent::__construct($repository);
    }
}
