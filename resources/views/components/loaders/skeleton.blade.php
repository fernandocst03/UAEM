<div class="" x-init="setTimeout(() => show = false, 3000)" x-data="{ show: true }" x-show="show" x-transition>
  <div class="skeleton skeleton-content "></div>
</div>

<style>
  .skeleton {
    animation: skeleton-loading 1s linear infinite alternate;
  }

  .skeleton-content {
    width: 100%;
    height: 100%;
    border-radius: 8px;
    position: absolute;
    z-index: 10;
    top: 0;
    left: 0;
  }

  @keyframes skeleton-loading {
    0% {
      background-color: hsl(200, 20%, 80%);
    }

    100% {
      background-color: hsl(200, 20%, 95%);
    }
  }
</style>
