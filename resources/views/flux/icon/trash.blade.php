@props([
  'variant' => 'outline',
])

@php
  $classes = Flux::classes('shrink-0')->add(match($variant) {
    'outline', 'solid' => '[:where(&)]:size-6',
    'mini' => '[:where(&)]:size-5',
    'micro' => '[:where(&)]:size-4',
  });
@endphp
 
<svg
  {{ $attributes->class($classes) }}
  width="24"
  height="24"
  viewBox="0 0 24 24"
  fill="none"
  xmlns="http://www.w3.org/2000/svg"
>
  <path
    d="M1.71429 21.3333C1.71429 22.8 3.25714 24 5.14286 24H18.8571C20.7429 24 22.2857 22.8 22.2857 21.3333V5.33333H1.71429V21.3333ZM24 1.33333H18L16.2857 0H7.71429L6 1.33333H0V4H24V1.33333Z"
    fill="#FF0000"
  />
</svg>
