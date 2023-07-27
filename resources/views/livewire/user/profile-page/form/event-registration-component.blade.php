<div>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Data Service Registration</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-white">If you have an API, we will send you all shipment updates to your endpoint</p>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                @if (session()->has('message'))
                    <div class="alert flex overflow-hidden rounded-lg bg-warning/10 text-warning dark:bg-warning/15 mb-2">
                        <div class="flex flex-1 items-center space-x-3 p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <div class="flex-1">{{ session('message') }}</div>
                        </div>
                        <div class="w-1.5 bg-warning"></div>
                    </div>
                @endif
                @if (session()->has('token'))
                    <div x-data="{isShow:true}" data-alert-root :class="!isShow && 'opacity-0 transition-opacity duration-300'" class="alert flex items-center justify-between overflow-hidden rounded-lg bg-navy-900 py-4 px-4 text-slate-200 dark:text-navy-100 sm:px-5 mb-2">
                        <p id="copyToken">{{ session('token') }}</p>
                        <div x-data="usePopper({placement:'bottom-end',offset:4})" @click.outside="isShowPopper && (isShowPopper = false)" class="inline-flex">
                            <button x-ref="popperRef" @click="isShowPopper = !isShowPopper" class="btn -mr-1.5 h-7 w-7 shrink-0 rounded-full p-0 text-white hover:bg-white/20 focus:bg-white/20 active:bg-white/25">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                                </svg>
                            </button>
                            <div x-ref="popperRoot" class="popper-root" :class="isShowPopper && 'show'">
                                <div class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                                    <ul>
                                        <li>
                                            <a @click="isShow = false; setTimeout(()=>$el.closest('[data-alert-root]').remove(),300)" href="#" class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Remove</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <form wire:submit.prevent="createService">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white  dark:bg-gray-800 px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-white">Service Name</label>
                                    <input wire:model="service_name" name="service_name" class="mt-1 text-xs form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text"/>
                                    @error('service_name') <p class=\"text-danger\">{{$message}}</p> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-white">Service URL</label>
                                    <input wire:model="service_url" name="service_url" class="mt-1 text-xs form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text"/>
                                    @error('service_url') <p class=\"text-danger\">{{$message}}</p> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-white">Access Token</label>
                                    <input wire:model="service_token" name="tokenservice_token" class="mt-1 text-xs form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text"/>
                                    @error('service_token') <p class=\"text-danger\">{{$message}}</p> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <span>What type of event is it?</span>
                                    <select wire:model="service_token_type" name="service_token_type" class="form-select mt-1 h-8 w-full rounded-lg border border-slate-300 bg-white px-2.5 text-xs+ hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                        <option>Select auth if applicable</option>
                                        <option value="basic">basic auth</option>
                                        <option value="apiKey">api-key</option>
                                        <option value="x-api-key">x-api-key</option>
                                        <option value="bearer">bearer token</option>
                                    </select>
                                    @error('service_token_type') <p class=\"text-danger\">{{$message}}</p> @enderror
                                </div>

                                @if($service_token_type == 'basic')
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-white">Username</label>
                                        <input wire:model="service_username" name="tokeservice_username" class="mt-1 text-xs form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text"/>
                                        @error('service_username') <p class=\"text-danger\">{{$message}}</p> @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-white">Password</label>
                                        <input wire:model="service_password" name="service_password" class="mt-1 text-xs form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="password"/>
                                        @error('service_password') <p class=\"text-danger\">{{$message}}</p> @enderror
                                    </div>
                                @endif

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-white">Enter Your Password</label>
                                    <input wire:model="password" name="password" class="mt-1 text-xs form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="password"/>
                                    @error('password') <p class=\"text-danger\">{{$message}}</p> @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <h2 class="text-lg text-center font-bold leading-7 text-gray-900">{{ $testResult }}</h2>
                                </div>
                            </div>
                        </div>
                        @if($testResult !== null)
                            <div class="bg-gray-50 dark:bg-gray-600 px-4 py-3 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Register</button>
                            </div>
                        @endif
                    </div>
                </form>
                    <div class="mt-1 bg-gray-50 dark:bg-gray-600 px-4 py-3 text-right sm:px-6">
                        <button wire:click="testEndpoint()"class="inline-flex justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-800 focus:ring-offset-2">Test Endpoint</button>
                    </div>
            </div>
        </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Current Registered Services</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-white">These are your current registered services. These services will receive events from our API</p>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                <livewire:user.profile-page.edit-event-service/>
            </div>
        </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>
</div>
