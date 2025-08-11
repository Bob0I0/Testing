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
  width="7"
  height="7"
  viewBox="0 0 7 7"
  fill="none"
  xmlns="http://www.w3.org/2000/svg"
  style="color: var(--icon-color);"
>
  <circle
    cx="3.5"
    cy="3.5"
    r="2"
    fill="currentColor"
  />
</svg>
