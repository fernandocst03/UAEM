@props(['text'])

<p class="flex items-center gap-3 px-3 py-2 text-xs text-green-900 bg-green-200 rounded" x-data="{ show: true }"
  x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
    class="w-5 h-5">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  {{ $text }}
</p>
