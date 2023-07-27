<div>
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">
            <div class="w-full h-full bg-white shadow-lg rounded-xl overflow-hidden dark:bg-gray-800 p-4 mb-1 col-span-12">
                <div class="flex flex-wrap mb-4 p-2">
                    <div class="flex items-center">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">User Accounts</span>
                    </div>
                </div>
                <livewire:control-center.full-users-datatable/>
            </div>
        </div>
    </main>
</div>
