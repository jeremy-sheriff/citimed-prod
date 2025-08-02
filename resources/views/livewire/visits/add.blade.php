{{--
    Main container for the Visits management interface
    This component allows users to search for patients and add new visits
--}}
<div class="w-full mx-auto px-4 sm:px-6 lg:px-8">

    {{-- Flash Message for Success --}}
    @if (session()->has('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 border border-green-300 rounded-lg shadow-sm">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    {{--
        SECTION: Patient Search Panel
        This section provides search functionality to find patients by number or name
    --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">

        <flux:modal.trigger name="add-visit">
            <flux:button
                variant="primary"
                color="sky"
                icon="user-plus"
            >
                Add Visit
            </flux:button>
        </flux:modal.trigger>
    </div>

    {{--
        SECTION: Add Visit Modal
        This modal contains the form for adding a new patient visit
    --}}
    <flux:modal name="add-visit" variant="flyout" :dismissible="false" position="right" class="md:w-[900px]">
        <div class="space-y-6">
            {{--
                Patient Selection Component
                This section allows searching for and selecting a patient for the visit
            --}}
            <div class="relative" x-data="{ open: @entangle('showDropdown') }" @click.outside="$wire.hideDropdown()">
                <flux:field>
                    <flux:label>Patient <span class="required-asterisk">*</span></flux:label>
                    <flux:description>Search and select a patient by name or number.</flux:description>

                    <div class="relative">
                        <flux:input
                            autocomplete="off"
                            placeholder="Search patient by name or number"
                            wire:model.live="search"
                        >
                        </flux:input>

                        {{-- Clear button - Appears when a patient is selected --}}
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

                {{--
                    Search Results Dropdown
                    Displays matching patients as the user types in the search field
                --}}
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

                {{-- No Results Message - Shown when search returns no matches --}}
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

                {{--
                    Selected Patient Card
                    Displays detailed information about the selected patient
                --}}
                @if($selectedPatient)
                    <div class="mt-4 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                        {{-- Card Header with Patient Name and ID --}}
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div>
                                        <h3 class="text-xl font-semibold text-white">{{ $selectedPatient->name }}</h3>
                                        <p class="text-blue-100">Patient ID: #{{ $selectedPatient->number }}</p>
                                    </div>
                                </div>


                                <flux:button wire:click="clearSelection" variant="primary" color="red">Cancel</flux:button>
                            </div>
                        </div>

                        {{-- Card Body with Patient Details --}}
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                {{-- Personal Information Section --}}
                                <div class="space-y-4">
                                    <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wide border-b border-gray-200 pb-2">
                                        Personal Information
                                    </h4>
                                    <div class="space-y-3">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4V9a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                                            </svg>
                                            <div>
                                                <p class="text-sm text-gray-500">Age</p>
                                                <p class="font-medium text-gray-900">{{ $selectedPatient->age }} years old</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <div>
                                                <p class="text-sm text-gray-500">Gender</p>
                                                <p class="font-medium text-gray-900">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $selectedPatient->gender == 'male' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                            {{ ucfirst($selectedPatient->gender) }}
                                        </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Contact Information Section --}}
                                <div class="space-y-4">
                                    <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wide border-b border-gray-200 pb-2">
                                        Contact Information
                                    </h4>
                                    <div class="space-y-3">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            <div>
                                                <p class="text-sm text-gray-500">Phone Number</p>
                                                <p class="font-medium text-gray-900">{{ $selectedPatient->phone_number }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <div>
                                                <p class="text-sm text-gray-500">Residence</p>
                                                <p class="font-medium text-gray-900">{{ $selectedPatient->residence }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Medical Information Section --}}
                                <div class="space-y-4">
                                    <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wide border-b border-gray-200 pb-2">
                                        Medical Information
                                    </h4>
                                    <div class="space-y-3">
                                        <div class="flex items-start">
                                            <svg class="w-4 h-4 text-gray-400 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <div class="flex-1">
                                                <p class="text-sm text-gray-500">Additional Information</p>
                                                @if($selectedPatient->information)
                                                    <div class="mt-1 p-3 bg-gray-50 rounded-lg">
                                                        <p class="text-sm text-gray-700 leading-relaxed">{{ $selectedPatient->information }}</p>
                                                    </div>
                                                @else
                                                    <p class="text-sm text-gray-400 italic">No additional information available</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Registration Date and Selection Status --}}
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4h12a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6a2 2 0 012-2h4"></path>
                                        </svg>
                                        Patient registered on {{ $selectedPatient->created_at->format('M d, Y \a\t g:i A') }}
                                    </div>
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Selected
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Hidden input to store selected patient ID for form submission --}}
                <input type="hidden" name="patient_id" value="{{ $selectedPatientId }}">
            </div>

            {{--
                SECTION: Visit Form Fields
                This section contains all the medical information fields for the visit
            --}}
            <div class="flex flex-col md:flex-row gap-6">

                <div class="w-1/2">
                    {{-- Complaints (full width) --}}
                    <div class="md:col-span-3">
                        <flux:field>
                            <flux:label>Complaints <span class="required-asterisk">*</span></flux:label>
                            <flux:textarea
                                placeholder="Describe complaints"
                                name="complaints"
                                wire:model.defer="complaints"
                            />
                            <flux:description>Patient's complaints during the visit.</flux:description>
                            <flux:error name="complaints" />
                        </flux:field>
                    </div>
                </div>
                <div class="w-1/2">
                    {{-- Diagnosis --}}
                    <flux:field>
                        <flux:label>Diagnosis <span class="required-asterisk">*</span></flux:label>
                        <flux:textarea
                            placeholder="Diagnosis notes"
                            name="diagnosis"
                            wire:model.defer="diagnosis"
                        />
                        <flux:description>Doctor's diagnosis.</flux:description>
                        <flux:error name="diagnosis" />
                    </flux:field>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- History of Presenting Illness --}}
                <flux:field>
                    <flux:label>History of Presenting Illness (optional)</flux:label>
                    <flux:textarea
                        placeholder="History details"
                        name="history_of_presenting_illness"
                        wire:model.defer="history_of_presenting_illness"
                    />
                    <flux:description>Relevant history for diagnosis.</flux:description>
                    <flux:error name="history_of_presenting_illness" />
                </flux:field>

                {{-- Allergies --}}
                <flux:field>
                    <flux:label>Allergies (optional)</flux:label>
                    <flux:textarea
                        placeholder="List allergies"
                        name="allergies"
                        wire:model.defer="allergies"
                    />
                    <flux:description>Known allergies of the patient.</flux:description>
                    <flux:error name="allergies" />
                </flux:field>

                {{-- Physical Examination --}}
                <flux:field>
                    <flux:label>Physical Examination (optional)</flux:label>
                    <flux:textarea
                        placeholder="Physical exam notes"
                        name="physical_examination"
                        wire:model.defer="physical_examination"
                    />
                    <flux:description>Findings from the physical examination.</flux:description>
                    <flux:error name="physical_examination" />
                </flux:field>

                {{-- Lab Test And Results --}}
                <flux:field>
                    <flux:label>Lab Test And Results (optional)</flux:label>
                    <flux:textarea
                        placeholder="Lab test details"
                        name="lab_test"
                        wire:model.defer="lab_test"
                    />
                    <flux:description>Laboratory tests ordered or results.</flux:description>
                    <flux:error name="lab_test" />
                </flux:field>



                {{-- Type of Diagnosis (Radio Button Group) --}}
                <flux:radio.group wire:model="type_of_diagnosis" label="Select type of diagnosis ">
                    <flux:radio value="infection" label="Infection" checked />
                    <flux:radio value="short_term" label="Short term" />
                    <flux:radio value="chronic" label="Chronic" />
                </flux:radio.group>
            </div>

            <div class="flex flex-col md:flex-row gap-6">
                {{-- Left Side --}}
                <div class="w-1/2">
                    <flux:field>
                        <flux:label>Imaging (optional)</flux:label>
                        <flux:textarea
                            placeholder="Imaging results"
                            name="imaging"
                            wire:model.defer="imaging"
                        />
                        <flux:description>Imaging studies and results.</flux:description>
                        <flux:error name="imaging" />
                    </flux:field>
                </div>

                {{-- Right Side --}}
                <div class="w-1/2">
                    <flux:field>
                        <flux:label>Prescriptions (optional)</flux:label>
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

            {{-- Form Submit Button --}}
            <div class="flex">
                <flux:spacer />
                <flux:button
                    type="submit"
                    variant="primary"
                    wire:click="saveVisit"
                >
                    Save visit
                </flux:button>
            </div>
        </div>
    </flux:modal>

    {{--
        SECTION: Visits Table
        This section displays a table of visits with pagination
    --}}
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden mt-6">
        {{-- Table with horizontal scrolling for small screens --}}
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                {{-- Table Header --}}
                <thead class="bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-r border-gray-200 dark:border-gray-600">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-r border-gray-200 dark:border-gray-600">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-r border-gray-200 dark:border-gray-600">
                        Patient
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-r border-gray-200 dark:border-gray-600">
                        Complaints
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-r border-gray-200 dark:border-gray-600">
                        Diagnosis
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-r border-gray-200 dark:border-gray-600">
                        Type
                    </th>
                </tr>
                </thead>

                {{-- Table Body --}}
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($visits as $index => $visit)
                    {{-- Visit Row --}}
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 odd:bg-gray-100 even:bg-white">
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 border-r border-gray-200 dark:border-gray-600">
                            {{ ($visits->currentPage() - 1) * $visits->perPage() + $index + 1 }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                            {{ $visit->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                            {{ ucfirst($visit->patient->name ?? 'N/A') }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 dark:text-gray-400 border-r border-gray-200 dark:border-gray-600 max-w-xs truncate">
                            {{ Str::limit($visit->complaints, 50) }}
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500 dark:text-gray-400 border-r border-gray-200 dark:border-gray-600 max-w-xs truncate">
                            {{ Str::limit($visit->diagnosis, 50) }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 border-r border-gray-200 dark:border-gray-600">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $visit->type_of_diagnosis == 'chronic' ? 'bg-red-100 text-red-800' :
                                   ($visit->type_of_diagnosis == 'infection' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                {{ ucfirst(str_replace('_', ' ', $visit->type_of_diagnosis)) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    {{-- Empty State - No Visits Found --}}
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                            No visits found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Controls --}}
        <div class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
            <div class="flex items-center justify-between">
                {{-- Mobile Pagination Controls --}}
                <div class="flex-1 flex justify-between sm:hidden">
                    @if ($visits->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 cursor-default">
                            Previous
                        </span>
                    @else
                        <button
                            wire:click="previousPage"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700"
                        >
                            Previous
                        </button>
                    @endif

                    @if ($visits->hasMorePages())
                        <button
                            wire:click="nextPage"
                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700"
                        >
                            Next
                        </button>
                    @else
                        <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 cursor-default">
                            Next
                        </span>
                    @endif
                </div>

                {{-- Desktop Pagination Controls --}}
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        {{ $visits->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
