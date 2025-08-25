@props([
  'variant' => 'outline',
])

@php
  $classes = Flux::classes('shrink-0')->add(match($variant) {
    'outline', 'solid' => '[:where(&)]:size-6',
    'mini' => '[:where(&)]:size-5',
    'micro' => '[:where(&)]:size-4',
  });
  
  $strokeWidth = match ($variant) {
        'outline' => 2,
        'mini' => 2.25,
        'micro' => 2.5,
  };
@endphp

<svg
  {{ $attributes->class($classes) }}
  xmlns="http://www.w3.org/2000/svg"
  viewBox="0 0 26 25"
  fill="none"
  width="26"
  height="25"
  stroke="currentColor"
  stroke-width="{{ $strokeWidth }}"
  stroke-linecap="round" 
  stroke-linejoin="round"
>
  <path
    d="M2.16663 8.85416C2.16663 5.20833 4.33329 3.64583 7.58329 3.64583H18.4166C21.6666 3.64583 23.8333 5.20833 23.8333 8.85416V16.1458C23.8333 19.7917 21.6666 21.3542 18.4166 21.3542H7.58329"
    stroke-miterlimit="10"
  />
  <path
    d="M18.4167 9.375L15.0259 11.9792C13.91 12.8333 12.0792 12.8333 10.9634 11.9792L7.58337 9.375"
    stroke-miterlimit="10"
  />
  <path
    d="M2.16663 17.1875H8.66663"
    stroke-miterlimit="10"
  />
  <path
    d="M2.16663 13.0208H5.41663"
    stroke-miterlimit="10"
  />
</svg>
