@props(['name', 'nameHombres', 'nameMujeres'])

<div class="flex flex-col gap-1 mt-3">
  <x-input-label for="directivos" :value="$name" />
  <div class="flex flex-col flex-wrap w-full gap-3 md:flex-row md:items-center">
    <div class="flex flex-col gap-1">
      <x-input-label for="{{ $nameHombres }}" value="{{ __('Hombres') }}" class="text-secondary" />
      <x-text-input id="{{ $nameHombres }}" name="{{ $nameHombres }}" type="text" placeholder="{{ __('0') }}"
        min='0' onchange="countStaff({{ $nameHombres }}, {{ $nameMujeres }}, 'total{{ $name }}')"
        class="w-2/3 md:w-full" />
      <x-input-error class="mt-1" :messages="$errors->get($nameHombres)" />
    </div>

    <div class="flex flex-col gap-1">
      <x-input-label for="{{ $nameMujeres }}" value="{{ __('Mujeres') }}" class="text-secondary" />
      <x-text-input id="{{ $nameMujeres }}" name="{{ $nameMujeres }}" type="text"
        placeholder="{{ __('0') }}" min="0"
        onchange="countStaff({{ $nameHombres }}, {{ $nameMujeres }}, 'total{{ $name }}')"
        class="w-2/3 md:w-full" />
      <x-input-error class="mt-1" :messages="$errors->get($nameMujeres)" />
    </div>

    <div>
      <p class="mt-1 text-sm font-bold text-gray-400 w-fit md:mt-4">Total: <span id="total{{ $name }}">0</span>
      </p>
    </div>
  </div>
</div>

<script src="{{ asset('js/countStaff.js') }}"></script>
