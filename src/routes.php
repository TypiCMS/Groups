<?php
Route::model('groups', 'TypiCMS\Modules\Groups\Models\Group');

Route::group(
    array(
        'namespace' => 'TypiCMS\Modules\Groups\Controllers',
        'prefix'    => 'admin',
    ),
    function () {
        Route::resource('groups', 'AdminController');
    }
);

Route::group(['prefix'=>'api'], function() {
    Route::resource('groups', 'ApiController');
});
