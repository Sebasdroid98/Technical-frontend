<article class="card">
    @isset($header)
        <section class="card-header">
            {{ $header }}
        </section>
    @endisset
    <section class="card-body" id="{{ $idBody ?? '' }}">
        {{ $slot }}
    </section>
    @isset($footer)
        <section class="card-footer">
            {{ $footer }}
        </section>
    @endisset
</article>