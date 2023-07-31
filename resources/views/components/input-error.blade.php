@props(['messages'])

@if ($messages)
  <ul style="list-style: none" {{ $attributes->merge(['class' => 'text-danger']) }}>
    @foreach ((array) $messages as $message)
      <li>{{ $message }}</li>
    @endforeach
  </ul>
@endif
