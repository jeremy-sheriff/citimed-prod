<div class="flex items-center  justify-center">
    <div class="">
        <!-- Success Message -->
        @if($showSuccessMessage)
            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-y-2 opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                x-init="setTimeout(() => { show = false; $wire.hideSuccessMessage(); }, 3000)"
                class="m-4 mb-0 rounded-lg bg-green-50 border border-green-200 p-4"
            >
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <p class="text-green-800 font-medium">Patient information updated successfully!</p>
                </div>
            </div>
        @endif

        <form wire:submit="save" class="p-6">
            <!-- General Error Message -->
            @error('general')
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <p class="text-red-800 font-medium">{{ $message }}</p>
                </div>
            </div>
            @enderror

            <div class="space-y-6">
                <!-- Name and Age Row -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2 dark:text-gray-300">
                              Full Name <span class="text-red-500">*</span>
                        </label>
                        <input
                            wire:model.blur="name"
                            type="text"
                            id="name"
                            placeholder="Enter patient's full name"
                            class="block w-full px-3 py-2 rounded-lg border border-gray-300 shadow-sm placeholder-gray-400 focus:border-gray-500 focus:ring-1 focus:ring-gray-500 transition-all duration-200 @error('name') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        />
                        @error('name')
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="age" class="block text-sm font-medium text-gray-700 mb-2 dark:text-gray-300">
                            Age <span class="text-red-500">*</span>
                        </label>
                        <input
                            wire:model.blur="age"
                            type="number"
                            id="age"
                            min="0"
                            max="120"
                            placeholder="Age"
                            class="block w-full px-3 py-2 rounded-lg border border-gray-300 shadow-sm placeholder-gray-400 focus:border-gray-500 focus:ring-1 focus:ring-gray-500 transition-all duration-200 @error('age') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        />
                        @error('age')
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <!-- Gender and Phone Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-2 dark:text-gray-300">
                            Gender <span class="text-red-500">*</span>
                        </label>
                        <select
                            wire:model="gender"
                            id="gender"
                            class="block w-full px-3 py-2 rounded-lg border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-1 focus:ring-gray-500 transition-all duration-200 @error('gender') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        >
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                            <option value="other">Other</option>
                        </select>
                        @error('gender')
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2 dark:text-gray-300">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input
                            wire:model.blur="phone_number"
                            type="tel"
                            id="phone_number"
                            placeholder="e.g., +254 700 123 456"
                            class="block w-full px-3 py-2 rounded-lg border border-gray-300 shadow-sm placeholder-gray-400 focus:border-gray-500 focus:ring-1 focus:ring-gray-500 transition-all duration-200 @error('phone_number') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        />
                        @error('phone_number')
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2 dark:text-gray-300">
                        Location/Address <span class="text-red-500">*</span>
                    </label>
                    <input
                        wire:model.blur="location"
                        type="text"
                        id="location"
                        placeholder="Enter patient's address or location"
                        class="block w-full px-3 py-2 rounded-lg border border-gray-300 shadow-sm placeholder-gray-400 focus:border-gray-500 focus:ring-1 focus:ring-gray-500 transition-all duration-200 @error('location') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                    />
                    @error('location')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Additional Information -->
                <div>
                    <label for="additional_information" class="block text-sm font-medium text-gray-700 mb-2 dark:text-gray-300">
                        Additional Information
                    </label>
                    <textarea
                        wire:model.blur="additional_information"
                        id="additional_information"
                        rows="3"
                        placeholder="Any additional notes, medical history, allergies, or special instructions..."
                        class="block w-full px-3 py-2 rounded-lg border border-gray-300 shadow-sm placeholder-gray-400 focus:border-gray-500 focus:ring-1 focus:ring-gray-500 transition-all duration-200 resize-none @error('additional_information') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                    ></textarea>
                    @error('additional_information')
                    <p class="mt-1 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-6 mt-6 border-t border-gray-200">

                <div class="flex space-x-3">
                    <flux:button variant="primary" color="rose" x-on:click="$flux.modal('update-patient').close()">Cancel</flux:button>

                    <flux:button type="submit" variant="primary" color="blue" icon="user-plus">Update</flux:button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('hide-success-message', () => {
            setTimeout(() => {
            @this.hideSuccessMessage();
            }, 3000);
        });
    });
</script>
