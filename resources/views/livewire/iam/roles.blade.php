<div class="w-1/2 space-y-4">
    <div class="overflow-x-auto rounded-lg shadow-md border border-gray-200 dark:border-zinc-700">
        <table class="min-w-full table-fixed border border-gray-200 dark:border-zinc-700 border-collapse">
            <thead class="bg-gray-100 dark:bg-zinc-800">
            <tr>
                <th class="border border-gray-200 dark:border-zinc-700 px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300 uppercase">
                    #
                </th>
                <th class="border border-gray-200 dark:border-zinc-700 px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300 uppercase">
                    Role Name
                </th>
                <th class="border border-gray-200 dark:border-zinc-700 px-6 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300 uppercase">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody class="bg-white dark:bg-zinc-900">
            @foreach($roles as $index => $role)
                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800 transition">
                    <td class="border border-gray-200 dark:border-zinc-700 px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                        {{ $index + 1 }}
                    </td>
                    <td class="border border-gray-200 dark:border-zinc-700 px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                        {{ ucfirst($role) }}
                    </td>
                    <td class="border border-gray-200 dark:border-zinc-700 px-6 py-4 text-sm text-gray-600 dark:text-gray-300 space-x-2">
                        <button class="px-3 py-1 text-sm bg-yellow-400 hover:bg-yellow-500 text-white rounded-md transition">Edit</button>
                        <button class="px-3 py-1 text-sm bg-red-600 hover:bg-red-700 text-white rounded-md transition">Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>
