@props(['text'])

<p class="flex items-center gap-2 px-3 py-2 text-xs text-red-900 bg-red-200 border-l-4 border-red-700 rounded-sm notification"
  x-data="{ show: true }" x-show="show">
  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle-filled" width="24"
    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
    stroke-linejoin="round">
    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
    <path
      d="M11.94 2a2.99 2.99 0 0 1 2.45 1.279l.108 .164l8.431 14.074a2.989 2.989 0 0 1 -2.366 4.474l-.2 .009h-16.856a2.99 2.99 0 0 1 -2.648 -4.308l.101 -.189l8.425 -14.065a2.989 2.989 0 0 1 2.555 -1.438zm.07 14l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -8a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z"
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
