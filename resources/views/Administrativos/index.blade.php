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
                    <a><i class="editar ri-edit-box-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="EDITAR"></i></a>
                    @if($a->idTipo != 1)
                        @if($a->estatus == 1)
                            <a><i class="desactivar ri-door-lock-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="DESACTIVAR" onclick="accionesAdministrativo('{{$a->id}}',0)"></i></a>
                        @else
                            <a><i class="activar ri-door-lock-line" data-bs-toggle="tooltip" data-bs-placement="top" title="ACTIVAR" onclick="accionesAdministrativo('{{$a->id}}',1)"></i></a>
                            <a><i class="eliminar ri-delete-bin-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="ELIMINAR" onclick="accionesAdministrativo('{{$a->id}}',2)"></i></a>
                        @endif
                    @endif
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
<div class="modal fade" id="modalagregarAdministrativo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 50px;max-width: 100%;">
    <div class="modal-dialog modal-md" role="document" style="height: 200px; width: 1500px;">
        <div class="modal-content" id="modalBodyagregarAdministrativo">
            {{--  --}}
            <div id="modalagregarAdministrativoBody">

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
    $.ajax({
        data: { _token: "{{ csrf_token() }}" },
        type : "GET",
        url : "{{route('agregarAdministrativo')}}",
        beforeSend : function () {
            $("#modalagregarAdministrativoBody").html('{{Html::image('img/loading.gif', 'CARGANDO ESPERE', ['class' => 'center-block'])}}');
        },
        success:  function (response) {
            $('#modalagregarAdministrativo').modal({backdrop: 'static',keyboard: false});
            $('#modalagregarAdministrativo').modal('show');
            $("#modalagregarAdministrativoBody").html(response);
        },
        error: function(error) {
            swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
        }
    });
}

function accionesAdministrativo(id,t){
    var msg = null;
    if(t == 0){
        msg = "¿ESTAS SEGURO QUE QUIERES DESACTIVAR EL USUARIO?";
    }else if(t == 1){
        msg = "¿ESTAS SEGURO QUE QUIERES ACTIVAR EL USUARIO?";
    }else if(t == 2){
        msg = "¿ESTAS SEGURO QUE QUIERES ELIMINAR EL USUARIO?";
    }

    swalConfirm(msg).then((value) => {
    if(value == true){
        $.ajax({
            data: { 'id':id,'t':t,_token: "{{ csrf_token() }}" },
            type : "POST",
            url : "{{route('accionesAdministrativo')}}",
            beforeSend : function () {
                swalLoading();
            },
            success:  function (response) {
                swalTimer('success','ACTUALIZANDO','');
                window.location.reload(); 
            },
            error: function(error) {
                swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
            }
        });
    }
    });
}
// ///////////////////////////////////////////////////////////////////////
</script>
@endsection