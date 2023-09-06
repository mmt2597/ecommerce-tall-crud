<section class="categories-container">
    @if(session('flash.banner'))
        <x-banner />
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-end">
                <x-button wire:click="toggleModal(true)" class="mb-4">Add Category</x-button>
            </div>
            
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-white">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Parent Category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span>Actions</span>
                                </th>
                            </tr>
                        </thead
                            @if($categories && !$categories->isEmpty())
                                @foreach ($categories as $category)
                                    <tr :key="{{ $category->id }}" class="hover:bg-gray-50 dark:hover:bg-gray-100">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $category->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $category->parentCategory }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a wire:click="showEditCategoryModal({{$category->id}})" href="javascript:;" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            <a wire:click="deleteCategory({{$category->id}})" href="javascript:;" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-100">
                                    <td  colspan="5" class="px-6 py-4 text-center">
                                        No Records Found
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
                @if($categories && $categories->total() > 10)
                    <div class="p-3">
                        {{ $categories->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>

    <x-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ $categoryId ? 'Update' : 'Create' }}  Category
        </x-slot>

        <x-slot name="content">
            <form>
                <div class="col-span-6 sm:col-span-3">
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                    <div class="mt-2">
                        <input 
                            wire:model="categoryName" 
                            type="text" 
                            id="name"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            @if($categoryId)
                <x-button wire:click="updateCategory">Update</x-button>
            @else
                <x-button wire:click="createCategory">Create</x-button>
            @endif
        </x-slot>
    </x-dialog-modal>

</section>