<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-sm btn-primary mt-2']) }}>
  {{ $slot }}
</button>
