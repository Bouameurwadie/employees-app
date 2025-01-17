<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country ;
use App\Tables\Countries ;
use ProtoneMedia\Splade\Facades\Splade;
use App\Http\Requests\StoreCountryRequest ;
use App\Http\Requests\UpdateCountryRequest;

use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Password;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;




class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return view('admin.countries.index',[
            'countries'=> Countries::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCountryRequest $request)
    {
        //
        Country::create($request->validated());
        Splade::toast('Coutry Created')->autoDismiss(3);
        return to_route('admin.countries.index');

    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        // return view('admin.countries.edit', compact('country'));
        $form = SpladeForm::make()
        ->action(route('admin.countries.update' , $country))
        ->fields([
            Input::make('country_code')->label('Country Code'),
            Input::make('name')->label('Name'),
            Submit::make()->label('Update'),
        ])->fill($country)
        ->class('space-y-4')
        ->method("PUT");

        return view('admin.countries.edit', [
            'form' => $form,
            'country'=>$country,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */



    public function update(UpdateCountryRequest $request, Country $country)
    {
        //
        $country->update($request->validated());
        Splade::toast('Country uptated')->autoDismiss(3);
        return to_route('admin.countries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        //
        $country->delete();
        Splade::toast('Country deleted')->autoDismiss(3);
        // return to_route('admin.users.index');
        return back();
    }
}
