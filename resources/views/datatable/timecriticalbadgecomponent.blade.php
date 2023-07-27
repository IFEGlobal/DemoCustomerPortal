@if(is_null($value['com']))
    <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-indigo-200 dark:text-indigo-900">
        Awaiting Completion Date
    </span>
@elseif(isset($value['com']) && $value['com'] < $value['est'])
    <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">
        Excellent
    </span>
@elseif(isset($value['com']) && $value['com'] == $value['est'])
    <span class="bg-orange-100 text-orange-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-orange-200 dark:text-orange-900">
       Satisfied
    </span>
@elseif(isset($value['com']) && $value['com'] > $value['est'])
    <span class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">
        Not Met
    </span>
@endif
