

<div class="mx-auto p-6">
     <style>
         .animated-modal {
             transition: all 0.3s ease-in-out;
             transform: translateX(100%);
             opacity: 0;
         }

         .animated-modal[data-flux-modal-open] {
             transform: translateX(0);
             opacity: 1;
         }

         .modal-content {
             animation: slideInContent 0.4s ease-out 0.1s both;
         }

         @keyframes slideInContent {
             from {
                 transform: translateY(20px);
                 opacity: 0;
             }
             to {
                 transform: translateY(0);
                 opacity: 1;
             }
         }
     </style>

    <!-- Button Section -->
    <div class="mb-4 flex justify-between items-center">
        <div>
            <button wire:click="exportToExcel" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">Export all patients to Excel</button>

            <flux:modal.trigger name="add-patient" class="ml-4">
                <flux:button variant="primary" color="emerald" icon="message-circle-plus">Add Patient</flux:button>
            </flux:modal.trigger>
        </div>
        <input wire:model.debounce.500ms="search" type="text" class="border border-gray-300 p-2 rounded-lg w-1/4" placeholder="Search by Patient Name" />
    </div>




    <flux:modal :dismissible="false" name="add-patient">
        <livewire:patients.add />
    </flux:modal>

    <flux:modal :dismissible="false" name="update-patient">
        <livewire:patients.update />
    </flux:modal>


    <flux:modal :dismissible="false" name="edit-profile" variant="flyout" class="animated-modal">
        <div class="space-y-6 modal-content">
            <livewire:patients.history />
        </div>
    </flux:modal>


    <!-- Table Section -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg dark:bg-gray-800 dark:text-white">
        <table class="min-w-full table-auto border-collapse">
            <thead class="bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
            <tr>
                <th wire:click="sortBy('id')" class="px-4 py-2 text-left font-semibold border border-gray-300 dark:border-gray-600 cursor-pointer">
                    #
                    @if($sortField == 'id')
                        <span>{{ $sortDirection == 'asc' ? '↓' : '↑' }}</span>
                    @endif
                </th>
                <th wire:click="sortBy('number')" class="px-4 py-2 text-left font-semibold border border-gray-300 dark:border-gray-600 cursor-pointer">
                    Patient No
                    @if($sortField == 'number')
                        <span>{{ $sortDirection == 'asc' ? '↓' : '↑' }}</span>
                    @endif
                </th>
                <th wire:click="sortBy('name')" class="px-4 py-2 text-left font-semibold border border-gray-300 dark:border-gray-600 cursor-pointer">
                    Name
                    @if($sortField == 'name')
                        <span>{{ $sortDirection == 'asc' ? '↓' : '↑' }}</span>
                    @endif
                </th>
                <th wire:click="sortBy('age')" class="px-4 py-2 text-left font-semibold border border-gray-300 dark:border-gray-600 cursor-pointer">
                    Age
                    @if($sortField == 'age')
                        <span>{{ $sortDirection == 'asc' ? '↓' : '↑' }}</span>
                    @endif
                </th>
                <th wire:click="sortBy('phone_number')" class="px-4 py-2 text-left font-semibold border border-gray-300 dark:border-gray-600 cursor-pointer">
                    Phone
                    @if($sortField == 'phone_number')
                        <span>{{ $sortDirection == 'asc' ? '↓' : '↑' }}</span>
                    @endif
                </th>
                <th wire:click="sortBy('residence')" class="px-4 py-2 text-left font-semibold border border-gray-300 dark:border-gray-600 cursor-pointer">
                    Residence
                    @if($sortField == 'residence')
                        <span>{{ $sortDirection == 'asc' ? '↓' : '↑' }}</span>
                    @endif
                </th>
                <th class="px-4 py-2 text-left font-semibold border border-gray-300 dark:border-gray-600">Action</th>
            </tr>
            </thead>
            <tbody class="text-gray-600 dark:text-white">
            @foreach ($patients as $patient)
                <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $patient->id }}</td>
                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $patient->number }}</td>
                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ ucfirst($patient->name) }}</td>
                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $patient->age }}</td>
                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $patient->phone_number }}</td>
                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">{{ $patient->residence }}</td>
                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 flex items-center space-x-2">

                        <flux:modal.trigger name="edit-profile">
                            <flux:button wire:click="openPatientHistory({{$patient}})" variant="primary" color="sky" icon="file-stack" class="mr-2">History</flux:button>
                        </flux:modal.trigger>

                        <flux:modal.trigger name="update-patient" class="mr-2">
                            <flux:button wire:click="updatePatient({{$patient}})" variant="primary" color="amber" icon="square-pen" class="mr-2">Edit</flux:button>
                        </flux:modal.trigger>
                        <flux:button variant="primary" color="red" icon="trash">Delete</flux:button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Pagination Section -->
        <div class="mt-4">
            {{ $patients->links() }}
        </div>
    </div>
</div>
