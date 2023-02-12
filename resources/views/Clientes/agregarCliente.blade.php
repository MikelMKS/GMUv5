<form class="form" id="guardarCliente" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <!---------------------->
    <div class="modal-header">
        <h4 class="modal-title col-12 text-center titulomodal">Crear Cliente</h5>
    </div>
    {{--  --}}
    <div class="modal-body">
        <div class="bodymodal">
            <label>NOMBRE:</label>
            <input type="text" class="form-control inputtext" id="nombre" name="nombre" placeholder="NOMBRE" maxlength="200" autocomplete="off">

            <label>APELLIDO PATERNO:</label>
            <input type="text" class="form-control inputtext" id="apellidoPat" name="apellidoPat" placeholder="APELLIDO PAT" maxlength="200" autocomplete="off">

            <label>APELLIDO MATERNO:</label>
            <input type="text" class="form-control inputtext" id="apellidoMat" name="apellidoMat" placeholder="APELLIDO MAT" maxlength="200" autocomplete="off">
            
            <label>TELEFONO:</label>
            <input type="text" class="form-control inputtext" id="telefono" name="telefono" placeholder="TELEFONO" maxlength="15" autocomplete="off">
            
            <label>FECHA NACIMIENTO:</label>
            <input type="date" class="form-control inputtext" id="nacimiento" name="nacimiento" placeholder="NACIMIENTO" autocomplete="off">

            <label>FOTO:</label>    
            <form id="form1" runat="server">
                <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                <br>
                <div class="text-center">
                    <img id="blah" src="img/usuario-vacio.png" style="max-width:60%;max-height:60%;"/>
                </div>
            </form>
        </div>
    </div>
    <!---------------------->
</form>
<div class="modal-footer">
    <button type="button" class="btn btn-success btn-sm" onclick="$('#guardarCliente').submit();">GUARDAR</button>
    <button type="button" class="btn btn-secondary btn-sm" onclick="$('#modalagregarCliente').modal('hide');">CERRAR</button>
</div>

<script>
$("#guardarCliente").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'guardarCliente',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
            swalLoading();
        },
        success: function(response){
            if(response.sta == 0){
                swalTimer('success','ACTUALIZANDO','');
                window.location.reload(); 
            }else{
                swalTimer('warning',response.msg,2000);
            }
        },
        error: function (error){
            swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
        }
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#foto").change(function(){
    readURL(this);
});
</script>