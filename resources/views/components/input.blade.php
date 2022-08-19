@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 dark:border-gray-700 focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-gray-200']) !!}>
