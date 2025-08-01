<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
<flux:sidebar sticky stashable
              class="bg-zinc-50 dark:bg-zinc-900 border-r rtl:border-r-0 rtl:border-l border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark"/>

    <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
        <x-app-logo/>
    </a>

    <flux:navlist variant="outline">
        <flux:navlist.group :heading="__('Platform')" class="grid">
            <flux:navlist.item icon="home" href="/dashboard" wire:navigate>Home</flux:navlist.item>
            <flux:menu.separator/>
            <flux:navlist.item icon="users" href="/patients" wire:navigate >Patients</flux:navlist.item>
            <flux:menu.separator/>
            <flux:navlist.item icon="calendar" href="/visits" wire:navigate >Visits</flux:navlist.item>

            @role('super-admin')
            flux:menu.separator/>
            <flux:navlist.group expandable heading="Finance" class="lg:grid">

                <flux:navlist.item icon="circle-dollar-sign" href="#">Payments</flux:navlist.item>
                <flux:navlist.item icon="hand-coins" href="#">Balances</flux:navlist.item>

            </flux:navlist.group>
            @else

            @endrole




            <flux:navlist.group expandable  heading="Pharmacy" class="lg:grid">
                <flux:navlist.item icon="circle-dollar-sign" href="#">Medicines</flux:navlist.item>
            </flux:navlist.group>

        </flux:navlist.group>

        </flux:navlist>


        <flux:spacer/>

        <!-- Desktop User Menu -->
        <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            <flux:profile
                :name="auth()->user()->name"
                :initials="auth()->user()->initials()"
                icon:trailing="chevrons-up-down"
            />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator/>

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog"
                                    wire:navigate>{{ __('Settings') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator/>


                @role('super-admin-role')
                <flux:menu.radio.group>
                    <flux:menu.item :href="route('users')" icon="users"
                                    wire:navigate>{{ __('Users') }}</flux:menu.item>
                </flux:menu.radio.group>
                <flux:menu.separator/>

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('roles')" icon="cloud-check"
                                    wire:navigate>{{ __('Role/Permissions') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator/>
                @else

                @endrole

                <flux:menu.separator/>

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>


    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>

        <flux:spacer/>

        <flux:dropdown position="top" align="end">
            <flux:profile
                :initials="auth()->user()->initials()"
                icon-trailing="chevron-down"
            />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator/>

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog"
                                    wire:navigate>{{ __('Settings') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator/>

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>
</html>
