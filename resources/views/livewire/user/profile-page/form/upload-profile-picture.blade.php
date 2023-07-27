<div>
    <div class="p-2">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Profile Picture</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-white">You can change your profile image here. Your avatar will be available for other users to identify you by.</p>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form wire:submit.prevent="uploadPhoto">
                    <div class="shadow sm:overflow-hidden sm:rounded-md">
                        <div class="space-y-6 bg-white dark:bg-gray-800 px-4 py-5 sm:p-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-white">Profile Image</label>
                                <div class="mt-1 flex items-center">
                                    <div class="avatar h-20 w-20">
                                        <img class="mask is-squircle" src="{{ auth()->user()->getAvatar() }}" alt="avatar"/>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2 dark:text-white">Change Image</label>

                                <x-forms.filepond wire:model="image"/>

                                @error('image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-600 px-4 py-3 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>
</div>
