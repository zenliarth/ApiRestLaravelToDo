<div>
    <div class="bg-gray-900">
        <div class="mx-auto max-w-7xl">
            <div class="py-10 bg-gray-900">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-white">Tasks</h1>
                            <p class="mt-2 text-sm text-gray-300">A list of all the users in your account including
                                their name, title, email and role.</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a href="{{ route('dashboard.tasks.manage') }}">
                                <button type="button"
                                    class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-500 rounded-md hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Add
                                    Task</button>
                            </a>
                        </div>
                    </div>
                    <div class="flow-root mt-8">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-700">
                                    <thead>
                                        <tr>
                                            <th scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">
                                                Title</th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-white">
                                                Description</th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-white">Status
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-white">Attachments
                                            </th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-800">
                                        @forelse ($this->tasks as $task)
                                        <tr>
                                            <td
                                                class="whitespace-nowrap truncate max-w-[15rem] py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                                {{ $task['title'] }}</td>
                                            <td
                                                class="whitespace-nowrap truncate max-w-[18rem] px-3 py-4 text-sm text-gray-300">
                                                {{ $task['description'] }}
                                            </td>
                                            <td class="px-3 py-4 text-sm text-gray-300 whitespace-nowrap">
                                                @if($task['completed'])
                                                <span
                                                    class="px-4 py-1 text-xs font-medium text-white bg-green-500 rounded-full">
                                                    Completed
                                                </span>
                                                @else
                                                <span
                                                    class="px-3 py-1 text-xs font-medium text-white bg-gray-500 rounded-full">
                                                    incompleted
                                                </span>
                                                @endif
                                            </td>
                                            <td class="pl-10 text-white">
                                                {{ $task['attachments_count'] }}
                                            </td>
                                            <td
                                                class="relative flex items-center justify-end gap-2 py-4 pl-3 pr-4 text-sm font-medium truncate whitespace-nowrap sm:pr-0">
                                                @if(!$task['completed'])
                                                <button wire:click.prevent="markAsComplete('{{ $task['id'] }}')"
                                                    class="text-indigo-400 hover:text-indigo-300">
                                                    <x-svg.check class="text-green-400" />
                                                </button>
                                                @else
                                                <button wire:click.prevent="markAsIncomplete('{{ $task['id'] }}')"
                                                    class="text-indigo-400 hover:text-indigo-300">
                                                    <x-svg.uncheck class="text-red-600" />
                                                </button>
                                                @endif
                                                <a href="{{ route('dashboard.tasks.manage', $task['id']) }}"
                                                    class="text-indigo-400 hover:text-indigo-300">
                                                    <x-svg.pencil />
                                                </a>
                                                <button wire:click.prevent="deleteTask('{{ $task['id'] }}')">
                                                    <x-svg.trash class="text-red-600" />
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td class="whitespace-nowrap truncate max-w-[15rem] py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                                You dont have tasks created yet.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
