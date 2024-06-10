<x-admin-layout>



    <div class="flex justify-between">
    <h1 class="text-2xl font-semibold p-4">Roles</h1>
        <div class="p-4">
            <Link href="{{ route('admin.roles.create')}}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded"> New Role</Link>
        </div>
    </div>
    <x-splade-table :for="$roles" >
        @cell('action',$role )
<div class="space-x-2">

    <Link  href="{{ route('admin.roles.edit' , $role )}}" class="px-3 py-2 text-green-400 rounded-md hover:text-green-700 "> Edit </Link>
    <Link  confirm="Delete the Role "
    confirm-text="Are you sure?"
    confirm-button="Yes"
    cancel-button="No"
    href="{{ route('admin.roles.destroy' , $role )}}" method='DELETE' class="px-3 py-2 text-red-400 rounded-md hover:text-red-700 "> Delete </Link>

</div>

        @endcell
    </x-splade-table>
</x-admin-layout>


