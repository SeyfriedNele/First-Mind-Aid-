@props([
    // maximale Breite des Inhaltscontainers (Tailwind max-w-* Klassen)
    'maxWidth' => 'max-w-7xl',

    // horizontales Padding (responsiv)
    'xPadding' => 'sm:px-6 lg:px-8',

    // vertikales Außenpadding
    'yPadding' => 'py-12',

    // Innenabstand der Karte
    'cardPadding' => 'p-6',

    // Karten-Variante: 'solid' (Standard) | 'plain' (nur Text) | 'glass' (Transparenz)
    'variant' => 'solid',

    // Extra-Klassen zum Überschreiben/Erweitern
    'containerClass' => '',
    'cardClass' => '',
    'textClass' => 'text-gray-900 dark:text-gray-100',
])

@php
    // Container (äußerer Bereich)
    $containerClasses = trim("$yPadding");
    $innerWrapClasses = trim("$maxWidth mx-auto $xPadding");

    // Karte (mittlerer Bereich)
    $cardBase = 'overflow-hidden shadow-sm sm:rounded-lg';
    $cardVariant = match ($variant) {
        'plain' => '',
        'glass' => 'bg-white/70 dark:bg-gray-800/60 backdrop-blur',
        default => 'bg-white dark:bg-gray-800',
    };
    $cardClasses = trim("$cardVariant $cardBase $cardClass");

    // Inhalt (innerstes Padding + Textfarbe)
    $contentClasses = trim("$cardPadding $textClass");
@endphp

<div {{ $attributes->merge(['class' => $containerClasses]) }}>
    <div class="{{ $innerWrapClasses }} {{ $containerClass }}">
        @if (isset($header))
            <div class="mb-4 text-white text-2xl font-bold">
                {{ $header }}
            </div>
        @endif

        @if ($variant === 'plain')
            {{-- Plain: ohne Kartenhintergrund, direkt Inhalt --}}
            <div class="{{ $contentClasses }}">
                {{ $slot }}
            </div>
        @else
            {{-- Solid/Glass: mit Kartenhintergrund --}}
            <div class="{{ $cardClasses }}">
                <div class="{{ $contentClasses }}">
                    {{ $slot }}
                </div>

                @if (isset($footer))
                    <div class="border-t border-gray-100/60 dark:border-gray-700/60 px-6 py-4">
                        {{ $footer }}
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>