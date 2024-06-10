<?php

namespace App\Tables;

use App\Models\Permission;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Role;
use Spatie\Permission\Models\Permission as ModelsPermission;


class Permissions extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%");
                });
            });
        });
        // return User::query();
        return QueryBuilder::for(ModelsPermission::where('name','!=','admin'))
        ->defaultSort('name')
        ->allowedSorts(['id','name','created_at'])
        ->allowedFilters(['name','created_at',$globalSearch]);
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
        ->withGlobalSearch(columns: ['id','name'])
        ->column('id', sortable: true)
        ->column('name', sortable: true)
        ->column('created_at', sortable: true , hidden: true)
        ->column('action')
        ->paginate(15);
    }
}
