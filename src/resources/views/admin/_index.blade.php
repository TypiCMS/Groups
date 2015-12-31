<div ng-app="typicms" ng-cloak ng-controller="ListController">

    <a href="{{ route('admin.' . $module . '.create') }}" class="btn-add"><i class="fa fa-plus-circle"></i><span class="sr-only">New</span></a>
    <h1>
        <span>@{{ models.length }} @choice('groups::global.groups', 2)</span>
    </h1>

    @include('core::admin._tabs-lang-list')

    <div class="table-responsive">

        <table st-persist="groupsTable" st-table="displayedModels" st-safe-src="models" st-order st-filter class="table table-condensed table-main">
            <thead>
                <tr>
                    <th class="delete"></th>
                    <th class="edit"></th>
                    <th st-sort="name" class="name st-sort">Name</th>
                    <th st-sort="permissions" class="permissions st-sort">Permissions</th>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>
                        <input st-search="name" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                    <td>
                        <input st-search="permissions" class="form-control input-sm" placeholder="@lang('global.Search')…" type="text">
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr ng-repeat="model in displayedModels">
                    <td typi-btn-delete action="delete(model, model.name)"></td>
                    <td>
                        @include('core::admin._button-edit')
                    </td>
                    <td>@{{ model.name }}</td>
                    <td>@{{ model.permissions }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" typi-pagination></td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>
