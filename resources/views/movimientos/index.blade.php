@extends('adminlte::page')

@section('title', 'MarketSoft - Caja')

@section('content_header')
    <h1>Movimiento de Caja</h1>
@stop
  
@section('content')
    <div class='card card-outline card-success'>

        <div class='card-header'>
            <h1 class='card-title'>Insertar Movimiento de Caja</h1>
        </div>

        

        <!-- FORMULARIO INGRESAR DATOS -->
        <form action="{{route("movimientos.store")}}" method="POST">
          @csrf
            <div class="card-body">
                <div class="row">
                    <!-- SELECT DE TIPO MOVIMIENTO -->
                    <div class="col-sm-2">
                        <!-- select -->
                        <div class="form-group">
                            <label>Tipo de Movimiento</label>
                            <select class="form-control" name="tipo_movimiento">
                                <option value=2>Egreso</option>
                                <option value=1>Ingreso</option>
                            </select>
                        </div>
                    </div>

                    <!-- DESCRIPCION DE MOVIMIENTO -->
                    <div class="col-sm-6">
                        <label>Descripción</label>
                        <input type="text" autocomplete="off" name="descripcion" class="form-control" placeholder="Ingrese descripción de Movimiento" required>

                    </div>

                    <!-- REFERENCIA DE MOVIMIENTO -->
                    <div class="col-sm-4">
                        <label>Referencia</label>
                        <input type="text" autocomplete="off" name="referencia" class="form-control" placeholder="Ingrese referencia de Movimiento">
                    </div>
                </div>

                <!-- FILA SGTE -->
                <div class='row'>
                    <!-- MONTO DE MOVIMIENTO -->
                    <div class='col-sm-3'>
                        <label>Importe</label>
                        <div class="input-group mb-3">

                            <input type="text" autocomplete="off" name="importe" class="form-control" placeholder="Ingrese importe de Movimiento" required>
                            <div class="input-group-append">
                                <span class="input-group-text">Gs</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn bg-gradient-success">Guardar</button>
                </div>
                <!-- /.card-body -->
            </div>

        </form>

    </div>


    <div class="card">

        <!-- Tabla de Movimientos Registrados -->
        
        <div class="card-body">
            <table class="table table-striped" id="tablamovimientos">
                <thead>
                  <tr>
                    <th scope="col">Tipo</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Referencia</th>
                    <th scope="col">Importe</th>
                    <th scope="col">Estado</th>
                  </tr>
                </thead>

                <tbody>
                    @foreach ($movimientos as $movimiento)
                    <tr>
                        <td>{{$movimiento->tipo_movimiento}}</td>
                        <td>{{$movimiento->descripcion}}</td>
                        <td>{{$movimiento->referencia}}</td>
                        <td>{{$movimiento->importe}}</td>
                        <td>{{$movimiento->estado}}</td>
                    </tr>
                    @endforeach
                    </tbody>        
              </table>
        </div>
    </div>
        
         
    
@endsection


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

    <script>
        
        $('#tablamovimientos').DataTable({
            responsive: true,
            autoWidth: false,


            "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No existen registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search" : "Buscar:",
            "paginate" : {
                "next" : "Siguiente",
                "previous" : "Anterior"
            }
        }

        });
    </script>
@endsection
