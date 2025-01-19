@extends($this->Layouts('dashboard'))

@section('title_dashboard', 'Gestión de egresos')

@section('css')
    <style>
        #detalle_egresos>thead>tr>th,
        .modal-header {
            background-color: #E6E6FA;
            color: rgb(16, 111, 228);
        }
    </style>
@endsection
@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-text">
                        <h4>Crear nuevo egreso</h4>
                    </div>

                    <div class="card-text">
                        <div class="form-group">
                            <label for="categoria_name"><b>Nombre categoría <span class="text-danger">*</span></b></label>
                            <input type="text" class="form-control" id="categoria_name"
                                placeholder="Escriba la categóría...">
                        </div>
                        <div class="form-group">
                            <label for="fecha"><b>Fecha</b></label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="fecha_categoria" value="{{$this->FechaActual("Y-m-d")}}" >
                            <button class="btn btn-info" id="add_subcat"><i class='bx bx-category'></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="card-text">
                        <br>
                        <div class="table-responsive">
                            <h5>Listado de Egreso</h5>
                            <table class="table table-bordered table-striped" id="detalle_egresos">
                                <thead>
                                    <tr>
                                        <th>Egreso</th>
                                        <th>Gasto
                                            {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}
                                        </th>
                                        <th>Quitar</th>
                                    </tr>
                                </thead>
                                <tbody id="detalle_egresos_body"></tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-text text-center">
                        <button class="btn_success_person" id="save_egreso"><b>Guardar <i
                                    class='bx bx-save'></i></b></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- - modal para agregar sub categprías de los egresos --}}
    <div class="modal fade" id="modal_add_subcategoria_egresos">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Agregar Egresos</h5>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name_subcategoria"><b>Nombre Egreso <span class="text-danger">*</span></b></label>
                        <input type="text" class="form-control" name="name_subcategoria" id="name_subcategoria"
                            placeholder="Escriba aquíi">
                    </div>
                    <div class="form-group">
                        <label for="gasto_subcategoria"><b>Gasto egreso
                                {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}
                                <span class="text-danger">*</span></b></label>
                        <input type="text" class="form-control" name="gasto_subcategoria" id="gasto_subcategoria"
                            placeholder="Escriba aquíi">
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" id="listar_egresos">Listar <i class='bx bx-list-plus'></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ URL_BASE }}public/js/egresos.js"></script>
    <script>
         var RUTA = "{{ URL_BASE }}" // la url base del sistema
        var TOKEN = "{{ $this->Csrf_Token() }}";
        $(document).ready(function() {

            let NameSubCategoria = $('#name_subcategoria');
            let GastoSubCategoria = $('#gasto_subcategoria');
            let FechaSubCategoria = $('#fecha_subcategoria');
            let NameCategoria = $('#categoria_name');
 

            quitarSubCategoria();

            $('#add_subcat').click(function() {
                $('#modal_add_subcategoria_egresos').modal("show");
            });

            NameSubCategoria.keypress(function(evento){
                if(evento.which == 13){
                    evento.preventDefault();

                    if($(this).val().trim().length == 0)
                    {
                        $(this).focus();
                    }else{
                        GastoSubCategoria.focus();
                    }
                }

            });

            GastoSubCategoria.keypress(function(evento){
                if(evento.which == 13){
                    evento.preventDefault();

                    if($(this).val().trim().length == 0)
                    {
                        $(this).focus();
                    }else{
                        addDetalleSubCategoria(NameSubCategoria, GastoSubCategoria, 'detalle_egresos_body');    
                        NameSubCategoria.focus();
                        NameSubCategoria.val("");
                        GastoSubCategoria.val("");
                        FechaSubCategoria.val("{{ $this->FechaActual('Y-m-d') }}");
                    }
                }

            })

            $('#listar_egresos').click(function() {
               if(NameSubCategoria.val().trim().length == 0)
               {
                NameSubCategoria.focus();
               }else{
                if(GastoSubCategoria.val().trim().length == 0)
                {
                    GastoSubCategoria.focus();
                }else{
                    if (ExisteEgreso(NameSubCategoria)) {
                    Swal.fire({
                        title: "Mensaje del sistema!",
                        text: "Ya existe, agregue otro!",
                        icon: "info",
                        target: document.getElementById('modal_add_subcategoria_egresos')
                    }).then(function() {
                        NameSubCategoria.focus();
                        NameSubCategoria.val("");
                    });
                } else {
                     
                    addDetalleSubCategoria(NameSubCategoria, GastoSubCategoria, 'detalle_egresos_body');
                    NameSubCategoria.focus();
                    NameSubCategoria.val("");
                    GastoSubCategoria.val("");
                    FechaSubCategoria.val("{{ $this->FechaActual('Y-m-d') }}");

                }
                }
               }
            });

            $('#save_egreso').click(function() {
                if (NameCategoria.val().trim().length == 0) {
                    NameCategoria.focus();
                } else {
                    
                    if ($('#detalle_egresos_body tr').length > 0) {
                         saveCategoriaEgreso()
                    } else {
                        Swal.fire({
                            title: "Mensaje del sistema!",
                            text: "Agregue las sub categorías perteneciente a la categoría que deseas agregar!",
                            icon: "error"
                        });
                    }
                }
            });
        });

        /// verificar existencia

        function ExisteEgreso(datatext) {
            let bandera = false;
            let Tabla = document.getElementById('detalle_egresos_body');

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
