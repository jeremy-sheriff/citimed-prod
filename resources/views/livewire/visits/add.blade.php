<div class="w-full mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Search Section -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Patient Number Search -->
            <div>
                <flux:field>
                    <flux:label>Patient Number</flux:label>
                    <flux:description>Enter the patient's number.</flux:description>
                    <flux:input wire:model="search_number" type="text" name="username" placeholder="Enter the patient's number" />
                    <flux:error name="search_number" />
                </flux:field>

                <flux:button class="mt-3" wire:click="searchByNumber" variant="primary" color="zinc">Search By Number</flux:button>
            </div>

            <!-- Patient Name Search -->
            <div>
                <flux:field>
                    <flux:label>Patient Name</flux:label>
                    <flux:description>Enter the patient's name.</flux:description>
                    <flux:input wire:model="search_name" type="text"  name="search_name" id="search_name" placeholder="Search by Patient Name" />
                    <flux:error name="search_name" />
                </flux:field>

                <flux:button class="mt-3" wire:click="searchByName" variant="primary" color="blue">Search By Name</flux:button>
            </div>
        </div>

        <!-- Clear Button -->
        <div class="mt-4">
            <button
                wire:click="clearSearch"
                class="text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 text-sm font-medium"
            >
                Clear
            </button>
        </div>
    </div>

    @isset($patient)
        <flux:modal name="add-visit" variant="flyout" :dismissible="false" position="left" class="md:w-[900px]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Add Visit for {{$patient->name}}</flux:heading>
                    <flux:text class="mt-2">Fill in the visit details below.</flux:text>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Complaints full width -->
                    <div class="md:col-span-3">
                        <flux:field>
                            <flux:label>Complaints</flux:label>
                            <flux:textarea
                                placeholder="Describe complaints"
                                name="complaints"
                                wire:model.defer="complaints"
                            />
                            <flux:description>Patient's complaints during the visit.</flux:description>
                            <flux:error name="complaints" />
                        </flux:field>
                    </div>

                    <!-- History of Presenting Illness -->
                    <flux:field>
                        <flux:label>History of Presenting Illness</flux:label>
                        <flux:textarea
                            placeholder="History details"
                            name="history_of_presenting_illness"
                            wire:model.defer="history_of_presenting_illness"
                        />
                        <flux:description>Relevant history for diagnosis.</flux:description>
                        <flux:error name="history_of_presenting_illness" />
                    </flux:field>

                    <!-- Allergies -->
                    <flux:field>
                        <flux:label>Allergies</flux:label>
                        <flux:textarea
                            placeholder="List allergies"
                            name="allergies"
                            wire:model.defer="allergies"
                        />
                        <flux:description>Known allergies of the patient.</flux:description>
                        <flux:error name="allergies" />
                    </flux:field>

                    <!-- Physical Examination -->
                    <flux:field>
                        <flux:label>Physical Examination</flux:label>
                        <flux:textarea
                            placeholder="Physical exam notes"
                            name="physical_examination"
                            wire:model.defer="physical_examination"
                        />
                        <flux:description>Findings from the physical examination.</flux:description>
                        <flux:error name="physical_examination" />
                    </flux:field>

                    <!-- Lab Test And Results -->
                    <flux:field>
                        <flux:label>Lab Test And Results</flux:label>
                        <flux:textarea
                            placeholder="Lab test details"
                            name="lab_test"
                            wire:model.defer="lab_test"
                        />
                        <flux:description>Laboratory tests ordered or results.</flux:description>
                        <flux:error name="lab_test" />
                    </flux:field>

                    <!-- Diagnosis -->
                    <flux:field>
                        <flux:label>Diagnosis</flux:label>
                        <flux:textarea
                            placeholder="Diagnosis notes"
                            name="diagnosis"
                            wire:model.defer="diagnosis"
                        />
                        <flux:description>Doctor's diagnosis.</flux:description>
                        <flux:error name="diagnosis" />
                    </flux:field>

                    <!-- Type of Diagnosis -->
                    <flux:field>
                        <flux:label>Select the type of Diagnosis</flux:label>
                        <div class="space-y-1">
                            <flux:radio
                                name="type_of_diagnosis"
                                value="infection"
                                label="Infection"
                                wire:model.defer="type_of_diagnosis"
                            />
                            <flux:radio
                                name="type_of_diagnosis"
                                value="short_term"
                                label="Short Term"
                                wire:model.defer="type_of_diagnosis"
                            />
                            <flux:radio
                                name="type_of_diagnosis"
                                value="chronic"
                                label="Chronic"
                                wire:model.defer="type_of_diagnosis"
                            />
                        </div>
                        <flux:error name="type_of_diagnosis" />
                    </flux:field>

                    <!-- Imaging full width -->
                    <div class="md:col-span-3">
                        <flux:field>
                            <flux:label>Imaging</flux:label>
                            <flux:textarea
                                placeholder="Imaging results"
                                name="imaging"
                                wire:model.defer="imaging"
                            />
                            <flux:description>Imaging studies and results.</flux:description>
                            <flux:error name="imaging" />
                        </flux:field>
                    </div>

                    <!-- Prescriptions full width -->
                    <div class="md:col-span-3">
                        <flux:field>
                            <flux:label>Prescriptions</flux:label>
                            <flux:textarea
                                placeholder="Prescribed medications"
                                name="prescriptions"
                                wire:model.defer="prescriptions"
                            />
                            <flux:description>Medications prescribed during visit.</flux:description>
                            <flux:error name="prescriptions" />
                        </flux:field>
                    </div>
                </div>

                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary" wire:click="saveVisit">Save visit</flux:button>
                </div>
            </div>
        </flux:modal>
    @endisset








    <!-- Patients Table -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-r border-gray-200 dark:border-gray-600">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-r border-gray-200 dark:border-gray-600">
                        Patient No
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-r border-gray-200 dark:border-gray-600">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-r border-gray-200 dark:border-gray-600">
                        Age
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-r border-gray-200 dark:border-gray-600">
                        Phone
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-r border-gray-200 dark:border-gray-600">
                        Residence
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($patients as $index => $patient)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 odd:bg-gray-100 even:bg-white">
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 border-r border-gray-200 dark:border-gray-600">
                            {{ ($patients->currentPage() - 1) * $patients->perPage() + $index + 1 }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                            {{ $patient->number ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                            {{ ucfirst($patient->name) }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 border-r border-gray-200 dark:border-gray-600">
                            {{ $patient->age ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 border-r border-gray-200 dark:border-gray-600">
                            {{ $patient->phone_number ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 border-r border-gray-200 dark:border-gray-600">
                            {{ $patient->residence ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm font-medium space-x-2">
                            <flux:modal.trigger name="add-visit">
                                <flux:button wire:click="setModal({{$patient}})" variant="primary" color="sky" icon="user-plus">Add Visit</flux:button>
                            </flux:modal.trigger>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                            No patients found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Footer -->
        <div class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
            <div class="flex items-center justify-between">
                <div class="flex-1 flex justify-between sm:hidden">
                    @if ($patients->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 cursor-default">
                            Previous
                        </span>
                    @else
                        <button wire:click="previousPage" class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Previous
                        </button>
                    @endif

                    @if ($patients->hasMorePages())
                        <button wire:click="nextPage" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Next
                        </button>
                    @else
                        <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 cursor-default">
                            Next
                        </span>
                    @endif
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        {{ $patients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
