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
  width="28" 
  height="28" 
  viewBox="0 0 28 28" 
  fill="none" 
  xmlns="http://www.w3.org/2000/svg"
  >
  <path 
    d="M10.4999 25.6667H17.4999C23.3333 25.6667 25.6666 23.3333 25.6666 17.5V10.5C25.6666 4.66668 23.3333 2.33334 17.4999 
      2.33334H10.4999C4.66659 2.33334 2.33325 4.66668 2.33325 10.5V17.5C2.33325 23.3333 4.66659 25.6667 10.4999 25.6667Z" 
    fill="#FF9D00"/>
  <path 
    d="M10.5 13.4283L14 16.9283L17.5 13.4283" 
    stroke="white" 
    stroke-width="1.5" 
    stroke-linecap="round" 
    stroke-linejoin="round"/>
  <path 
    d="M14 16.9283V7.595" 
    stroke="white" 
    stroke-width="1.5" 
    stroke-linecap="round" 
    stroke-linejoin="round"/>
  <path 
    d="M7 19.2617C11.5383 20.7783 16.4617 20.7783 21 19.2617" 
    stroke="white" 
    stroke-width="1.5" 
    stroke-linecap="round" 
    stroke-linejoin="round"/>
</svg>
