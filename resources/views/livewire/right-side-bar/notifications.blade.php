<div>
    <h2 class="text-xs+ font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 mb-2">
        My Notifications
    </h2>
    <div class="grid grid-cols-1 gap-3">
        @if(count($notifications) < 1)
        <div class="rounded-lg border border-slate-150 p-3 dark:border-navy-600">
            <div class="flex cursor-pointer items-center space-x-3">
                <img class="h-10 w-10 rounded-lg object-cover object-center" src="{{ URL::to('/icons/chat.svg') }}" alt="image" />
                <div>
                    <p class="font-medium leading-snug text-slate-700 dark:text-navy-100">
                        No New Notifications
                    </p>
                    <p class="text-xs text-slate-400 dark:text-navy-300">
                        There doesn't seem to be any new notifications at this time
                    </p>
                </div>
            </div>
        </div>
        @else
            @foreach($notifications as $notification)
                <div wire:poll.30s class="flex items-center space-x-4">
                    <a href="{{ "https://logisticsmartportal.com/".$notification->data[0]['route'] ?? '#' }}" class="flex-1 cursor-pointer min-w-0">
                        <p class="text-xs+ text-gray-500 dark:text-gray-400">
                            <span class="flex">
                                <img class="w-6 h-6 mr-2" src="{{ URL::to($notification->data[0]['icon']) ?? null }}" alt="icon"> {{ $notification->data[0]['message'] ?? 'No Message' }}
                                : {{ $notification->created_at->diffForHumans() }}
                            </span>
                        </p>
                    </a>
                </div>
            @endforeach
        @endif
    </div>
</div>
