@extends('Login.main')

@section('contenido')
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<h5 class="card-title">
    <button type="button" class="btn btn-success" onclick="agregarAdministrativo();">Agregar</button>
</h5>
<p></p>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<section class="section profile">
<div class="row">

    @foreach($administrativos as $a)
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                {{--  --}}
                @if(existeArchivo('assets/administrativos', $a->id . '.png'))
                    <img src="assets/administrativos/{{$a->id}}.png" alt="Profile" class="rounded-circle">
                @else
                    <img src="img/usuario-vacio.png" alt="Profile" class="rounded-circle">
                @endif
                <h2>{{$a->user}}</h2>
                <h3>{{$a->nombre}}</h3>
                <div class="social-links mt-2">
                    <a><i class="bi bi-person"></i></a>
                </div>
                {{--  --}}
            </div>
        </div>
    </div>
    @endforeach

</div>
</section>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
{{--  --}}
<div class="modal fade" id="modalagregarAdministrativo" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="modalBodyagregarAdministrativo">
            {{--  --}}
                <div class="modal-header">
                    <h5 class="modal-title">Crear Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            {{--  --}}
        </div>
    </div>
</div>
{{--  --}}
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<script type="text/javascript">
// ///////////////////////////////////////////////////////////////////////
function agregarAdministrativo(){
}
// ///////////////////////////////////////////////////////////////////////
</script>
@endsection