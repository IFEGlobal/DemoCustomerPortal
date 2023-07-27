<div class="flex flex-col">
    <div wire:loading class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="flex flex-col space-y-4 border border-slate-150 dark:border-navy-500">
            <div class="px-4 pt-4">
                <div class="skeleton animate-wave h-8 w-10/12 rounded-full bg-slate-150 dark:bg-navy-500"></div>
            </div>
            <div class="skeleton animate-wave h-48 w-full bg-slate-150 dark:bg-navy-500"></div>
            <div class="flex flex-1 flex-col justify-between space-y-4 p-4">
                <div class="skeleton animate-wave h-4 w-9/12 rounded bg-slate-150 dark:bg-navy-500"></div>
                <div class="skeleton animate-wave h-4 w-6/12 rounded bg-slate-150 dark:bg-navy-500"></div>
                <div class="skeleton animate-wave h-4 w-full rounded bg-slate-150 dark:bg-navy-500"></div>
            </div>
        </div>
    </div>
    <div wire:loading.remove class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full w-full sm:px-6 lg:px-8">

            @include($theme->layout->header, [
                'enabledFilters' => $enabledFilters
            ])

            @if(config('livewire-powergrid.filter') === 'outside')
                @if(count($makeFilters) > 0)
                    <div>
                        <x-livewire-powergrid::frameworks.tailwind.filter
                            :makeFilters="$makeFilters"
                            :inputTextOptions="$inputTextOptions"
                            :tableName="$tableName"
                            :filters="$filters"
                            :theme="$theme"
                        />
                    </div>
                @endif
            @endif

            <div class="{{ $theme->table->divClass }}" style="{{ $theme->table->divStyle }}">
                @include($table)
            </div>

            @include($theme->footer->view)
        </div>
    </div>
</div>
