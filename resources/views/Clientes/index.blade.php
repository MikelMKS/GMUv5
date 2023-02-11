@extends('Login.main')

@section('contenido')
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<h5 class="card-title">
    <button type="button" class="btn btn-success" onclick="agregarCliente();">Agregar</button>
    <span class="colvisBut"></span>
</h5>
<p></p>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<section class="section profile">
<div class="row">
    <table id="Dtable" class="styled-table" style="width:100%">
        <thead>
            <tr>
                <th class="col" style="width: 2% !important;">ID</th>
                <th class="col" style="width: 50% !important;">NOMBRE</th>
                <th class="col" style="width: 10% !important;">TELEFONO</th>
                <th class="col" style="width: 8% !important;">FEC NAC</th>
                <th class="col" style="width: 12% !important;">REGISTRO</th>
                <th class="col" style="width: 8% !important;">FEC REG</th>
                <th class="col" style="width: 10% !important;">PENDIENTE</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $t)
                <tr>
                    <td>{{$t->id}}</td>
                    <td class="lefti">{{$t->nombre}} {{$t->apellidoP}} {{$t->apellidoM}}</td>
                    <td>{{$t->telefono}}</td>
                    <td>{{$t->fechaNac}}</td>
                    <td>{{$t->registro}}</td>
                    <td>{{$t->fechaRegistro}}</td>
                    <td>{{$t->deuda}}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="filtercol"><input type="text" class="thfilter" idc="0" id="i0"></td>
                <td class="filtercol"><input type="text" class="thfilter" idc="1" id="i1"></td>
                <td class="filtercol"><input type="text" class="thfilter" idc="2" id="i2"></td>
                <td class="filtercol"><input type="text" class="thfilter" idc="3" id="i3"></td>
                <td class="filtercol"><input type="text" class="thfilter" idc="4" id="i4"></td>
                <td class="filtercol"><input type="text" class="thfilter" idc="5" id="i5"></td>
                <td class="filtercol"><input type="text" class="thfilter" idc="6" id="i6"></td>
            </tr> 
        </tfoot>
    </table>
</div>
</section>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
{{--  --}}
<div class="modal fade" id="modalagregarCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            {{--  --}}
            <div id="modalagregarClienteBody">

            </div>
            {{--  --}}
        </div>
    </div>
</div>
{{--  --}}
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<script type="text/javascript">
// ///////////////////////////////////////////////////////////////////////
var c_CID = 0;
var c_NOM = 1;
var c_TEL = 2;
var c_NAC = 3;
var c_REG = 4;
var c_FRE = 5;
var c_DEU = 6;
// ///////////////////////////////////////////////////////////////////////
Dtable();
function Dtable(){
var Dtable = $('#Dtable').DataTable({
    "sDom": "tp",
    scrollY: "500px",
    scrollX: true,
    paging: false,
    "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "# REG _MENU_ ",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "_START_ - _END_",
        "sInfoEmpty": "",
        "sInfoFiltered": "",
        "sInfoPostFix": "",
        "sSearch": "<i class='fa fa-search'></i>",
        "sUrl": "",
        "sInfoThousands": ","
    },
    columnDefs: [
        { "targets": c_CID }
    ],
    buttons: [{
        text: 'COLUMNAS',
        extend: 'colvis',
    }],
})

Dtable.columns([c_REG,c_DEU]).visible(false);
Dtable.buttons().container().appendTo($('.colvisBut'));

contador(Dtable);

$('.thfilter').on('keyup change blur',function () {let idc = this.getAttribute("idc");Dtable.columns(idc).search( this.value ).draw();contador(Dtable);});
}

function contador(Dtable) {
    $('#c'+c_CID).html(number_format(Dtable.column(c_CID,{filter: 'applied'}).data().unique().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_NOM).html(number_format(Dtable.column(c_NOM,{filter: 'applied'}).data().unique().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_TEL).html(number_format(Dtable.column(c_TEL,{filter: 'applied'}).data().unique().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_NAC).html(number_format(Dtable.column(c_NAC,{filter: 'applied'}).data().unique().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_REG).html(number_format(Dtable.column(c_REG,{filter: 'applied'}).data().unique().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_FRE).html(number_format(Dtable.column(c_FRE,{filter: 'applied'}).data().unique().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_DEU).html(number_format(Dtable.column(c_DEU,{filter: 'applied'}).data().unique().filter(function(value, index){return value != "" ? true : false;}).count()));
}
// ///////////////////////////////////////////////////////////////////////
function agregarCliente(){
    $.ajax({
        data: { _token: "{{ csrf_token() }}" },
        type : "GET",
        url : "{{route('agregarCliente')}}",
        beforeSend : function () {
            $("#modalagregarClienteBody").html('{{Html::image('img/loading.gif', 'CARGANDO ESPERE', ['class' => 'center-block'])}}');
        },
        success:  function (response) {
            $('#modalagregarCliente').modal({backdrop: 'static',keyboard: false});
            $('#modalagregarCliente').modal('show');
            $("#modalagregarClienteBody").html(response);
        },
        error: function(error) {
            swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
        }
    });
}
// ///////////////////////////////////////////////////////////////////////
</script>
@endsection