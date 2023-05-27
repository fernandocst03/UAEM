@props(['messages'])

@if ($messages)
  <ul {{ $attributes->merge(['class' => 'text-sm text-red-600']) }}>
    @foreach ((array) $messages as $message)
      <li class="ml-3 list-disc">{{ $message }}</li>
    @endforeach
  </ul>
@endif
