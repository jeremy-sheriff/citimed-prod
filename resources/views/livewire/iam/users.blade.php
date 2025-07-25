<div>
    <flux:modal @close="modalClosedAction" :dismissible="false" name="add-user" variant="flyout" position="right" class="md:w-96">
        <div class="space-y-6">
            <div class="max-w-xl mt-10 space-y-6  dark:bg-zinc-900 rounded-lg p-6">
                <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white">Register New User</h2>

                @if (session()->has('success'))
                    <div class="p-3 text-green-700 bg-green-100 border border-green-300 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit.prevent="registerUser" class="space-y-4">
                    <!-- Name Section -->
                    <section class="space-y-4">
                        <!-- Name -->
                        <flux:field>
                            <flux:label>Name</flux:label>
                            <flux:description>The user's full name.</flux:description>
                            <flux:input wire:model.defer="name" />
                            <flux:error name="name" />
                        </flux:field>

                        <!-- Email -->
                        <flux:field>
                            <flux:label>Email</flux:label>
                            <flux:description>This will be the login email.</flux:description>
                            <flux:input type="email" wire:model.defer="email" />
                            <flux:error name="email" />
                        </flux:field>
                    </section>

                    <!-- Password Section -->
                    <section class="space-y-4">
                        <!-- Password -->
                        <flux:field>
                            <flux:label>Password</flux:label>
                            <flux:description>Minimum 6 characters.</flux:description>
                            <flux:input type="password" wire:model.defer="password" />
                            <flux:error name="password" />
                        </flux:field>

                        <!-- Role -->
                        <flux:field>
                            <flux:label>Role</flux:label>
                            <flux:description>Select a role to assign.</flux:description>
                            <flux:select wire:model.defer="role">
                                <option value="">-- Select Role --</option>
                                @foreach($roles as $r)
                                    <option value="{{ $r }}">{{ ucfirst($r) }}</option>
                                @endforeach
                            </flux:select>
                            <flux:error name="role" />
                        </flux:field>
                    </section>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <flux:button variant="primary" type="submit" color="primary">Register User</flux:button>
                    </div>
                </form>

            </div>
        </div>
    </flux:modal>


    <div class="max-w-screen-xl mt-10 space-y-6 bg-white dark:bg-zinc-900 rounded-2xl shadow-xl border border-slate-200 dark:border-zinc-700 p-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-3xl font-bold text-slate-800 dark:text-white">User Management</h2>
                <div class="text-sm text-slate-500 dark:text-slate-400">
                    {{ $users->count() }} total users
                </div>
            </div>
            <p class="text-slate-600 dark:text-slate-300">Manage your members and their roles</p>
        </div>

        <!-- Controls Section -->
        <div class="bg-gradient-to-r from-slate-50 to-white dark:from-zinc-800 dark:to-zinc-700 rounded-xl p-6 border border-slate-200 dark:border-zinc-600">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <!-- Search Bar -->
                <div class="relative flex-1 max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input
                        type="text"
                        placeholder="Search users..."
                        class="block w-full pl-10 pr-4 py-3 border border-slate-300 dark:border-zinc-600 rounded-xl bg-white dark:bg-zinc-700 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 shadow-sm"
                    >
                </div>

                <!-- Add User Button -->
                <flux:modal.trigger name="add-user">
                    <flux:button variant="primary" icon="circle-plus">Add user</flux:button>
                </flux:modal.trigger>
            </div>
        </div>

        <!-- Table Container -->
        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-lg border border-slate-200 dark:border-zinc-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gradient-to-r from-slate-50 to-slate-100 dark:from-zinc-700 dark:to-zinc-600">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <span>#</span>
                                <div class="w-1 h-1 bg-slate-400 rounded-full"></div>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <span>User</span>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                </svg>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <span>Email</span>
                                <div class="w-1 h-1 bg-slate-400 rounded-full"></div>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider">
                            <div class="flex items-center space-x-2">
                                <span>Role</span>
                                <div class="w-1 h-1 bg-slate-400 rounded-full"></div>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-zinc-800 divide-y divide-slate-200 dark:divide-zinc-700">
                    @foreach($users as $index => $user)
                        <tr class="transition-all duration-200">
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-zinc-600 dark:to-zinc-700 rounded-lg flex items-center justify-center text-sm font-bold text-slate-600 dark:text-slate-300 transition-all duration-200">
                                        {{ $index + 1 }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                            {{ substr($user->name, 0, 1) }}{{ substr(explode(' ', $user->name)[1] ?? '', 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-base font-semibold text-slate-900 dark:text-white transition-colors duration-200">
                                            {{ ucfirst($user->name) }}
                                        </div>
                                        <div class="text-sm text-slate-500 dark:text-slate-400">
                                            Active user
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                    <span class="text-sm text-slate-600 dark:text-slate-300 font-medium">{{ $user->email }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                @php
                                    $roleColors = [
                                        'Super-admin-role' => 'from-red-500 to-red-600 text-white',
                                        'manager' => 'from-blue-500 to-blue-600 text-white',
                                        'developer' => 'from-green-500 to-green-600 text-white',
                                        'designer' => 'from-purple-500 to-purple-600 text-white',
                                        'user' => 'from-gray-500 to-gray-600 text-white'
                                    ];
                                    $colorClass = $roleColors[strtolower($user->role)] ?? $roleColors['user'];
                                @endphp
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r {{ $colorClass }} shadow-sm">
                                    <div class="w-2 h-2 bg-white bg-opacity-30 rounded-full mr-2"></div>
                                    {{ ucfirst($user->roles[0]->name) }}
                                </span>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <!-- View Button -->
                                    <button class="inline-flex items-center justify-center w-9 h-9 text-slate-400 bg-transparent rounded-lg transition-all duration-200" title="View User">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>

                                    <!-- Edit Button -->
                                    <button class="inline-flex items-center justify-center w-9 h-9 text-slate-400 bg-transparent rounded-lg transition-all duration-200" title="Edit User">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>

                                    <!-- Delete Button -->
                                    <button class="inline-flex items-center justify-center w-9 h-9 text-slate-400 bg-transparent rounded-lg transition-all duration-200" title="Delete User">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table Footer with Stats -->
            <div class="px-6 py-4 bg-gradient-to-r from-slate-50 to-white dark:from-zinc-700 dark:to-zinc-600 border-t border-slate-200 dark:border-zinc-600">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-slate-600 dark:text-slate-300">
                        Showing <span class="font-semibold text-slate-900 dark:text-white">{{ $users->count() }}</span> users
                    </div>
                    <div class="flex items-center space-x-4 text-xs text-slate-500 dark:text-slate-400">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span>{{ $users->where('status', 'active')->count() ?? $users->count() }} Active</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                            <span>{{ $users->where('status', 'inactive')->count() ?? 0 }} Inactive</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

