@props([
  'variant' => 'outline',
])

@php
  $classes = Flux::classes('shrink-0')->add(match($variant) {
    'outline', 'solid' => '[:where(&)]:size-6',
    'mini' => '[:where(&)]:size-5',
    'micro' => '[:where(&)]:size-4',
    default => '',
  });
@endphp

<svg {{ $attributes->merge(['class' => $classes]) }} 
  width="26" 
  height="25" 
  viewBox="0 0 26 25" 
  fill="none" 
  xmlns="http://www.w3.org/2000/svg"
  >
  <path d="M13 18.75V15.625" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M10.909 2.9375L3.40155 8.71875C2.55655 9.36458 2.01488 10.7292 2.19905 11.75L3.63988 20.0417C3.89988 21.5208 5.37321 22.7187 6.93321 22.7187H19.0665C20.6157 22.7187 22.0999 21.5104 22.3599 20.0417L23.8007 11.75C23.974 10.7292 23.4324 9.36458 22.5982 8.71875L15.0907 2.94792C13.9315 2.05208 12.0574 2.05208 10.909 2.9375Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>