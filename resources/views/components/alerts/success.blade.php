@props(['text'])

<p class="flex items-center gap-2 px-3 py-2 text-green-900 transition delay-300 bg-green-200 border-l-4 border-green-700 rounded-sm text-md notification"
  x-data="{ show: true }" x-show="show">
  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check-filled" width="24"
    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
    stroke-linejoin="round">
    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
    <path
      d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z"
      stroke-width="0" fill="currentColor"></path>
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
