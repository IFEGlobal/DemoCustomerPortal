<div>
    <x-custom-modal wire:model="show">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-md font-semibold text-gray-900 dark:text-white">
                        Select Table Columns
                    </h3>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <p class="text-xs+ leading-relaxed text-gray-500 dark:text-gray-400">
                       Selected columns will be saved in your table configuration settings which can be accessed using the configure button on every table.
                    </p>

                    <p class="text-xs+ leading-relaxed text-gray-500 dark:text-gray-400 mt-1">
                        The available columns for this table are listed below .
                    </p>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="flex items-center mr-4">
                            <input id="inline-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="inline-checkbox" class="ml-2 text-xs font-medium text-gray-900 dark:text-gray-300">Inline 1</label>
                        </div>
                        <div class="flex items-center mr-4">
                            <input id="inline-2-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="inline-2-checkbox" class="ml-2 text-xs font-medium text-gray-900 dark:text-gray-300">Inline 2</label>
                        </div>
                        <div class="flex items-center mr-4">
                            <input checked id="inline-checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="inline-checked-checkbox" class="ml-2 text-xs font-medium text-gray-900 dark:text-gray-300">Inline checked</label>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-3 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="button" class="text-white bg-blue-700 text-sm hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save Configuration</button>
                </div>
            </div>
        </div>
    </x-custom-modal>
</div>
