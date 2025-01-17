<?php

namespace App\Forms;

use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\SpladeForm;
use App\Models\Country;

class UpdateStateForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
            ->method('PUT')
            ->class('space-y-4 p-4 bg-white rounded');
    }

    public function fields(): array
    {
        return [
            Text::make('name')
                ->label('Name')->rules('required', 'max:100', 'min:3'),

            //

            Select::make('country_id')
                    ->label('Choose a country')
                    ->options(Country::pluck('name' , 'id')->toArray(),)->rules('required'),

            Submit::make()
                ->label(__('Update')),
        ];
    }
}
