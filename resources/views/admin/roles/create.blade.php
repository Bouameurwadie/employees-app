<x-admin-layout>
    <h1 class="text-2xl font-semibold p-4">New Role</h1>
    <x-splade-form :action="route('admin.roles.store')" class="p-4 bg-white rounded-md space-y-2">
        <x-splade-input name="name" label="Name" />
        <x-splade-select name="permissions[]"   :options="$permissions" multiple relation choices option-value="name"  />
        <x-splade-submit />
    </x-splade-form>
</x-admin-layout>
