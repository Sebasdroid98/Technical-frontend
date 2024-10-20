@empty(!$errores)
    <article class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="alert alert-danger" role="alert">
            <p>Se encontraron los siguientes errores:</p>
            <ul>
                @forelse ($errores as $error)
                    <li>{{$error}}</li>
                @empty
                    
                @endforelse
            </ul>
        </div>
    </article>
@endempty