<nav x-data="{ open: false }" class="py-4 bg-white border-b border-gray-100 sm:py-0">
  <!-- Primary Navigation Menu -->
  <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <div class="flex items-center">
        <!-- Logo -->
        <div class="flex items-center shrink-0">
          <a href="{{ route('welcome') }}">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b4/Logo_de_la_UAEM.svg" alt="Logo UAEM"
              width="100" height="auto">
          </a>
        </div>

        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
          <x-nav-link :href="route('welcome')">
            {{ __('Inicio') }}
          </x-nav-link>
        </div>

        <!-- Acuerdos CU -->
        <div class="hidden sm:ml-6 sm:flex">
          <x-dropdown align="right" widith="48">

            <x-slot name="trigger">
              <button
                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white hover:text-gray-700 focus:outline-none">
                {{ __('Acuerdos CU') }}
                <div class="ml-1">
                  <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd" />
                  </svg>
                </div>
              </button>
            </x-slot>
            <x-slot name="content">
              <x-dropdown-link :href="route('acuerdos-cu')">
                {{ __('Presentación') }}
              </x-dropdown-link>
              <x-dropdown-link :href="route('samaras.index')">
                {{ __('Samaras') }}
              </x-dropdown-link>
              <x-dropdown-link :href="route('sesiones.index')">
                {{ __('Sesiones') }}
              </x-dropdown-link>
              @if (Auth::check() && Auth::user()->role->role == 'Administrador')
                <x-dropdown-link :href="route('acuerdos.index')">
                  {{ __('Acuerdos') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('rectorados.index')">
                  {{ __('Rectorados') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('reporte.acuerdos')">
                  {{ __('Reporte de acuerdos') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('reporte.bitacoras')">
                  {{ __('Reporte de bitacoras') }}
                </x-dropdown-link>
              @endif
            </x-slot>
          </x-dropdown>
        </div>

        <!-- Formato 911 -->
        <div class="hidden sm:ml-4 sm:flex">
          <x-dropdown align="right" widith="48">
            <x-slot name="trigger">
              <button
                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white hover:text-gray-700 focus:outline-none">
                {{ __('Formato 911') }}
                <div class="ml-1">
                  <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd" />
                  </svg>
                </div>
              </button>
            </x-slot>
            <x-slot name="content">
              <x-dropdown-link :href="route('formato-911')">
                {{ __('Presentación') }}
              </x-dropdown-link>
              @if (Auth::check() && Auth::user()->role->role == 'Administrador')
                <x-dropdown-link :href="route('personal-administrativo.index')">
                  {{ __('Personal Administrativo') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('personal-docente.index')">
                  {{ __('Personal Docente') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('personal-docente-antiguedad.index')">
                  {{ __('Grupos de antiguedad del personal docente') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('personal-docente-edad.index')">
                  {{ __('Grupos de edad del personal docente') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('infraestructuras.index')">
                  {{ __('Infraestructuras') }}
                </x-dropdown-link>
              @endif
              <x-dropdown-link :href="route('unidades-academicas.index')">
                {{ __('Unidades academicas') }}
              </x-dropdown-link>
            </x-slot>
          </x-dropdown>
        </div>

      </div>

      <!-- Settings Dropdown -->
      <div class="hidden sm:ml-6 sm:flex sm:items-center">
        @if (Auth::check())
          <x-dropdown align="right" width="48">
            <x-slot name="trigger">
              <button
                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white hover:text-gray-700 focus:outline-none">
                <div>{{ Auth::user()->name }}</div>

                <div class="ml-1">
                  <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd" />
                  </svg>
                </div>
              </button>
            </x-slot>

            <x-slot name="content">
              <x-dropdown-link :href="route('profile.edit')">
                {{ __('Profile') }}
              </x-dropdown-link>

              <!-- Authentication -->
              <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                  onclick="event.preventDefault();
												this.closest('form').submit();">
                  {{ __('Log Out') }}
                </x-dropdown-link>
              </form>
            </x-slot>
          </x-dropdown>
        @else
          <div class='flex items-center gap-3'>
            <x-nav-link :href="route('login')">Iniciar sesión</x-nav-link>
            <x-nav-link :href="route('register')">Registrarse</x-nav-link>
          </div>
        @endif
      </div>

      <!-- Hamburger -->
      <div class="flex items-center -mr-2 sm:hidden">
        <button @click="open = ! open"
          class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none">
          <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Responsive Navigation Menu -->
  <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
        {{ __('Inicio') }}
      </x-responsive-nav-link>
      <div>
        <p class="py-1 pl-4 pr-4 text-base font-medium text-gray-600 text-lef">
          Acuerdos CU</p>
        <div class="ml-3">
          <x-responsive-nav-link :href="route('acuerdos-cu')" class="text-sm" :active="request()->routeIs('acuerdos-cu')">
            {{ __('Presentación') }}
          </x-responsive-nav-link>
          <x-responsive-nav-link :href="route('samaras.index')" class="text-sm" :active="request()->routeIs('samaras.index')">
            {{ __('Samaras') }}
          </x-responsive-nav-link>
          <x-responsive-nav-link :href="route('sesiones.index')" class="text-sm" :active="request()->routeIs('sesiones.index')">
            {{ __('Sesiones') }}
          </x-responsive-nav-link>
          @if (Auth::check() && Auth::user()->role->role == 'Administrador')
            <x-responsive-nav-link :href="route('acuerdos.index')" class="text-sm" :active="request()->routeIs('acuerdos.index')">
              {{ __('Acuerdos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('rectorados.index')" class="text-sm" :active="request()->routeIs('rectorados.index')">
              {{ __('Rectorados') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('reporte.acuerdos')" class="text-sm" :active="request()->routeIs('reporte.acuerdos')">
              {{ __('Reporte de acuerdos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('reporte.bitacoras')" class="text-sm" :active="request()->routeIs('reporte.bitacoras')">
              {{ __('Reporte de bitacoras') }}
            </x-responsive-nav-link>
          @endif
        </div>
      </div>
      <div>
        <p class="py-1 pl-4 pr-4 text-base font-medium text-gray-600 text-lef">
          Formato 911</p>
        <div class="ml-3">
          <x-responsive-nav-link :href="route('formato-911')" class="text-sm" :active="request()->routeIs('formato-911')">
            {{ __('Presentación') }}
          </x-responsive-nav-link>
          @if (Auth::check() && Auth::user()->role->role == 'Administrador')
            <x-responsive-nav-link :href="route('personal-administrativo.index')" class="text-sm" :active="request()->routeIs('personal-administrativo.index')">
              {{ __('Personal Administrativo') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('personal-docente.index')" class="text-sm" :active="request()->routeIs('personal-docente.index')">
              {{ __('Personal Docente') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('personal-docente-antiguedad.index')" class="text-sm" :active="request()->routeIs('personal-docente-antiguedad.index')">
              {{ __('Grupos de antiguedad del personal docente') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('personal-docente-edad.index')" class="text-sm" :active="request()->routeIs('personal-docente-edad.index')">
              {{ __('Grupos de edad del personal docente') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('infraestructuras.index')" class="text-sm" :active="request()->routeIs('infraestructuras.index')">
              {{ __('Infraestructuras') }}
            </x-responsive-nav-link>
          @endif
          <x-responsive-nav-link :href="route('unidades-academicas.index')" class="text-sm" :active="request()->routeIs('unidades-academicas.index')">
            {{ __('Unidades academicas') }}
          </x-responsive-nav-link>
        </div>
      </div>
    </div>

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t border-gray-200">
      @if (Auth::check())
        <div class="px-4">
          <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
          <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
        </div>

        <div class="mt-3 space-y-1">
          <x-responsive-nav-link :href="route('profile.edit')">
            {{ __('Profile') }}
          </x-responsive-nav-link>

          <!-- Authentication -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-responsive-nav-link :href="route('logout')"
              onclick="event.preventDefault();
										this.closest('form').submit();">
              {{ __('Log Out') }}
            </x-responsive-nav-link>
          </form>
        </div>
      @else
        <div class='flex flex-col items-center gap-3'>
          <x-responsive-nav-link :href="route('login')">Iniciar sesión</x-responsive-nav-link>
          <x-responsive-nav-link :href="route('register')">Registrarse</x-responsive-nav-link>
        </div>
      @endif
    </div>
  </div>
</nav>
