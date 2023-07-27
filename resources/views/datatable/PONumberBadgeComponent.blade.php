@if($value == null)
    <span class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-800">No PO Number</span>
@elseif(strlen($value) > 12)
    <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-indigo-200 dark:text-indigo-800">{{ Illuminate\Support\Str::limit($value), 12 }}</span>
@else
    <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-greed-200 dark:text-green-800">{{ Str::limit($value), 12 }}</span>
@endif
