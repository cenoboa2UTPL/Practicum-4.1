@extends($this->Layouts('dashboard'))

@section('title_dashboard', 'Gestión de egresos')

@section('css')
    <style>
        #tabla_egresos>thead>tr>th {
            background-color: #E6E6FA;
            color: rgb(16, 111, 228);
        }
        #detalle_egresos_index>thead>tr>th{
            background-color: #E6E6FA;
            color: rgb(16, 111, 228);   
        }

        #detalle_egresos_index_edit>thead>tr>th{
            background-color: #E6E6FA;
            color: rgb(16, 111, 228);   
        }

        td.hide_me {
            display: none;
        }
    </style>
@endsection
@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-text">
                        <h4 class="float-end">Egresos existentes</h4>
                        <a href="{{ $this->route('egreso/create') }}" class="btn btn-primary rounded">Agregar uno nuevo <i
                                class='bx bx-plus'></i></a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered responsive nowrap" id="tabla_egresos" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="d-none">ID</th>
                                    <th>Acciones</th>
                                    <th>Categoría</th>
                                    <th>Fecha</th>
                                    <th>Egresos</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_add_subcategoria_egresos_index" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="float-start">Agregar Sub Categorías</h5>
                    <button class="btn btn-danger rounded btn-sm" id="salir"><b>X</b> salir</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoria_index"><b>Nombre categoría <span class="text-danger">*</span></b></label>
                        <input type="text" class="form-control" name="categoria_index" id="categoria_index"
                            placeholder="Escriba aquí" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name_subcategoria_index"><b>Nombre egreso <span class="text-danger">*</span></b></label>
                        <input type="text" class="form-control" name="name_subcategoria_index" id="name_subcategoria_index"
                            placeholder="Escriba aquí" >
                    </div>
                    <div class="form-group">
                        <label for="gasto_subcategoria_index"><b>Gasto egreso
                                {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}
                                <span class="text-danger">*</span></b></label>
                        <input type="number" class="form-control" name="gasto_subcategoria_index" id="gasto_subcategoria_index"
                            placeholder="Escriba aquíi" min="1">
                    </div>
 
                    
                    <div class="card-text">
                        <br>
                        <div class="table-responsive">
                            <h5>Detalle sub categorías</h5>
                            <table class="table table-bordered table-striped" id="detalle_egresos_index">
                                <thead>
                                    <tr>
                                        <th>Egreso</th>
                                        <th>Gasto
                                            {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}
                                        </th>
                                        <th>Quitar</th>
                                    </tr>
                                </thead>
                                <tbody id="detalle_egresos_body_index"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success rounded" id="save_egresos_index">Guardar <i class='bx bx-save'></i></button>
                </div>
            </div>
        </div>
    </div>

    {{--- MOdal para editar e eliminar las sub categorías asignadas a un categoria de egresos---}}
    <div class="modal fade" id="modal_edit_delete_subcategoria_egresos_index" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="float-start">Editar</h5>
                    <button class="btn btn-danger rounded btn-sm" id="salir_listado"><b>X</b> salir</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoria_index_edit"><b>Nombre categoría <span class="text-danger">*</span></b></label>
                        <input type="text" class="form-control" name="categoria_index_edit" id="categoria_index_edit"
                            placeholder="Escriba aquí" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name_subcategoria_index_edit"><b>Nombre egreso <span class="text-danger">*</span></b></label>
                        <input type="text" class="form-control" name="name_subcategoria_index_edit" id="name_subcategoria_index_edit"
                            placeholder="Escriba aquí" >
                    </div>
                    <div class="form-group">
                        <label for="gasto_subcategoria_index_edit"><b>Gasto egreso
                                {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}
                                <span class="text-danger">*</span></b></label>
                        <input type="number" class="form-control" name="gasto_subcategoria_index_edit" id="gasto_subcategoria_index_edit"
                            placeholder="Escriba aquíi" min="1">
                    </div>
                    <div class="card-text">
                        <br>
                        <div class="table-responsive">
                            <h5>Sub categorías</h5>
                            <table class="table table-bordered table-striped responsive nowrap" id="detalle_egresos_index_edit" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="d-none">ID</th>
                                        <th>Acciones</th>
                                        <th>Egreso</th>
                                        <th>Gasto
                                            {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}
                                        </th>
                                    </tr>
                                </thead>
                                
                            </table>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success rounded" id="save_egresos_index_edit" disabled>Guardar <i class='bx bx-save'></i></button>
                </div>
            </div>
        </div>
    </div>
    {{--MOdal para editar las categorias ---}}
    <div class="modal fade" id="modal_editar_categoria">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header badge bg-primary">
                    <h5 class="text-white">Editar categoría</h5>
                </div>

                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" value="{{$this->Csrf_Token()}}">
                        <div class="form-group">
                            <label for="name_categoria_editar"><b>Nombre categoría <span class="text-danger">*</span></b></label>
                            <input type="text" name="name_categoria_editar" id="name_categoria_editar" class="form-control" placeholder="Escriba aquí..">
                        </div>
                        <div class="form-group">
                            <label for="fecha_categoria_editar"><b>Fecha<span class="text-danger">*</span></b></label>
                            <input type="date" name="fecha_categoria_editar" id="fecha_categoria_editar" class="form-control" >
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button class="btn_success_person" id="update_categorias"><b>Guardar <i class='bx bx-save' ></i></b></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- /** Inclimos archivos externos**/ -->
    <script src="{{ URL_BASE }}public/js/control.js"></script>
    <script src="{{ URL_BASE }}public/js/egresos.js"></script>
    <script>
        var RUTA = "{{ URL_BASE }}" // la url base del sistema
        var TOKEN = "{{ $this->Csrf_Token() }}";
        var TablaEgresos;
        var IDCATEGORIAEGRESO;
        var IDSUBCATEGORIAEGRESO;
        var TablaSubCategoriasData;
        $(document).ready(function() {
            let GastoSubCategoria_Index = $('#gasto_subcategoria_index');
            let NameSubCategoria_Index = $('#name_subcategoria_index');
            
            let FechaSubCategoria_Index = $('#fecha_subcategoria_index');
        
            /// mostramos los egresos
            MostrarLosEgresos();
            DestroyCategoriaEgreso();
            addSubCategoria();
            quitarSubCategoriaIndex();
            editarSubCategoriaDeCategoriaDeEgresos();
            EditarCategoriaEgreso();

            NameSubCategoria_Index.keypress(function(evento){
                if(evento.which == 13){
                    evento.preventDefault();

                    if($(this).val().trim().length == 0)
                    {
                        $(this).focus();
                    }else{
                        GastoSubCategoria_Index.focus();
                    }
                }

            });
            GastoSubCategoria_Index.keypress(function(evento){
                if(evento.which == 13){
                    evento.preventDefault();

                    if($(this).val().trim().length == 0)
                    {
                        $(this).focus();
                    }else{
                        if (ExisteEgreso(NameSubCategoria_Index)) {
                    Swal.fire({
                        title: "Mensaje del sistema!",
                        text: "Ya existe, agregue otro!",
                        icon: "info",
                        target: document.getElementById('modal_add_subcategoria_egresos_index')
                    }).then(function() {
                        NameSubCategoria_Index.focus();
                        NameSubCategoria_Index.val("");
                    });
                } else {
                        addDetalleSubCategoria(NameSubCategoria_Index, GastoSubCategoria_Index,'detalle_egresos_body_index');    
                        NameSubCategoria_Index.focus();
                         
                        GastoSubCategoria_Index.val("");
                        NameSubCategoria_Index.val("");
                }
                    }
                }

            });

            $('#save_egresos_index').click(function(){
               
                if($('#detalle_egresos_body_index tr').length >0)
                {
                    if(saveSubCategoriasEgreso('detalle_egresos_body_index','categoria_index') == 1){
                   Swal.fire({
                    title:"Mensaje del sistema!",
                    text:"Egresos añadidos correctamente a la categoría!",
                    icon:"success",
                    target:document.getElementById('modal_add_subcategoria_egresos_index')
                   }).then(function(){
                     $('#detalle_egresos_body_index tr').remove();
                     MostrarLosEgresos();
                   });
                }else{
                    alert("error");
                }
                }else{
                    Swal.fire({
                            title: "Mensaje del sistema!",
                            text: "Agregue las sub categorías perteneciente a la categoría que deseas agregar!",
                            icon: "error",
                            target: document.getElementById('modal_add_subcategoria_egresos_index')
                  });
                }
            });

            $('#update_categorias').click(function(){
                if($('#name_categoria_editar').val().trim().length == 0){
                    $('#name_categoria_editar').focus();
                }else{
                    UpdateCategoriaEgreso(IDCATEGORIAEGRESO)
                }
            });

            $('#salir').click(function(){
                $('#modal_add_subcategoria_egresos_index').modal("hide");
                NameSubCategoria_Index.val("");
                GastoSubCategoria_Index.val("");
                FechaSubCategoria_Index.val("{{$this->FechaActual('Y-m-d')}}");
                $('#detalle_egresos_body_index tr').remove();  
            });

            $('#salir_listado').click(function(){
                $('#modal_edit_delete_subcategoria_egresos_index').modal("hide");
                NameSubCategoria_Index.val("");
                GastoSubCategoria_Index.val("");
                FechaSubCategoria_Index.val("{{$this->FechaActual('Y-m-d')}}");
                 
            });

            $('#save_egresos_index_edit').click(function(){
                $.ajax({
                    url:RUTA+"egreso/subcategoria/update/"+IDSUBCATEGORIAEGRESO,
                    method:"POST",
                    data:{
                        _token:TOKEN,
                        subcategoria_egreso:$('#name_subcategoria_index_edit').val(),
                        gasto:$('#gasto_subcategoria_index_edit').val(),
                        fecha:$('#fecha_subcategoria_index_edit').val()
                    },
                    dataType:"json",
                    success:function(response)
                    {
                        if(response.response == 1)
                        {
                            Swal.fire({
                                title:"Mensaje del sistema!",
                                text:"Egreso modificado",
                                icon:"success",
                                target:document.getElementById('modal_edit_delete_subcategoria_egresos_index')
                            }).then(function(){
                                MostrarLosSubCategoriasEgresos(IDCATEGORIAEGRESO);
                                $('#name_subcategoria_index_edit').val("");
                                $('#gasto_subcategoria_index_edit').val("");
                                $('#fecha_subcategoria_index_edit').val("{{$this->FechaActual('Y-m-d')}}");
                            });
                        }else{
                            Swal.fire({
                                title:"Mensaje del sistema!",
                                text:"Error al modificar datos del egreso",
                                icon:"error",
                                target:document.getElementById('modal_edit_delete_subcategoria_egresos_index')
                            });
                        }
                    },error:function(err)
                    {
                        Swal.fire({
                                title:"Mensaje del sistema!",
                                text:"Error al modificar datos del egreso",
                                icon:"error",
                                target:document.getElementById('modal_edit_delete_subcategoria_egresos_index')
                       });
                    }
                });
            });

        });

         /// verificar existencia

         function ExisteEgreso(datatext) {
            let bandera = false;
            let Tabla = document.getElementById('detalle_egresos_body_index');

            let rowsData = Tabla.rows.length;

            for (let i = 0; i < rowsData; i++) {
                if (Tabla.rows[i].cells[0].innerHTML === datatext.val()) {
                    bandera = true;
                }

            }

            return bandera;
        }
    </script>
@endsection
