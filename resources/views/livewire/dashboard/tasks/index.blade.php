<div>
    <div class="bg-gray-900">
        <div class="mx-auto max-w-7xl">
          <div class="bg-gray-900 py-10">
            <div class="px-4 sm:px-6 lg:px-8">
              <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                  <h1 class="text-base font-semibold leading-6 text-white">Tasks</h1>
                  <p class="mt-2 text-sm text-gray-300">A list of all the users in your account including their name, title, email and role.</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                  <button type="button" class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Add Task</button>
                </div>
              </div>
              <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-700">
                      <thead>
                        <tr>
                          <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">Title</th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Description</th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Status</th>
                          <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                            <span class="sr-only">Edit</span>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-800">
                        @foreach ($this->tasks as $task)
                        <tr>
                          <td class="whitespace-nowrap truncate max-w-[15rem] py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">{{ $task['title'] }}</td>
                          <td class="whitespace-nowrap truncate max-w-[18rem] px-3 py-4 text-sm text-gray-300">
                            {{ $task['description'] }}
                          </td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                            @if($task['completed'])
                                <span class="bg-green-500 text-white rounded-full text-xs font-medium py-1 px-4">
                                    Completed
                                </span>
                            @else
                            <span class="bg-gray-500 text-white rounded-full text-xs font-medium py-1 px-3">
                                incompleted
                            </span>
                            @endif
                          </td>
                          <td class="relative truncate whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                            <a href="#" class="text-indigo-400 hover:text-indigo-300">Edit<span class="sr-only">, Lindsay Walton</span></a>
                          </td>
                        </tr>
                        @endforeach
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
