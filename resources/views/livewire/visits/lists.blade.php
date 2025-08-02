<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
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
                    {{$index+=1}}
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
