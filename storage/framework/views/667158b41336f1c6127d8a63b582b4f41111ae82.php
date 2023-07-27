<div x-show="$store.global.isRightSidebarExpanded" @keydown.window.escape="$store.global.isRightSidebarExpanded = false">
    <div class="fixed inset-0 z-[150] bg-slate-900/60 transition-opacity duration-200"
        @click="$store.global.isRightSidebarExpanded = false" x-show="$store.global.isRightSidebarExpanded"
        x-transition:enter="ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>
    <div class="fixed right-0 top-0 z-[151] h-full w-full sm:w-80">
        <div x-data="{ activeTab: 'tabHome' }"
            class="relative flex h-full w-full transform-gpu flex-col bg-white transition-transform duration-200 dark:bg-navy-750"
            x-show="$store.global.isRightSidebarExpanded" x-transition:enter="ease-out"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="ease-in" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full">

            <div class="flex items-center justify-between py-2 px-4">
                <p class="flex shrink-0 items-center space-x-1.5">
                    <img src="<?php echo e(URL::to('/icons/right-side-user.svg')); ?>" class="flex-shrink-0 w-6 h-6" aria-hidden="true">
                    <span class="text-xs"><?php echo e(auth()->user()->name); ?></span>
                </p>

                <button @click="$store.global.isRightSidebarExpanded=false"
                    class="btn -mr-1 h-6 w-6 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div x-show="activeTab === 'tabHome'" x-transition:enter="transition-all duration-500 easy-in-out"
                x-transition:enter-start="opacity-0 [transform:translate3d(0,1rem,0)]"
                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                class="is-scrollbar-hidden overflow-y-auto overscroll-contain pt-1">
                <div>
                    <div class="grid grid-cols-1 gap-3 px-3">
                        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('right-side-bar.organisation-details-component', [])->html();
} elseif ($_instance->childHasBeenRendered('DMjTGeJ')) {
    $componentId = $_instance->getRenderedChildComponentId('DMjTGeJ');
    $componentTag = $_instance->getRenderedChildComponentTagName('DMjTGeJ');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('DMjTGeJ');
} else {
    $response = \Livewire\Livewire::mount('right-side-bar.organisation-details-component', []);
    $html = $response->html();
    $_instance->logRenderedChild('DMjTGeJ', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                    </div>

                    <div class="h-18"></div>
                </div>
            </div>

            <div x-show="activeTab === 'tabProjects'" x-transition:enter="transition-all duration-500 easy-in-out"
                x-transition:enter-start="opacity-0 [transform:translate3d(0,1rem,0)]"
                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                class="is-scrollbar-hidden overflow-y-auto overscroll-contain px-3 pt-1">

                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('right-side-bar.whats-happening-today', [])->html();
} elseif ($_instance->childHasBeenRendered('y1VXhrP')) {
    $componentId = $_instance->getRenderedChildComponentId('y1VXhrP');
    $componentTag = $_instance->getRenderedChildComponentTagName('y1VXhrP');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('y1VXhrP');
} else {
    $response = \Livewire\Livewire::mount('right-side-bar.whats-happening-today', []);
    $html = $response->html();
    $_instance->logRenderedChild('y1VXhrP', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

                <div class="h-18"></div>
            </div>

            <div x-show="activeTab === 'tabActivity'" x-transition:enter="transition-all duration-500 easy-in-out"
                x-transition:enter-start="opacity-0 [transform:translate3d(0,1rem,0)]"
                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                class="is-scrollbar-hidden overflow-y-auto overscroll-contain pt-1">

                <div>
                    <div class="grid grid-cols-1 gap-3 px-3">
                        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('right-side-bar.notifications', [])->html();
} elseif ($_instance->childHasBeenRendered('Um0ur8i')) {
    $componentId = $_instance->getRenderedChildComponentId('Um0ur8i');
    $componentTag = $_instance->getRenderedChildComponentTagName('Um0ur8i');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('Um0ur8i');
} else {
    $response = \Livewire\Livewire::mount('right-side-bar.notifications', []);
    $html = $response->html();
    $_instance->logRenderedChild('Um0ur8i', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                    </div>

                    <div class="h-18"></div>
                </div>
            </div>

            <div class="pointer-events-none absolute bottom-4 flex w-full justify-center">
                <div class="pointer-events-auto mx-auto flex space-x-1 rounded-full border border-slate-150 bg-white px-4 py-0.5 shadow-lg dark:border-navy-700 dark:bg-navy-900">
                    <button @click="activeTab = 'tabHome'"
                        :class="activeTab === 'tabHome' && 'text-primary dark:text-accent'"
                        class="btn h-9 rounded-full py-0 px-4 hover:bg-slate-300/20 hover:text-primary focus:bg-slate-300/20 focus:text-primary active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:hover:text-accent dark:focus:bg-navy-300/20 dark:focus:text-accent dark:active:bg-navy-300/25">
                        <svg x-show="activeTab === 'tabHome'" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        <svg x-show="activeTab !== 'tabHome'" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </button>
                    <button @click="activeTab = 'tabProjects'"
                        :class="activeTab === 'tabProjects' && 'text-primary dark:text-accent'"
                        class="btn h-9 rounded-full py-0 px-4 hover:bg-slate-300/20 hover:text-primary focus:bg-slate-300/20 focus:text-primary active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:hover:text-accent dark:focus:bg-navy-300/20 dark:focus:text-accent dark:active:bg-navy-300/25">
                        <svg x-show="activeTab === 'tabProjects'" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>

                        <svg x-show="activeTab !== 'tabProjects'" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>
                    </button>
                    <button @click="activeTab = 'tabActivity'"
                        :class="activeTab === 'tabActivity' && 'text-primary dark:text-accent'"
                        class="btn h-9 rounded-full py-0 px-4 hover:bg-slate-300/20 hover:text-primary focus:bg-slate-300/20 focus:text-primary active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:hover:text-accent dark:focus:bg-navy-300/20 dark:focus:text-accent dark:active:bg-navy-300/25">
                        <svg x-show="activeTab ===  'tabActivity'" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd" />
                        </svg>
                        <svg x-show="activeTab !==  'tabActivity'" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="btn h-9 rounded-full py-0 px-4 hover:bg-slate-300/20 hover:text-primary focus:bg-slate-300/20 focus:text-primary active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:hover:text-accent dark:focus:bg-navy-300/20 dark:focus:text-accent dark:active:bg-navy-300/25">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/DemoCustomerPortal/resources/views/components/app-partials/right-sidebar.blade.php ENDPATH**/ ?>