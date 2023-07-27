<div>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Notifications</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-white">Decide which communications you'd like to receive and how.</p>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form wire:submit.prevent="createUpdateNotificationSettings">
                    <fieldset>
                        <legend class="sr-only dark:text-white">User Notification Settings</legend>
                            <div class="text-base font-medium text-gray-900 dark:text-white" aria-hidden="true">User Notification Settings</div>
                            <div class="mt-4 space-y-4">
                                <div class="overflow-hidden shadow sm:rounded-md">
                                    <div class="space-y-6 bg-white dark:bg-gray-800 px-4 py-5 sm:p-6">
                                        <fieldset>
                                            <legend class="contents text-base font-medium text-gray-900 dark:text-white">Email  Notifications</legend>
                                            <p class="text-sm text-gray-500 dark:text-white mb-4">These are delivered to your user email address on creation.</p>
                                            <div x-data="{expandedItem:null}" class="flex flex-col space-y-4 sm:space-y-5 lg:space-y-6">
                                                <div x-data="accordionItem('item-1')" class="overflow-hidden rounded-lg border border-slate-150 dark:border-navy-500">
                                                    <div class="flex items-center justify-between bg-slate-150 px-4 py-4 dark:bg-navy-500 sm:px-5">
                                                        <div class="flex items-center space-x-3.5 tracking-wide outline-none transition-all">
                                                            <div class="avatar h-10 w-10">
                                                                <img src="{{ URL::to('/icons/cargoship-icon-1.svg') }}" width="80">
                                                            </div>
                                                            <div>
                                                                <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                                    Shipment Notifications
                                                                </p>
                                                                <p class="text-xs text-slate-500 dark:text-navy-300">
                                                                    Email notification relating to containers and shipments sent via email on creation
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <a @click="expanded = !expanded" class="btn -mr-1.5 h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                                            <i :class="expanded && '-rotate-180'" class="fas fa-chevron-down text-sm transition-transform"></i>
                                                        </a>
                                                    </div>
                                                    <div x-collapse x-show="expanded">
                                                        <div class="px-4 py-4 sm:px-5">
                                                            <p class="text-xs+"> Please check the box that relates to the type of notification you require</p>
                                                            <div class="flex gap-x-6 mt-2">
                                                                <div class="flex">
                                                                    <input wire:model.lazy="EmailNewShipments" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-1" class="text-xs text-gray-500 ml-3 dark:text-gray-400">New Shipments</label>
                                                                </div>

                                                                <div class="flex">
                                                                    <input wire:model.lazy="EmailNewContainers" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-2" class="text-xs text-gray-500 ml-3 dark:text-gray-400">New Containers</label>
                                                                </div>

                                                                <div class="flex">
                                                                    <input wire:model.lazy="EmailShipmentUpdates" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-3" class="text-xs text-gray-500 ml-3 dark:text-gray-400">Shipment Updates</label>
                                                                </div>

                                                                <div class="flex">
                                                                    <input wire:model.lazy="EmailShipmentArrivalNotices" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-5" class="text-xs text-gray-500 ml-3 dark:text-gray-400">Arrival Notices</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div x-data="accordionItem('item-2')" class="overflow-hidden rounded-lg border border-slate-150 dark:border-navy-500">
                                                    <div class="flex items-center justify-between bg-slate-150 px-4 py-4 dark:bg-navy-500 sm:px-5">
                                                        <div class="flex items-center space-x-3.5 tracking-wide outline-none transition-all">
                                                            <div class="avatar h-10 w-10">
                                                                <img src="{{ URL::to('/icons/truck.svg') }}" width="80">
                                                            </div>
                                                            <div>
                                                                <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                                    Delivery Notifications
                                                                </p>
                                                                <p class="text-xs text-slate-500 dark:text-navy-300">
                                                                    Email notification relating to container deliveries sent via email on creation
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <a @click="expanded = !expanded" class="btn -mr-1.5 h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                                            <i :class="expanded && '-rotate-180'" class="fas fa-chevron-down text-sm transition-transform"></i>
                                                        </a>
                                                    </div>
                                                    <div x-collapse x-show="expanded">
                                                        <div class="px-4 py-4 sm:px-5">
                                                            <p class="text-xs+"> Please check the box that relates to the type of notification you require</p>
                                                            <div class="flex gap-x-6 mt-2">
                                                                <div class="flex">
                                                                    <input wire:model.lazy="EmailNewDeliveries" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-1" class="text-xs text-gray-500 ml-3 dark:text-gray-400">New Deliveries</label>
                                                                </div>

                                                                <div class="flex">
                                                                    <input wire:model.lazy="EmailDeliveryUpdates" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-3" class="text-xs text-gray-500 ml-3 dark:text-gray-400">Delivery Updates</label>
                                                                </div>

                                                                <div class="flex">
                                                                    <input wire:model.lazy="EmailDeliveryArrivalNotices" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-2" class="text-xs text-gray-500 ml-3 dark:text-gray-400">Arrival Notices</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div x-data="accordionItem('item-3')" class="overflow-hidden rounded-lg border border-slate-150 dark:border-navy-500">
                                                    <div class="flex items-center justify-between bg-slate-150 px-4 py-4 dark:bg-navy-500 sm:px-5">
                                                        <div class="flex items-center space-x-3.5 tracking-wide outline-none transition-all">
                                                            <div class="avatar h-8 w-8">
                                                                <img src="{{ URL::to('/icons/paper.svg') }}" width="60">
                                                            </div>
                                                            <div>
                                                                <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                                    Document Notifications
                                                                </p>
                                                                <p class="text-xs text-slate-500 dark:text-navy-300">
                                                                    Email notification relating to documents and invoices sent via email on creation
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <a @click="expanded = !expanded" class="btn -mr-1.5 h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                                            <i :class="expanded && '-rotate-180'" class="fas fa-chevron-down text-sm transition-transform"></i>
                                                        </a>
                                                    </div>
                                                    <div x-collapse x-show="expanded">
                                                        <div class="px-4 py-4 sm:px-5">
                                                            <p class="text-xs+"> Please check the box that relates to the type of notification you require</p>
                                                            <div class="flex gap-x-6 mt-2">
                                                                <div class="flex">
                                                                    <input wire:model.lazy="EmailNewDocuments" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-1" class="text-xs text-gray-500 ml-3 dark:text-gray-400">New Documents</label>
                                                                </div>

                                                                <div class="flex">
                                                                    <input wire:model.lazy="EmailNewInvoices" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-3" class="text-xs text-gray-500 ml-3 dark:text-gray-400">New Invoices</label>
                                                                </div>

                                                                <div class="flex">
                                                                    <input wire:model.lazy="EmailPaymentNotices" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-2" class="text-xs text-gray-500 ml-3 dark:text-gray-400">Payment Notices</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="mt-4">
                                            <legend class="contents text-base font-medium text-gray-900 dark:text-white">Push Notifications</legend>
                                            <p class="text-sm text-gray-500 dark:text-white mb-4">These are delivered via the portal to your notifications panel.</p>
                                            <div x-data="{expandedItem:null}" class="flex flex-col space-y-4 sm:space-y-5 lg:space-y-6">
                                                <div x-data="accordionItem('item-1')" class="overflow-hidden rounded-lg border border-slate-150 dark:border-navy-500">
                                                    <div class="flex items-center justify-between bg-slate-150 px-4 py-4 dark:bg-navy-500 sm:px-5">
                                                        <div class="flex items-center space-x-3.5 tracking-wide outline-none transition-all">
                                                            <div class="avatar h-10 w-10">
                                                                <img src="{{ URL::to('/icons/cargoship-icon-1.svg') }}" width="80">
                                                            </div>
                                                            <div>
                                                                <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                                    Shipment Notifications
                                                                </p>
                                                                <p class="text-xs text-slate-500 dark:text-navy-300">
                                                                    Email notification relating to containers and shipments sent via email on creation
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <a @click="expanded = !expanded" class="btn -mr-1.5 h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                                            <i :class="expanded && '-rotate-180'" class="fas fa-chevron-down text-sm transition-transform"></i>
                                                        </a>
                                                    </div>
                                                    <div x-collapse x-show="expanded">
                                                        <div class="px-4 py-4 sm:px-5">
                                                            <p class="text-xs+"> Please check the box that relates to the type of notification you require</p>
                                                            <div class="flex gap-x-6 mt-2">
                                                                <div class="flex">
                                                                    <input wire:model.lazy="PushNewShipments" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-1" class="text-xs text-gray-500 ml-3 dark:text-gray-400">New Shipments</label>
                                                                </div>

                                                                <div class="flex">
                                                                    <input wire:model.lazy="PushNewContainers" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-2" class="text-xs text-gray-500 ml-3 dark:text-gray-400">New Containers</label>
                                                                </div>

                                                                <div class="flex">
                                                                    <input wire:model.lazy="PushShipmentUpdates" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-3" class="text-xs text-gray-500 ml-3 dark:text-gray-400">Shipment Updates</label>
                                                                </div>

                                                                <div class="flex">
                                                                    <input wire:model.lazy="PushShipmentArrivalNotices" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-5" class="text-xs text-gray-500 ml-3 dark:text-gray-400">Arrival Notices</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div x-data="accordionItem('item-2')" class="overflow-hidden rounded-lg border border-slate-150 dark:border-navy-500">
                                                    <div class="flex items-center justify-between bg-slate-150 px-4 py-4 dark:bg-navy-500 sm:px-5">
                                                        <div class="flex items-center space-x-3.5 tracking-wide outline-none transition-all">
                                                            <div class="avatar h-10 w-10">
                                                                <img src="{{ URL::to('/icons/truck.svg') }}" width="80">
                                                            </div>
                                                            <div>
                                                                <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                                    Delivery Notifications
                                                                </p>
                                                                <p class="text-xs text-slate-500 dark:text-navy-300">
                                                                    Email notification relating to container deliveries sent via email on creation
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <a @click="expanded = !expanded" class="btn -mr-1.5 h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                                            <i :class="expanded && '-rotate-180'" class="fas fa-chevron-down text-sm transition-transform"></i>
                                                        </a>
                                                    </div>
                                                    <div x-collapse x-show="expanded">
                                                        <div class="px-4 py-4 sm:px-5">
                                                            <p class="text-xs+"> Please check the box that relates to the type of notification you require</p>
                                                            <div class="flex gap-x-6 mt-2">
                                                                <div class="flex">
                                                                    <input wire:model.lazy="PushNewDeliveries" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-1" class="text-xs text-gray-500 ml-3 dark:text-gray-400">New Deliveries</label>
                                                                </div>

                                                                <div class="flex">
                                                                    <input wire:model.lazy="PushDeliveryUpdates" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-3" class="text-xs text-gray-500 ml-3 dark:text-gray-400">Delivery Updates</label>
                                                                </div>

                                                                <div class="flex">
                                                                    <input wire:model.lazy="PushDeliveryArrivalNotices" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-2" class="text-xs text-gray-500 ml-3 dark:text-gray-400">Arrival Notices</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div x-data="accordionItem('item-3')" class="overflow-hidden rounded-lg border border-slate-150 dark:border-navy-500">
                                                    <div class="flex items-center justify-between bg-slate-150 px-4 py-4 dark:bg-navy-500 sm:px-5">
                                                        <div class="flex items-center space-x-3.5 tracking-wide outline-none transition-all">
                                                            <div class="avatar h-8 w-8">
                                                                <img src="{{ URL::to('/icons/paper.svg') }}" width="60">
                                                            </div>
                                                            <div>
                                                                <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                                    Document Notifications
                                                                </p>
                                                                <p class="text-xs text-slate-500 dark:text-navy-300">
                                                                    Email notification relating to documents and invoices sent via email on creation
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <a @click="expanded = !expanded" class="btn -mr-1.5 h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                                            <i :class="expanded && '-rotate-180'" class="fas fa-chevron-down text-sm transition-transform"></i>
                                                        </a>
                                                    </div>
                                                    <div x-collapse x-show="expanded">
                                                        <div class="px-4 py-4 sm:px-5">
                                                            <p class="text-xs+"> Please check the box that relates to the type of notification you require</p>
                                                            <div class="flex gap-x-6 mt-2">
                                                                <div class="flex">
                                                                    <input wire:model.lazy="PushNewDocuments" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-1" class="text-xs text-gray-500 ml-3 dark:text-gray-400">New Documents</label>
                                                                </div>

                                                                <div class="flex">
                                                                    <input wire:model.lazy="PushNewInvoices" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-3" class="text-xs text-gray-500 ml-3 dark:text-gray-400">New Invoices</label>
                                                                </div>

                                                                <div class="flex">
                                                                    <input wire:model.lazy="PushPaymentNotices" class="form-checkbox is-basic h-5 w-5 rounded-full border-slate-400/70 checked:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox"/>
                                                                    <label for="hs-checkbox-group-2" class="text-xs text-gray-500 ml-3 dark:text-gray-400">Payment Notices</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="bg-gray-50 dark:bg-gray-600 px-4 py-3 text-right sm:px-6">
                                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                                    </div>
                                </div>
                            </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
