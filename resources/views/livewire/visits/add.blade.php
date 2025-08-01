<div class="w-full mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Search Section -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Patient Number Search -->
            <div>
                <flux:field>
                    <flux:label>Patient Number</flux:label>
                    <flux:description>Enter the patient's number.</flux:description>
                    <flux:input autocomplete="off" wire:model="search_number" type="text" name="username" placeholder="Enter the patient's number" />
                    <flux:error name="search_number" />
                </flux:field>

                <flux:button class="mt-3" wire:click="searchByNumber" variant="primary" color="zinc">Search By Number</flux:button>
            </div>

            <!-- Patient Name Search -->
            <div>
                <flux:field>
                    <flux:label>Patient Name</flux:label>
                    <flux:description>Enter the patient's name.</flux:description>
                    <flux:input autocomplete="off" wire:model="search_name" type="text"  name="search_name" id="search_name" placeholder="Search by Patient Name" />
                    <flux:error name="search_name" />
                </flux:field>

                <flux:button class="mt-3" wire:click="searchByName" variant="primary" color="blue">Search By Name</flux:button>
            </div>
        </div>

        <!-- Clear Button -->
        <div class="mt-4">
            <flux:button wire:click="clearSearch" variant="primary" color="zinc" icon="circle-x">Clear</flux:button>

            <flux:modal.trigger name="add-visit">
                <flux:button variant="primary" color="sky" icon="user-plus">Add Visit</flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    <flux:modal name="add-visit" variant="flyout" :dismissible="false" position="right" class="md:w-[900px]">
        <div class="space-y-6">


            <div class="relative" x-data="{ open: @entangle('showDropdown') }" @click.outside="$wire.hideDropdown()">
                <flux:field>
                    <flux:label>Patient</flux:label>
                    <flux:description>Search and select a patient by name or number.</flux:description>

                    <div class="relative">
                        <flux:input autocomplete="off" placeholder="Search patient by name or number" wire:model.live="search">
                        </flux:input>

                        {{-- Clear button --}}
                        @if($selectedPatientId)
                            <button
                                type="button"
                                wire:click="clearSelection"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        @endif
                    </div>

                    <flux:error name="selectedPatientId"/>
                </flux:field>

                {{-- Dropdown Results --}}
                @if($showDropdown && count($results) > 0)
                    <div class="absolute z-50 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                        @foreach($results as $patient)
                            <div
                                wire:click="selectPatient({{ $patient->id }}, '{{ $patient->name }}')"
                                class="px-4 py-3 hover:bg-gray-50 cursor-pointer border-b border-gray-100 last:border-b-0 transition-colors duration-150"
                            >
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-900">{{ $patient->name }}</div>
                                        <div class="text-sm text-gray-600">
                                            Patient #: {{ $patient->number }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $patient->age }} years • {{ ucfirst($patient->gender) }} • {{ $patient->phone_number }}
                                        </div>
                                    </div>
                                    <div class="text-xs text-gray-400 ml-2">
                                        {{ $patient->residence }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- No Results Message --}}
                @if($showDropdown && strlen($search) >= 2 && count($results) == 0)
                    <div class="absolute z-50 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg">
                        <div class="px-4 py-3 text-gray-500 text-center">
                            <div class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                No patients found for "{{ $search }}"
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Selected Patient Display --}}
                @if($selectedPatientId)
                    <div class="mt-3 p-3 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm font-medium text-green-800">
                        Selected: {{ $selectedPatientName }}
                    </span>
                            </div>
                            <button
                                type="button"
                                wire:click="clearSelection"
                                class="text-green-600 hover:text-green-800 text-sm"
                            >
                                Change
                            </button>
                        </div>
                    </div>
                @endif

                {{-- Hidden input to store selected patient ID for form submission --}}
                <input type="hidden" name="patient_id" value="{{ $selectedPatientId }}">
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
                <flux:radio.group wire:model="type_of_diagnosis" label="Select type of diagnosis">
                    <flux:radio value="infection" label="Infection" checked />
                    <flux:radio value="short_term" label="Short term" />
                    <flux:radio value="chronic" label="Chronic" />
                </flux:radio.group>

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
