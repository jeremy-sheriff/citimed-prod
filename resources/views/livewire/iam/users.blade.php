<div class="max-w-xl  mt-10 space-y-6 bg-white dark:bg-zinc-900 rounded-lg shadow shadow-2xl p-6">
    <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white">Register New User</h2>

    @if (session()->has('success'))
        <div class="p-3 text-green-700 bg-green-100 border border-green-300 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="registerUser" class="space-y-4">
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

        <!-- Submit Button -->
        <div class="flex justify-end">
            <flux:button type="submit" color="primary">Register User</flux:button>
        </div>
    </form>
</div>
