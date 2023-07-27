<template x-if="toast.type==='debug'">
    <img src="{{ URL::to('/icons/debugging.svg') }}" class="h-6 w-6">
</template>

<template x-if="toast.type==='info'">
    <img src="{{ URL::to('/icons/info.svg') }}" class="h-6 w-6">
</template>

<template x-if="toast.type==='success'">
    <img src="{{ URL::to('/icons/checked.svg') }}" class="h-6 w-6">
</template>

<template x-if="toast.type==='warning'">
    <img src="{{ URL::to('/icons/warning.svg') }}" class="h-6 w-6">
</template>

<template x-if="toast.type==='danger'">
    <img src="{{ URL::to('/icons/danger-icon.svg') }}" class="h-6 w-6">
</template>
