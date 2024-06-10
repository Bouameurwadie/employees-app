<x-admin-layout>
    <div class="flex justify-between">
    <h1 class="text-2xl font-semibold p-4">countries</h1>
        <div class="p-4">
            <Link href="{{ route('admin.employees.create')}}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded"> New Employee</Link>
        </div>
    </div>
    <x-splade-table :for="$employees" >
        @cell('action',$employee )
<div class="space-x-2">
    <Link  href="{{ route('admin.employees.edit' , $employee )}}" class="px-3 py-2 text-green-400 rounded-md hover:text-green-700 "> Edit </Link>
    <Link  confirm="Delete the Employee "
    confirm-text="Are you sure?"
    confirm-button="Yes"
    cancel-button="No"
    href="{{ route('admin.employees.destroy' , $employee )}}" method='DELETE' class="px-3 py-2 text-red-400 rounded-md hover:text-red-700 "> Delete </Link>
</div>

        @endcell
    </x-splade-table>
</x-admin-layout>


