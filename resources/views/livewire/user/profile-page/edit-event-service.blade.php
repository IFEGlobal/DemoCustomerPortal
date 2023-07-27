<div>
    <div wire:poll.visible class="mb-4 px-4 py-3 leading-normal text-blue-700 bg-blue-100 rounded-lg" role="alert">
        Click "Edit", modify that line data and click "Save". Services with incorrect username/passwords must be deleted and recreated.
    </div>
    <table class="table min-w-full">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3 text-left">
                Service Name / URL
            </th>
            <th scope="col" class="px-6 py-3 text-left">
                Action
            </th>
        </tr>
        </thead>
        <tbody class="bg-white">
        @foreach ($services as $index => $service)
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                    @if ($editedServiceIndex === $index || $editedServiceField === $index . '.service_name')
                        <input type="text" @click.away="$wire.editedServiceField === '{{ $index }}.service_name' ? $wire.saveService({{ $index }}) : null" wire:model.defer="services.{{ $index }}.service_name" class="mt-2 text-xs sm:text-base pl-2 pr-4 rounded-lg border w-full py-2 focus:outline-none focus:border-blue-400 {{ $errors->has('services.' . $index . '.service_name') ? 'border-red-500' : 'border-gray-400' }}"/>
                        @if ($errors->has('services.' . $index . '.service_name'))
                            <div class="text-red-500">{{ $errors->first('services.' . $index . '.service_name') }}</div>
                        @endif
                    @else
                        <div class="cursor-pointer" wire:click="editServiceField({{ $index }}, 'service_name')">
                            {{ $service['service_name'] }}
                        </div>
                    @endif

                        @if ($editedServiceIndex === $index || $editedServiceIndex === $index . '.service_url')
                            <input type="text" @click.away="$wire.editedServiceIndex === '{{ $index }}.service_url' ? $wire.saveService({{ $index }}) : null" wire:model.defer="services.{{ $index }}.service_url" class="mt-2 text-xs sm:text-base pl-2 pr-4 rounded-lg border w-full py-2 focus:outline-none focus:border-blue-400 {{ $errors->has('services.' . $index . '.service_url') ? 'border-red-500' : 'border-gray-400' }}"/>
                            @if ($errors->has('services.' . $index . '.service_url'))
                                <div class="text-red-500">{{ $errors->first('services.' . $index . '.service_url') }}</div>
                            @endif
                        @else
                            <div class="cursor-pointer" wire:click="editServiceField({{ $index }}, 'service_url')">
                                {{ $service['service_url'] }}
                            </div>
                        @endif
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                    @if($editedServiceIndex === $index || (isset($editedServiceIndex) && (int)(explode('.',$editedServiceIndex)[0]) === $index))
                        <a wire:click.prevent="saveService({{$index}})" class="font-medium cursor-pointer mb-1 text-green-600 dark:text-green-500 hover:underline mr-1">Save</a>
                    @else
                        <a wire:click.prevent="editService({{$index}})" class="font-medium cursor-pointer mb-1 text-blue-600 dark:text-blue-500 hover:underline mr-1">Edit</a>
                    @endif
                        <a wire:click.prevent="deleteService({{ $service['id'] }})" class="font-medium cursor-pointer mb-1 text-red-600 dark:text-red-500 hover:underline mr-1">Delete</a>
                        <a wire:click.prevent="viewLogs({{ $service['id'] }})" class="font-medium cursor-pointer mb-1 text-indigo-600 dark:text-indigo-500 hover:underline mr-1">Logs</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
