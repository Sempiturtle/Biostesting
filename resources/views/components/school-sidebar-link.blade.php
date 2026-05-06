@props(['active'])

@php
$classes = ($active ?? false)
            ? 'sidebar-link active bg-slate-800 text-white font-semibold'
            : 'sidebar-link text-slate-400 hover:text-white hover:bg-slate-800';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
