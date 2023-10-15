<div>
    <x-slot name="header">
        <div class="mt-2">
            {{ __('Categories') }}
        </div>
    </x-slot>

    <div class="py-12 mt-0">
        <div class="mx-auto max-w-screen-2xl sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="flex flex-row justify-between p-4">
                        <div class="flex flex-row">
                            <input wire:model="search" type="text" placeholder="{{ __('Search...') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-800 focus:border-blue-800 sm:text-sm
                                dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div class="ml-4">
                            <x-primary-button @click="$dispatch('category-create')" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                {{ __('Add New') }}
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table
                    class="min-w-max w-full table-auto whitespace-no-wrap bg-white divide-y divide-gray-200 dark:bg-gray-800">
                    <div class="flex justify-between bg-white dark:bg-gray-800 dark:text-gray-50 px-6 py-3">
                        <div class="flex justify-between">
                            <div class="flex justify-between">
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-700 dark:text-gray-50">{{ __('Showing') }}</span>
                                    <select wire:model="perPage"
                                        class="mx-2 border rounded-md form-select form-select-sm text-gray-600 dark:text-gray-700 text-sm">
                                        <option>15</option>
                                        <option>25</option>
                                        <option>50</option>
                                        <option>100</option>
                                    </select>
                                    <span class="text-sm text-gray-700 dark:text-gray-200">{{ __('Entries') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="mr-1">Category name</span>
                                    <x-icon-sort-asc sortField="name" :sort-by="$sortColumn" :sort-asc="$sortAsc" />
                                </div>
                            </th>
                            <th class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="mr-1">{{ __('Created At') }}</span>
                                    <x-icon-sort-asc sortField="created_at" :sort-by="$sortColumn" :sort-asc="$sortAsc" />
                                </div>
                            </th>
                            <th class="py-3 px-6 text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-base/7 font-normal">
                        @forelse ($categories as $category)
                            <tr
                                class="border-b border-gray-200 text-md hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200 ease-in-out">
                                <td class="py-3 px-6 text-left whitespace-nowrap dark:text-gray-200">
                                    {{ $category->name }}
                                </td>
                                <td class="py-3 px-6 text-center whitespace-nowrap dark:text-gray-200">
                                    {{ $category->created_at->format('d/m/Y') }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <x-edit-button class="mr-2" wire:click="showEditModal({{ $category->id }})">
                                    </x-edit-button>
                                    <x-delete-button class="" wire:click="showDeleteModal({{ $category->id }})">
                                    </x-delete-button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-3 px-6 text-center whitespace-nowrap dark:text-gray-200">
                                    No category found...
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $categories->links() }}
        </div>
    </div>

    <div>
        <x-dialog wire:model="showModal" maxWidth="2xl">
            <x-slot name="title">
               <div class="dark:text-gray-50">
                {{ $categoryId ? __('Update Category') : __('Create Category') }}
               </div>
            </x-slot>

            <x-slot name="content">

                <div class="mb-4">
                    <x-input-label for="name" value="{{ __('Name') }}" />
                    <x-text-input wire:model="name" id="name" class="block mt-1 w-full dark:text-gray-50"
                    type="text"
                        name="name" :value="old('name')" required autofocus />
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button class="ml-4" wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                @if ($categoryId)
                    <x-primary-button class="ml-4" wire:click="updateCategory" wire:loading.attr="disabled">
                        {{ __('Update') }}
                    </x-primary-button>
                @else
                    <x-primary-button class="ml-4 uppercase" wire:click="createCategory" wire:loading.attr="disabled">
                        {{ __('Create') }}
                    </x-primary-button>
                @endif
            </x-slot>
        </x-dialog>
    </div>

    <div>
        <x-dialog wire:model="showDeleteModal" maxWidth="2xl">
            <x-slot name="title">
                {{ __('Delete Category') }}
            </x-slot>

            <x-slot name="content">
                <div class="mb-4">
                    <p class="text-sm text-gray-500">
                        {{ __('Are you sure you want to delete this category') }} <span class="font-medium">
                            "{{ $name }}"
                        </span>?
                    </p>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button class="ml-4" wire:click="$toggle('showDeleteModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-4" wire:click="deleteCategory" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-danger-button>
            </x-slot>
        </x-dialog>
    </div>
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                window.addEventListener('category-create', () => {
                    Livewire.emit('category-create');
                });
                window.addEventListener('category-deleted', () => {
                    Livewire.emit('category-deleted');
                });
            });
        </script>
    @endpush
</div>
