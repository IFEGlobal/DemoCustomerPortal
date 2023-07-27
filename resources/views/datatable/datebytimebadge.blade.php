@if($value == null)
    <span class="bg-indigo-100 text-indigo-800 text-xs font-bold inline-flex items-center px-2.5 py-0.5 rounded dark:bg-indigo-200 dark:text-indigo-800">No Data Available</span>
@elseif(\Carbon\Carbon::parse($value) >= now())
    <span class="bg-green-100 text-green-800 text-xs font-bold inline-flex items-center px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-800">
      <svg aria-hidden="true" class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
      {{ \Carbon\Carbon::parse($value)->format('D d M y H:i') }}
    </span>
@elseif(\Carbon\Carbon::parse($value) < now())
    <span class="bg-blue-100 text-blue-800 text-xs font-bold inline-flex items-center px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
      <svg aria-hidden="true" class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
      {{ \Carbon\Carbon::parse($value)->format('D d M y H:i') }}
    </span>
@endif
