<div>
    @if(count($shipments) < 1)
        Please select a month or route to load related shipments
    @endif
    @if($route !== null)Showing {{ $route[0] ?? '' }} to {{ $route[1] }}@endif

    <div class="card mt-3">
        <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
            <table class="is-hoverable w-full text-left">
                <thead>
                <tr>
                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                        References
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                        Journey
                    </th>
                    <th class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                        Dept/Arr
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($shipments as $shipment)
                    <tr wire:click="goToShipment('{{ $shipment->id }}')" class="border-y cursor-pointer border-transparent border-b-slate-200 dark:border-b-navy-500">
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            <p class="font-medium text-xs">{{ \Illuminate\Support\Str::limit($shipment->PO_number, 10) ?? 'No PO Number' }}</p>
                            <p class="mt-0.5 text-xs">{{ $shipment->shipment_ref ?? '' }}</p>
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            <p class="font-medium text-xs">{{ $shipment->loading_port_name ?? '' }}</p>
                            <p class="mt-0.5 text-xs">{{ $shipment->disc_port_name ?? '' }}</p>
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            <p class="font-medium text-xs">{{ $shipment->estimated_departure?->format('D d M y') ?? '' }}</p>
                            <p class="mt-0.5 text-xs">{{ $shipment->estimated_arrival?->format('D d M y') ?? '' }}</p>
                        </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-2 px-2">
        {{ $shipments->links() }}
    </div>
</div>
