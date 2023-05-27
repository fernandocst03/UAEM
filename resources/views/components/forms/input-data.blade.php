@props(['name', 'nameHombres', 'nameMujeres'])

<div class="flex flex-col gap-1 mt-3">
  <x-input-label for="directivos" :value="$name" />
  <div class="flex items-center w-full gap-3">
    <div class="flex flex-col gap-1">
      <x-input-label for="{{ $nameHombres }}" value="{{ __('Hombres') }}" class="text-secondary" />
      <x-text-input id="{{ $nameHombres }}" name="{{ $nameHombres }}" type="text" placeholder="{{ __('0') }}"
        {{-- pattern="^[0-9]+"  --}}min='0'
        onchange="countStaff({{ $nameHombres }}, {{ $nameMujeres }}, 'total{{ $name }}')" />
      <x-input-error class="mt-1" :messages="$errors->get($nameHombres)" />
    </div>

    <div class="flex flex-col gap-1">
      <x-input-label for="{{ $nameMujeres }}" value="{{ __('Mujeres') }}" class="text-secondary" />
      <x-text-input id="{{ $nameMujeres }}" name="{{ $nameMujeres }}" type="text"
        placeholder="{{ __('0') }}" {{-- pattern="^[0-9]+"  --}}min="0"
        onchange="countStaff({{ $nameHombres }}, {{ $nameMujeres }}, 'total{{ $name }}')" />
      <x-input-error class="mt-1" :messages="$errors->get($nameMujeres)" />
    </div>

    <div>
      <p class="mt-4 text-sm font-bold text-gray-400">Total: <span id="total{{ $name }}">0</span> </p>
    </div>
  </div>
</div>

<script src="{{ asset('js/countStaff.js') }}"></script>
