<div>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Password</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-white">Please ensure your password meets the minimum requirement</p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-white"> Needed are: Mix of uppercase and lowercase | Digit (1-9) | Non numeric, For example: !, $, #, or %.
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form wire:submit.prevent="changePassword">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white dark:bg-gray-800 px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-white">Current Password</label>
                                    <input type="password" wire:model="current_password" name="current_password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('current_password') <p class=\"text-danger\">{{$message}}</p> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-white">New Password</label>
                                    <input type="password" wire:model="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('password') <p class=\"text-danger\">{{$message}}</p> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="confirm_password" class="block text-sm font-medium text-gray-700 dark:text-white">Confirm Password</label>
                                    <input type="password" wire:model="password_confirmation" name="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('password_confirmation') <p class=\"text-danger\">{{$message}}</p> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <span class="font-semibold dark:text-white">Password Strength</span> {{ $passwordStrengthLevels[$strengthScore] ?? 'Weak' }}

                                    <div>
                                        <progress value="{{ $strengthScore }}" max="4" class="bg-blue-600 h-2.5 rounded-full w-full mt-1 "></progress>
                                    </div>
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
