<div>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Personal Information</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-white">Change information saved in your account here. Please ensure change of email is correct where you can recieve mail.</p>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form wire:submit.prevent="updateAccount">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white dark:bg-gray-800 px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-white">Full Name</label>
                                    <input wire:model="name" type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('email') <span class="error mt-1 text-red-600">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-white">Email Address</label>
                                    <input wire:model="email"  type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('email') <span class="error mt-1 text-red-600">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="contact_no" class="block text-sm font-medium text-gray-700 dark:text-white">Contact Number</label>
                                    <input wire:model="contact_no"  type="text" x-input-mask="{numericOnly: true, blocks: [0, 3, 4, 4], delimiters: ['(', ') ', '-']}" name="contact_no" id="contact_no" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('contact_no') <span class="error mt-1 text-red-600">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-white">Job Role</label>
                                    <input wire:model="role"  type="text" name="role" id="role"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('job_role') <span class="error mt-1 text-red-600">{{ $message }}</span> @enderror
                                </div>

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
