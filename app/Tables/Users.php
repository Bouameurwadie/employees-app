<?php

namespace App\Tables;

use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Users extends AbstractTable
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
                        ->orWhere('username', 'LIKE', "%{$value}%")
                        ->orWhere('first_name', 'LIKE', "%{$value}%")
                        ->orWhere('last_name', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
                });
            });
        });
        // return User::query();
        return QueryBuilder::for(User::whereDoesntHave('roles', function($q){ 
            $q->where('name','admin');
        
        }))
        ->defaultSort('username')
        ->allowedSorts(['id','username','first_name','last_name' ,'email','created_at'])
        ->allowedFilters(['username', 'first_name','last_name','email', 'created_at',$globalSearch]);
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     * 
     * 
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['id','username', 'first_name','last_name','email'])
            ->column('id', sortable: true)
            ->column('username', sortable: true)
            ->column('first_name', sortable: true , hidden: true)
            ->column('last_name', sortable: true , hidden: true)
            ->column('email', sortable: true)
            ->column('created_at', sortable: true , hidden: true)
            ->column('action')
            ->paginate(15);
            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()
            // ->bulkAction()
            // ->export()
    }
}
