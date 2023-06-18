<div class="" x-data="{
    imageUrl: '{{ $task->attachmentUrl }}',
    editing: '{{ $editing }}',
    hasNotAttachmentSaved: '{{ $task->attachmentUrl === '' }}',
    temporaryFile: '',
    fileChosen(event) {
        if (!event.target.files.length) return;
        let file = event.target.files[0];

        const tempUrl = URL.createObjectURL(file);

        this.imageUrl = tempUrl;
        this.temporaryFile = file;
    },
    removePhoto(){
        this.temporaryFile = '';
        this.imageUrl = '';
        this.hasNotAttachmentSaved = true;
        $wire.set('image', '');
        $wire.set('removeOldFile', true);
    },
    save(){
        if (this.temporaryFile){
            @this.upload('image', this.temporaryFile);
        }

        $wire.call('save');
    }
}">
    <form class="max-w-xl p-8 mx-auto" x-on:submit.prevent="save">
        <div class="space-y-12">
            <div class="pb-12 border-b border-white/10">
                <h2 class="text-base font-semibold leading-7 text-white">Create Task</h2>
                <p class="mt-1 text-sm leading-6 text-gray-400">Please, fill the fields to create a new task</p>

                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        <label for="username" class="block text-sm font-medium leading-6 text-white">Title</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                <input type="text" wire:model.defer="task.title" name="title" id="title"
                                    autocomplete="title"
                                    class="flex-1 rounded pl-3 border-0 bg-transparent py-1.5 text-white focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="// Todo">
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="about" class="block text-sm font-medium leading-6 text-white">Description</label>
                        <div class="mt-2">
                            <textarea wire:model.defer="task.description" id="description" name="description" rows="3"
                                class="block resize-none w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"></textarea>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-gray-400">Describe what you need to do.</p>
                    </div>

                    <div class="col-span-full">
                        <label for="cover-photo"
                            class="block text-sm font-medium leading-6 text-white">Attachments</label>
                        <div class="mb-4 col-span-full" >
                            <div class="relative flex flex-col items-center w-full mt-2"
                            x-show="!temporaryFile && hasNotAttachmentSaved " x-cloak>
                                <div
                                    class="flex justify-center w-full px-6 py-10 mt-2 border border-dashed rounded-lg border-white/25">
                                    <div class="text-center">
                                        <svg class="w-12 h-12 mx-auto text-gray-500" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div class="flex mt-4 text-sm leading-6 text-center text-gray-400">
                                            <label for="new_photo"
                                                class="relative font-semibold text-white bg-gray-900 rounded-md cursor-pointer focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:ring-offset-gray-900 hover:text-indigo-500">
                                                <span>Upload a file</span>
                                            </label>
                                            <input accept="image/*" type="file" id="new_photo" name="new_image"
                                                wire:model="image" x-ref="image" class="hidden"
                                                @change="fileChosen" />
                                        </div>
                                        <p class="text-xs leading-5 text-gray-400">PNG, JPG, GIF up to 3MB</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2 mt-4" x-show="imageUrl" x-cloak>
                                    <div class="relative flex items w-72 h-72">
                                        <img :src="imageUrl" class="object-cover" accept="image/*" />
                                        <div class="absolute flex items-center justify-center w-6 h-6 p-1 transition-all rounded-full cursor-pointer top-2 right-2 hover:bg-red-500 hover:text-white"
                                                @click="removePhoto">
                                            <x-svg.trash  class="text-gray-700" />
                                        </div>
                                    </div>
                            </div>
                            @error('image')
                            <div class="pt-2 text-red-500">
                                {{ str_replace('image', 'photo', $message) }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6 gap-x-6">
                    <a href="{{ route('dashboard.tasks.index') }}">
                        <button type="button" class="text-sm font-semibold leading-6 text-white">Cancel</button>
                    </a>
                    <button type="submit"
                        class="px-3 py-2 text-sm font-semibold text-white bg-indigo-500 rounded-md shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
                </div>
            </div>
    </form>
</div>
