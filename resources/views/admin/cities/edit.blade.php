<x-admin-layout> 
    <h1 class="text-2xl font-semibold p-4">Edit City</h1>
    <x-splade-form :for="$form" />
    {{-- <x-splade-form  :default='$country' :action="route('admin.countries.update' , $country)" method="PUT" class="p-4 bg-white rounded-md space-y-2">
        <x-splade-input name="country_code" label="Country Code" />
        <x-splade-input name="name" label="Name" />
        <x-splade-submit />
    </x-splade-form> --}}
</x-admin-layout>





