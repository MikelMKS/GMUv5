<table id="Dtable" class="styled-table" style="width:100%">
    <thead>
        <tr>
            <th class="colcont tdhbottom" style="border-right: 5px solid rgba(236, 236, 236, 0.504) !important;" colspan="3">GENERAL</th>
            <th class="colcont tdhbottom" style="border-right: 5px solid rgba(236, 236, 236, 0.504) !important;" colspan="3">GYM</th>
            <th class="colcont tdhbottom" colspan="4">SERVICIOS</th>
        </tr>
        <tr>
            <th class="colcont" id="c0"></th>
            <th class="colcont" id="c1"></th>
            <th class="colcont" style="border-right: 5px solid rgba(236, 236, 236, 0.504) !important;" id="c2"></th>
            <th class="colcont" id="c3"></th>
            <th class="colcont" id="c4"></th>
            <th class="colcont" style="border-right: 5px solid rgba(236, 236, 236, 0.504) !important;" id="c5"></th>
            <th class="colcont" id="c6"></th>
            <th class="colcont" id="c7"></th>
            <th class="colcont" id="c8"></th>
            <th class="colcont" id="c9"></th>
        </tr>
        <tr>
            <th class="col" style="width: 5% !important;">#</th>
            <th class="col" style="width: 10% !important;">FECHA</th>
            <th class="col" style="width: 20% !important;border-right: 5px solid rgba(236, 236, 236, 0.504) !important;">CLIENTE</th>
            <th class="col" style="width: 10% !important;">INICIO</th>
            <th class="col" style="width: 5% !important;">#</th>
            <th class="col" style="width: 10% !important;border-right: 5px solid rgba(236, 236, 236, 0.504) !important;">TOTAL</th>
            <th class="col" style="width: 10% !important;">SEMANAL</th>
            <th class="col" style="width: 10% !important;">VISITA</th>
            <th class="col" style="width: 10% !important;">HERBALIFE</th>
            <th class="col" style="width: 10% !important;">TOTAL G</th>
        </tr>
    </thead>
    <tbody>
        @php $numero = 1; @endphp
        @foreach($tabla as $t)
            <tr>
                <td>{{$numero}}</td>
                <td>{{$t->Fecha}}</td>
                <td class="lefti" style="border-right: 5px solid rgba(236, 236, 236, 0.504) !important;">{{$t->Cliente}}</td>
                <td>{{$t->InicioGym}}</td>
                <td>{{flotFormatoM($t->PagosGym)}}</td>
                <td style="border-right: 5px solid rgba(236, 236, 236, 0.504) !important;">{{flotFormatoM2Pesos($t->TotalGym)}}</td>
                <td>{{flotFormatoM2Pesos($t->Semanal)}}</td>
                <td>{{flotFormatoM2Pesos($t->Visita)}}</td>
                <td>{{flotFormatoM2Pesos($t->Herbalife)}}</td>
                <td>{{flotFormatoM2Pesos($t->Total)}}</td>
            </tr>
            @php $numero++; @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td class="filtercol"><input type="text" class="thfilter" idc="0" id="i0"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="1" id="i1"></td>
            <td class="filtercol" style="border-right: 5px solid rgba(236, 236, 236, 0.504) !important;"><input type="text" class="thfilter" idc="2" id="i2"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="3" id="i3"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="4" id="i4"></td>
            <td class="filtercol" style="border-right: 5px solid rgba(236, 236, 236, 0.504) !important;"><input type="text" class="thfilter" idc="5" id="i5"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="6" id="i6"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="7" id="i7"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="8" id="i8"></td>
            <td class="filtercol"><input type="text" class="thfilter" idc="9" id="i9"></td>
        </tr> 
    </tfoot>
</table>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<script type="text/javascript">
// ///////////////////////////////////////////////////////////////////////
var c_NUM = 0;
var c_FEC = 1;
var c_CLI = 2;
var c_INI = 3;
var c_PAG = 4;
var c_TOG = 5;
var c_SEM = 6;
var c_VIS = 7;
var c_HER = 8;
var c_TOT = 9;
// ///////////////////////////////////////////////////////////////////////
Dtable();
function Dtable(){
    var Dtable = $('#Dtable').DataTable({
        "sDom": "tp",
        scrollY: "500px",
        scrollX: true,
        order: [[c_NUM,'asc']],
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
        buttons: [{
            text: 'COLUMNAS',
            extend: 'colvis',
        }],
    })
    Dtable.buttons().container().appendTo($('.colvisBut'));

    contador(Dtable);

    $('.thfilter').on('keyup change blur',function () {let idc = this.getAttribute("idc");Dtable.columns(idc).search( this.value ).draw();contador(Dtable);});
}

function contador(Dtable) {
    $('#c'+c_NUM).html(number_format(Dtable.column(c_NUM,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_FEC).html(number_format(Dtable.column(c_FEC,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_CLI).html(number_format(Dtable.column(c_CLI,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_INI).html(number_format(Dtable.column(c_INI,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count()));
    $('#c'+c_PAG).html(
                        number_format(Dtable.column(c_PAG,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).sum())+' '+
                        '('+number_format(Dtable.column(c_PAG,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count())+')'
    );
    $('#c'+c_TOG).html(
                        '$'+number_format(Dtable.column(c_TOG,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).sum(),2)+' '+
                        '('+number_format(Dtable.column(c_TOG,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count())+')'    
    );
    $('#c'+c_SEM).html(
                        '$'+number_format(Dtable.column(c_SEM,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).sum(),2)+' '+
                        '('+number_format(Dtable.column(c_SEM,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count())+')'    
    );
    $('#c'+c_VIS).html(
                        '$'+number_format(Dtable.column(c_VIS,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).sum(),2)+' '+
                        '('+number_format(Dtable.column(c_VIS,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count())+')'    
    );
    $('#c'+c_HER).html(
                        '$'+number_format(Dtable.column(c_HER,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).sum(),2)+' '+
                        '('+number_format(Dtable.column(c_HER,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count())+')'    
    );
    $('#c'+c_TOT).html(
                        '$'+number_format(Dtable.column(c_TOT,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).sum(),2)+' '+
                        '('+number_format(Dtable.column(c_TOT,{filter: 'applied'}).data().filter(function(value, index){return value != "" ? true : false;}).count())+')'    
    );
}
// ///////////////////////////////////////////////////////////////////////
</script>