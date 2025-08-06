<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Hello!!, {{ $user->name }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Roles Section -->
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Roles
                </h3>
                <div class="space-y-2">
                    @foreach ($roles as $role)
                        <div class="bg-white dark:bg-gray-600 px-4 py-3 rounded-md shadow-sm border border-gray-200 dark:border-gray-500">
                            <span class="font-medium text-gray-700 dark:text-gray-200">{{ ucfirst($role) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Permissions Section -->
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    Permissions
                </h3>
                <div class="grid grid-cols-1 gap-2 max-h-96 overflow-y-auto pr-2">
                    @foreach ($permissions as $permission)
                        <div class="bg-white dark:bg-gray-600 px-4 py-2 rounded-md shadow-sm border border-gray-200 dark:border-gray-500">
                            <span class="text-sm text-gray-700 dark:text-gray-200">{{ ucfirst($permission) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
