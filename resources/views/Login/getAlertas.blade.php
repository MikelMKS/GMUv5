<?php 
    $cantidadAlertas = DB::connection('mysql')->select("SELECT COUNT(id) AS dato FROM alertas WHERE idUsuario = ".Session::get('Sid')." AND visto = 0");
    $alertasNav = DB::connection('mysql')->select("SELECT *,REPLACE(texto,'pesosdata',dato) AS escrito
    FROM alertas AS a
    LEFT JOIN(SELECT id AS idt,nombre AS tipo,icono,texto FROM tipoalertas) AS t ON a.idTipo = t.idt
    WHERE idUsuario = ".Session::get('Sid')."
    ");
?>

<li class="nav-item dropdown">

    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
      <i class="bi bi-bell"></i>
      @if($cantidadAlertas[0]->dato > 0)
        <span class="badge bg-primary badge-number">{{$cantidadAlertas[0]->dato}}</span>
      @endif
    </a><!-- End Notification Icon -->

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
      <li class="dropdown-header">
        Todas las notificaciones diarias apareceran aqui
        {{-- <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a> --}}
      </li>
    <div style="max-height: 500px;overflow-y: scroll;">
    @foreach($alertasNav as $a)
        <li>
            <hr class="dropdown-divider">
        </li>
        <li class="notification-item" style="cursor:pointer;" onclick="verNotificacion('{{$a->idTipo}}')">
            <i class="{{$a->icono}}"></i>
            <div>
            <h4>{{$a->tipo}}</h4>
            <p>{{$a->escrito}}</p>
            {{-- <p>30 min. ago</p> --}}
            </div>
        </li>
    @endforeach
    </div>
      <li>
        <hr class="dropdown-divider">
      </li>

    </ul><!-- End Notification Dropdown Items -->

  </li><!-- End Notification Nav -->