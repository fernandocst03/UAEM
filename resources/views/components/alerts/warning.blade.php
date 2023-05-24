@props(['text'])

<p class="flex items-center gap-2 px-3 py-2 text-xs text-red-900 bg-red-200 border-l-4 border-red-700 rounded-sm notification"
  x-data="{ show: true }" x-show="show">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
    class="w-5 h-5">
    <path stroke-linecap="round" stroke-linejoin="round"
      d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  {{ $text }}
</p>

<style>
  .notification {
    transform: translateX(-50px);
    opacity: 0;
    visibility: hidden;
    animation: fade 5s linear forwards;
  }

  @keyframes fade {
    5% {
      opacity: 1;
      visibility: visible;
      transform: translateX(0);
    }

    90% {
      opacity: 1;
      transform: translateX(0);
    }
  }
</style>
