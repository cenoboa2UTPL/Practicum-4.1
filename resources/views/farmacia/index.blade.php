@extends($this->Layouts('dashboard'))

@section('title_dashboard', 'Farmacia')
@section('clase_ocultar', 'd-none')
@section('expandir', 'layout-content-navbar layout-without-menu')

@section('css')
    <link rel="stylesheet" href="{{$this->asset("css/cssfarmacia.css")}}">
    <style>
        td.hide_me
    {
      display: none;
    }
    #tabla_buscar_proveedores>thead>tr>th{
        background-color:#E6E6FA;
    }
    </style>
@endsection
@section('contenido')
    <div class="card" id="farmacia_card">
        <div class="card-header bg-primary header_card_farmacia">
            <h5 class="text-white float-start">Gestión de la farmacia</h5>
            <a href="{{ $this->route('dashboard') }}" class="btn btn-warning rounded btn-sm float-end">Volver <i
                    class='bx bx-arrow-back'></i></a>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs card-header-tabs" id="tab_farmacia">
                @if ($this->profile()->rol === 'admin_general' || $this->profile()->rol === 'admin_farmacia' )
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="#tipo_producto" id="tipo_producto_"><b>Tipo
                            producto</b>
                            <img src="{{ $this->asset('img/icons/unicons/categoria_farmacia.ico') }}" class="menu-icon"
                                alt="">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#presentacion" id="presentacion_"><b>Presentación</b>
                            <img src="{{ $this->asset('img/icons/unicons/presentacion_farmacia.ico') }}" class="menu-icon"
                                alt="">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#laboratorio" tabindex="-1" aria-disabled="true"
                            id="laboratorios_"><b>Laboratorios</b>
                            <img src="{{ $this->asset('img/icons/unicons/laboratorio_farmacia.ico') }}" class="menu-icon"
                                alt="">
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#grupos" tabindex="-1" aria-disabled="true" id="grupos_"><b>Grupos
                            terapeúticos</b>
                            <img src="{{ $this->asset('img/icons/unicons/grupo.ico') }}" class="menu-icon" alt="">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#embalaje" tabindex="-1" aria-disabled="true" id="embalaje_"><b>Embalajes o
                            empaques</b>
                            <img src="{{ $this->asset('img/icons/unicons/embalaje.ico') }}" class="menu-icon"
                                alt="">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#proveedores" tabindex="-1" aria-disabled="true"
                            id="proveedores_"><b>Proveedores</b>
                            <img src="{{ $this->asset('img/icons/unicons/proveedores.ico') }}" class="menu-icon"
                                alt="">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#productos" tabindex="-1" aria-disabled="true" id="productos_"><b>Productos</b>
                            <img src="{{ $this->asset('img/icons/unicons/productos_farmacia.ico') }}" class="menu-icon"
                                alt="">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#compras" tabindex="-1" aria-disabled="true" id="compras_"><b>Compras</b>
                            <img src="{{ $this->asset('img/icons/unicons/compras.ico') }}" class="menu-icon" alt="">
                        </a>
                    </li>
                @endif
                <!-- modificado --->
                @if ($this->profile()->rol === 'Farmacia' || $this->profile()->rol === 'Director')
                    <li class="nav-item active">
                        <a class="nav-link" href="#ventas" tabindex="-1" aria-disabled="true" id="save_ventas_"><b>Registrar venta</b>
                            <img src="{{ $this->asset('img/icons/unicons/venta_farmacia.ico') }}" class="menu-icon"
                                alt="">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#clientes" tabindex="-1" aria-disabled="true" id="clientes_"><b>Clientes</b>
                            <img src="{{ $this->asset('img/icons/unicons/clientes_farmacia.ico') }}" class="menu-icon"
                                alt="">
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#historia_ventas" tabindex="-1" aria-disabled="true"
                            id="historia_ventas_"><b>Historia de las
                                ventas</b><img src="{{ $this->asset('img/icons/unicons/historia_ventas.ico') }}"
                                class="menu-icon" alt=""></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reporte_ventas" tabindex="-1" aria-disabled="true"
                            id="reporte_ventas_"><b>Reporte de ventas</b><img src="{{ $this->asset('img/icons/unicons/reporte_venta.ico') }}"
                                class="menu-icon" alt=""></a>
                    </li>
                @endif
                
            </ul>

            {{-- Opciones del tab-- --}}
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade @if ($this->profile()->rol === 'admin_general' || $this->profile()->rol === 'admin_farmacia') show active @endif" id="tipo_producto"
                    role="tabpanel" aria-labelledby="home-tab">
                    <br>
                    <form action="" method="post" id="form_tipo_producto">
                        <input type="hidden" name="_token" value="{{ $this->Csrf_Token() }}">
                        <div class="form-group">
                            <label for="name_tipo_producto"><b>Nombre tipo producto <span
                                        class="text-danger">*</span></b></label>
                            <div class="input-group">
                                <input type="text" name="name_tipo_producto" id="name_tipo_producto"
                                    class="form-control" placeholder="Escriba aquí..." autofocus>
                                <button class="btn btn-outline-success" id="save_tipo_producto"><i
                                        class='bx bx-save'></i></button>
                            </div>
                        </div>
                    </form>

                    <div class="card mt-2 card_tipo">
                        <div class="card-body">
                            <div class="card-text">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped responsive nowrap"
                                        id="lista_tipo_productos">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tipo producto</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="presentacion" role="tabpanel" aria-labelledby="profile-tab">
                    <br>
                    <form action="" method="post" id="form_presentacion">
                        <input type="hidden" name="_token" value="{{ $this->Csrf_Token() }}">
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-7 col-12">
                                <div class="form-group">
                                    <label for="name_presentacion"><b>Nombre presentación<span
                                                class="text-danger">*</span></b></label>
                                    <input type="text" name="name_presentacion" id="name_presentacion"
                                        class="form-control" placeholder="Escriba aquí..." autofocus>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-12">
                                <div class="form-group">
                                    <label for="name_corto_presentacion"><b>Nombre corto presentación<span
                                                class="text-danger">*</span></b></label>
                                    <div class="input-group">
                                        <input type="text" name="name_corto_presentacion" id="name_corto_presentacion"
                                            class="form-control" placeholder="Escriba aquí..." autofocus>
                                        <button class="btn btn-outline-success rounded" id="save_presentacion">
                                            <i class='bx bx-save'></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped nowrap responsive"
                                    id="lista_presentacion" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre presentación</th>
                                            <th>Nombre corto presentación</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="laboratorio" role="tabpanel" aria-labelledby="contact-tab">
                    <br>
                    <form action="" method="post" id="form_laboratorio">
                        <input type="hidden" name="_token" value="{{ $this->Csrf_Token() }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name_laboratorio"><b>Nombre laboratorio<span
                                                class="text-danger">*</span></b></label>
                                    <input type="text" name="name_laboratorio" id="name_laboratorio"
                                        class="form-control" placeholder="Escriba aquí..." autofocus>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="direccion_laboratorio"><b>Dirección </b></label>
                                    <textarea name="direccion_laboratorio" id="direccion_laboratorio" class="form-control" cols="30"
                                        rows="2" placeholder="Escriba aquí..."></textarea>
                                </div>
                            </div>
                            <div class="col-12 text-center mt-3 mb-2">
                                <button class="btn_info_tw" id="save_laboratorio">Guardar <i
                                        class='bx bx-save'></i></button>
                            </div>
                        </div>
                    </form>
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped nowrap responsive"
                                    id="lista_laboratorios" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre laboratorio</th>
                                            <th>Dirección</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="grupos" role="tabpanel" aria-labelledby="contact-tab">
                    <br>
                    <form action="" method="post" id="form_grupos">
                        <input type="hidden" name="_token" value="{{ $this->Csrf_Token() }}">
                        <div class="form-group">
                            <label for="name_grupo"><b>Nombre grupo <span class="text-danger">*</span></b></label>
                            <div class="input-group">
                                <input type="text" name="name_grupo" id="name_grupo" class="form-control"
                                    placeholder="Escriba aquí..." autofocus>
                                <button class="btn btn-outline-success" id="save_grupo"><i
                                        class='bx bx-save'></i></button>
                            </div>
                        </div>
                    </form>

                    <div class="card mt-2 card_tipo">
                        <div class="card-body">
                            <div class="card-text">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped responsive nowrap"
                                        id="lista_grupo_terapeuticos" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Grupo terapeútico</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="embalaje" role="tabpanel" aria-labelledby="contact-tab">
                    <br>
                    <form action="" method="post" id="form_empaque">
                        <input type="hidden" name="_token" value="{{ $this->Csrf_Token() }}">
                        <div class="form-group">
                            <label for="name_embalaje"><b>Nombre embalaje <span class="text-danger">*</span></b></label>
                            <div class="input-group">
                                <input type="text" name="name_embalaje" id="name_embalaje" class="form-control"
                                    placeholder="Escriba aquí....">
                                <button class="btn btn-outline-success" id="save_embalaje"><i
                                        class='bx bx-save'></i></button></button>
                            </div>
                        </div>
                    </form>
                    <div class="mt-3 card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped nowrap responsive" id="lista_embalajes"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre empaque</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="proveedores" role="tabpanel" aria-labelledby="contact-tab">
                    <br>
                    <form action="" method="post" id="form_proveedores">
                        <input type="hidden" name="_token" value="{{ $this->Csrf_Token() }}">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="proveedor_name"><b>Nombre proveedor <span
                                                class="text-danger">*</span></b></label>
                                    <input type="text" name="proveedor_name" id="proveedor_name" class="form-control"
                                        placeholder="Escriba aquí...">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="contacto_name"><b>Nombre contacto <span
                                                class="text-danger">*</span></b></label>
                                    <input type="text" name="contacto_name" id="contacto_name" class="form-control"
                                        placeholder="Escriba aquí...">
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-4 col-12">
                                <div class="form-group">
                                    <label for="telefono"><b>Teléfono </b></label>
                                    <input type="text" name="telefono" id="telefono" class="form-control"
                                        placeholder="Escriba aquí...">
                                </div>
                            </div>

                            <div class="col-xl-9 col-lg-9 col-md-8 col-12">
                                <div class="form-group">
                                    <label for="correo"><b>Correo electrónico </b></label>
                                    <input type="text" name="correo" id="correo" class="form-control"
                                        placeholder="Escriba aquí...">
                                </div>
                            </div>

                            <div class="col-xl-5 col-lg-5 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="direccion"><b>Dirección </b></label>
                                    <input type="text" name="direccion" id="direccion" class="form-control"
                                        placeholder="Escriba aquí...">
                                </div>
                            </div>

                            <div class="col-xl-7 col-lg-7 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="paginaweb"><b>Página web </b></label>
                                    <input type="text" name="paginaweb" id="paginaweb" class="form-control"
                                        placeholder="Escriba aquí...">
                                </div>
                            </div>
                            <div class="col-12 text-center mt-3 mb-2">
                                <button class="btn_info_tw" id="save_proveedor">Guardar <i
                                        class='bx bx-save'></i></button>
                            </div>
                        </div>
                    </form>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped nowrap responsive" id="lista_proveedores"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Proveedor</th>
                                            <th>Contacto</th>
                                            <th>Teléfono</th>
                                            <th>Correo</th>
                                            <th>Dirección</th>
                                            <th>Página web</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="productos" role="tabpanel" aria-labelledby="contact-tab">
                    <br>
                    <form action="" method="post" id="form_productos">
                        <input type="hidden" name="_token" value="{{ $this->Csrf_Token() }}">
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                                <label for="nombre_producto"><b>Nombre producto<span
                                            class="text-danger">*</span></b></label>
                                <input type="text" name="nombre_producto" id="nombre_producto" class="form-control"
                                    placeholder="Escriba aquí....">
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-12">
                                <label for="precio_venta"><b>Precio de venta <span
                                            class="text-danger">*</span></b></label>
                                <input type="text" name="precio_venta" id="precio_venta" class="form-control"
                                    placeholder="Escriba aquí....">
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-5 col-sm-6 col-12">
                                <label for="stock"><b>Stock <span class="text-danger">*</span></b></label>
                                <input type="number" name="stock" id="stock" class="form-control"
                                    placeholder="0" min="0" value="0">
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-12 col-sm-6 col-12">
                                <label for="stock_minimo"><b>Stock Mínimo<span class="text-danger">*</span></b></label>
                                <input type="number" name="stock_minimo" id="stock_minimo" class="form-control"
                                    placeholder="0" min="0" value="0">
                            </div>
                            <div class="col-xl-3 col-12 col-md-12 col-sm-6 col-12">
                                <label for="fecha_vencimiento"><b>Fecha de vencimiento</b></label>
                                <input type="date" name="fecha_vencimiento" id="fecha_vencimiento"
                                    class="form-control" min="{{ $this->FechaActual('Y-m-d') }}"
                                    value="{{ $this->FechaActual('Y-m-d') }}">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                <label for="tipo_select"><b>Tipo<span class="text-danger">*</span></b></label>
                                <select name="tipo_select" id="tipo_select" class="form-select">
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6  col-12">
                                <label for="presentacion_select"><b>Presentación<span
                                            class="text-danger">*</span></b></label>
                                <select name="presentacion_select" id="presentacion_select" class="form-select">
                                </select>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-12">
                                <label for="laboratorio_select"><b>Laboratorio<span
                                            class="text-danger">*</span></b></label>
                                <select name="laboratorio_select" id="laboratorio_select" class="form-select">
                                </select>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                <label for="grupo_select"><b>Grupo terapeútico<span
                                            class="text-danger">*</span></b></label>
                                <select name="grupo_select" id="grupo_select" class="form-select">
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                                <label for="embalaje_select"><b>Empaque<span class="text-danger">*</span></b></label>
                                <select name="embalaje_select" id="embalaje_select" class="form-select">
                                </select>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-12">
                                <label for="proveedor_select"><b>Proveedor<span class="text-danger">*</span></b></label>
                                <select name="proveedor_select" id="proveedor_select" class="form-select">
                                </select>
                            </div>
                            <div class="mt-3 text-center">
                                <button class="btn_info_tw" id="save_producto"><b>Guardar producto <i
                                            class='bx bx-save'></i></b></button>
                                
                            </div>
                        </form>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{$this->route("productos/import/excel")}}" method="post" enctype="multipart/form-data" id="form_import_productos">
                                        <input type="hidden" name="_token" value="{{$this->Csrf_Token()}}">
                                        <input type="file" name="excel_productos" id="excel_productos" >
                                        <button class="btn btn-primary col-xl-2 col-lg-3 col-md-4  col-12 mt-xl-0 mt-lg-0 mt-md-0 mt-1" id="importar_productos">Importar datos <i class="fas fa-file-excel"></i></button>
                                        <button class="btn btn-danger rounded col-xl-3 col-lg-4 col-md-5  col-12 mt-xl-0 mt-lg-0 mt-md-1 mt-1" id="reporte_productos">Reporte productos por vencer <i class='bx bxs-report'></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped nowrap responsive" id="lista_productos"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Acciones</th>
                                            <th>Producto</th>
                                            <th>Estado</th>
                                            <th>Esta vencido ?</th>
                                            <th>Quedan para vencer</th>
                                            <th>Precio
                                                {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}
                                            </th>
                                            <th>Stock</th>
                                            <th>Stock Mínimo</th>
                                            <th>Fecha de vencimiento</th>
                                            <th>Tipo</th>
                                            <th>Presentación</th>
                                            <th>Laboratorio</th>
                                            <th>Grupo terapeútico</th>
                                            <th>Empaque</th>
                                            <th>Proveedor</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="compras" role="tabpanel" aria-labelledby="contact-tab">
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-end">
                                    <div class="col-xl-6 col-lg-4 col-12">
                                        <label for="proveedor_compra"><b>Seleccione proveedor <span class="text-danger">*</span></b></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="proveedor_compra" placeholder="PROVEEDOR.." readonly>
                                            <button class="btn btn-primary" id="open_proveedor_compra"><i class='bx bxs-user-detail'></i></button>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="fecha_emision_compra"><b>Fecha de la compra <span class="text-danger">*</span></b></label>
                                            <input type="date" class="form-control" id="fecha_emision_compra" value="{{$this->FechaActual("Y-m-d")}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="serie_emision"><b>Número de compra<span class="text-danger">*</span></b></label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <b>REC-</b>
                                                </span>
                                                <input type="text" class="form-control" id="serie_compra" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-xl-9 col-lg-8  col-12">
                        <div class="card">
                            <div class="card-body">
                                <span class="float-start"><b>Detalle de la compra</b></span>
                                        <button class="btn_success_person float-end mb-2 col-xl-3 col-lg-5 col-md-5  col-12" id="agregar_producto_compra"><b>Agregar productos <i class='bx bx-plus'></i></b></button>
                                        <div class="table-responsive" >
                                           <table class="table table-bordered" id="lista_detalle_compra">
                                               <thead>
                                                   <tr> 
                                                       <th class="text-center">Quitar</th>
                                                       <th class="text-center">Cantidad</th>
                                                       <th class="text-center">Descripción</th>
                                                       <th class="text-center">Empaque</th>
                                                       <th class="text-center">Precio  {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</th>
                                                       <th class="text-center">Importe  {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</th>
                                                   </tr>
                                               </thead>
                                               <tbody id="lista_detalle_compra_body"></tbody>
                                           </table>
                                  </div>
 
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4  col-12 mt-xl-0 mt-lg-0 mt-md-0 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for=""><b>Sub Total <span class="text-primary">{{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</span></b></label>
                                    <input type="text" class="form-control" id="sub_total_compra" readonly value="0.00">
                                </div>
                                <div class="form-group">
                                    <label for=""><b>Igv  <span class="text-primary">{{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</span></b></label>
                                    <input type="text" class="form-control" id="igv_compra" readonly value="0.00">
                                </div>
                                <div class="form-group">
                                    <label for=""><b>Total gasto   <span class="text-primary">{{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</span></b></label>
                                    <input type="text" class="form-control" id="total_compra" readonly value="0.00">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2 text-center">
                        <button class="btn_twiter m-1" id="save_compra">Guardar la compra <i class='bx bxs-basket'></i></button>
                        <button class="btn btn-danger rounded m-1 col-xl-2 col-lg-3 col-md-4 col-sm-6 col-9 cancelar_compra"><b>Cancelar compra</b> <b>X</b><i class='bx bxs-basket'></i></button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="clientes" role="tabpanel" aria-labelledby="contact-tab">
            <br>
             <form action="" method="post" id="form_clientes">
                <input type="hidden" name="_token" id="_token" value="{{$this->Csrf_Token()}}">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                        <label for="tipo_doc" class="form-label"><b>Tipo documento <span class="text-danger">*</span></b></label>
                        <select name="tipo_doc" id="tipo_doc" class="form-select">
                            @if (isset($TipoDocumentos))
                                @foreach ($TipoDocumentos as $tipodoc)
                                    <option value="{{$tipodoc->id_tipo_doc}}">{{$tipodoc->name_tipo_doc}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-12">
                        <label for="num_doc" class="form-label"><b>Número documento <span class="text-danger">*</span></b></label>
                        <input type="text" name="num_doc" id="num_doc" class="form-control" placeholder="Escriba aquí..." maxlength="20">
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                        <label for="name_cliente" class="form-label"><b>Nombres completos <span class="text-danger">*</span></b></label>
                        <input type="text" name="name_cliente" id="name_cliente" class="form-control" placeholder="Escriba aquí...">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-12">
                        <label for="apellidos_cliente" class="form-label"><b>Apellidos completos <span class="text-danger">*</span></b></label>
                        <input type="text" name="apellidos_cliente" id="apellidos_cliente" class="form-control" placeholder="Escriba aquí...">
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <label for="direccion_cliente" class="form-label"><b>Dirección</b></label>
                        <input type="text" name="direccion_cliente" id="direccion_cliente" class="form-control" placeholder="Escriba aquí...">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <label for="telefono_cliente" class="form-label"><b>Teléfono</b></label>
                        <input type="text" name="telefono_cliente" id="telefono_cliente" class="form-control" placeholder="Escriba aquí..." maxlength="20">
                    </div>

                    <div class="text-center mt-3 mb-2">
                        <button id="save_cliente" class="btn_success_person"><b>Guardar cliente <i class='bx bx-save'></i></b></button>
                    </div>
                </div>
             </form>

             <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover nowrap responsive" id="lista_clientes" style="width: 100%">
                          <thead>
                            <tr>
                                <th>#</th>
                                <th>Acciones</th>
                                <th>Tipo documento</th>
                                <th>Num.documento</th>
                                <th>Cliente</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                            </tr>
                          </thead>
                        </table>
                    </div>
                </div>
             </div>
            </div>
            <!--- MODIFICADO--->
            <div class="tab-pane fade  @if ($this->profile()->rol === 'Farmacia' || $this->profile()->rol === 'Director') show active @endif" id="ventas"
                role="tabpanel" aria-labelledby="contact-tab">
               <br>
                <input type="hidden" name="_token" value="{{$this->Csrf_Token()}}">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-end">
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="fecha_emision"><b>Fecha emisión <span class="text-danger">*</span></b></label>
                                            <input type="date" class="form-control" id="fecha_emision_venta" value="{{$this->FechaActual("Y-m-d")}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="fecha_emision"><b>Número de venta <span class="text-danger">*</span></b></label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <b>REC-</b>
                                                </span>
                                                <input type="text" class="form-control" id="serie" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span><b>Datos del cliente</b></span>
                                <div class="row mt-2">
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class='bx bx-id-card'></i></span>
                                            <input type="text"   class="form-control" placeholder="# documento" id="documento_venta">
                                          </div>
                                          <span class="text-danger error_buscar_cliente" style="display: none">Mínimo 8 caracteres 😔😢</span>
                                    </div>
                                    <div class="col-xl-9 col-lg-8 col-md-6 col-sm-6 col-12">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class='bx bxs-user-circle'></i></span>
                                            <input type="text" class="form-control" id="cliente_venta" placeholder="Cliente...." readonly
                                            value="Público en general">
                                            <button class="btn btn-primary" id="search_cliente"><i class='bx bx-select-multiple'></i></button>
                                        </div>
                                        <span class="text-danger error_buscar_cliente_two" style="display: none">No se pudo encontrar al cliente.. 😔😢</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-xl-9 col-lg-8  col-12">
                        <div class="card">
                            <div class="card-body">
                                <span class="float-start"><b>Detalle de la venta</b></span>
                                        <button class="btn_success_person float-end mb-2 col-xl-3 col-lg-5 col-md-5  col-12" id="agreagr_producto_venta"><b>Agregar productos <i class='bx bx-plus'></i></b></button>
                                        <div class="table-responsive" >
                                           <table class="table table-bordered" id="lista_detalle_venta">
                                               <thead>
                                                   <tr> 
                                                       <th class="text-center">Quitar</th>
                                                       <th class="text-center">Cantidad</th>
                                                       <th class="text-center">Descripción</th>
                                                       <th class="text-center">Empaque</th>
                                                       <th class="text-center">Precio  {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</th>
                                                       <th class="text-center">Importe  {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</th>
                                                   </tr>
                                               </thead>
                                               <tbody id="lista_detalle_venta_body"></tbody>
                                           </table>
                                  </div>

                                  <div class="row" id="monto_recibido_and_vuelto"  >
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                                        <label for=""><b>Monto recibido por el cliente {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</b></label>
                                        <input type="text" class="form-control" id="monto_recibido" placeholder="{{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }} 0.00">
                                        <span class="text-danger" style="display: none" id="msg_error_monto">El monto debe ser > al monto total!</span>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                                        <label for=""><b>Vuelto {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</b></label>
                                        <input type="text" class="form-control" id="vuelto" placeholder="{{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }} 0.00" readonly
                                        value="0.00">
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4  col-12 mt-xl-0 mt-lg-0 mt-md-0 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for=""><b>Sub Total <span class="text-primary">{{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</span></b></label>
                                    <input type="text" class="form-control" id="sub_total_venta" readonly value="0.00">
                                </div>
                                <div class="form-group">
                                    <label for=""><b>Igv  <span class="text-primary">{{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</span></b></label>
                                    <input type="text" class="form-control" id="igv_venta" readonly value="0.00">
                                </div>
                                <div class="form-group">
                                    <label for=""><b>Total a pagar  <span class="text-primary">{{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</span></b></label>
                                    <input type="text" class="form-control" id="total_venta" readonly value="0.00">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2 text-center">
                        <button class="btn_twiter m-1" id="save_venta">Guardar la venta <i class='bx bxs-basket'></i></button>
                        <button class="btn btn-danger rounded m-1 col-xl-2 col-lg-3 col-md-4 col-sm-6 col-9 cancelar_venta"><b>Cancelar venta</b> <b>X</b><i class='bx bxs-basket'></i></button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="historia_ventas" role="tabpanel" aria-labelledby="contact-tab">
              <br>
              <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-7 col-sm-8 col-12">
                    <div class="form-group">
                        <label for="fecha_venta_historial"><b>Seleccionar fecha</b></label>
                        <input type="date" class="form-control" id="fecha_venta_historial" value="{{$this->FechaActual("Y-m-d")}}">
                    </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-striped nowrap responsive" id="lista_historial_ventas" style="width: 100%">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Acciones</th>
                        <th>Num.venta</th>
                        <th>Fecha emisión</th>
                        <th>Cliente</th>
                        <th>Farmaceútico vendedor</th>
                        <th>Total venta</th>
                        <th>Monto recibido</th>
                        <th>Vuelto</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" id="reporte_ventas" role="tabpanel" aria-labelledby="contact-tab">
              <br>
              <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                    <div class="form-group">
                        <label for="fi"><b>Fecha inicio</b></label>
                        <input type="date" name="fi" id="fi" class="form-control" value="{{$this->FechaActual("Y-m-d")}}">
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                    <div class="form-group">
                        <label for="ff"><b>Fecha fin</b></label>
                        <input type="date" name="ff" id="ff" class="form-control" value="{{$this->addRestFecha("Y-m-d","10 day")}}">
                    </div>
                </div>
                
              </div>
              
              <div class="table-responsive">
                <table class="table table-bordered table-striped nowrap responsive" id="reporte_productos_ganancias" style="width: 100%">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Precio de compra</th>
                        <th>Precio de venta</th>
                        <th>Ganancia</th>
                    </tr>
                  </thead>

                  <tfoot align="right" style="background-color: blue">
                    <tr><th class="text-white"></th><th class="text-white"></th><th class="text-white pc"></th><th class="text-white"></th><th class="text-white"></th></tr>
                    </tfoot>
                </table>
              </div>

              <div class="row justify-content-center">
               <div class="col-xl-3 col-lg-3 col-md-5 col-sm-4 col-12">
                <button class="btn btn-danger" id="resultados">Ver resultados <i class='bx bxs-file-pdf'></i></button>
               </div>
              </div>
            </div>
            <div class="tab-pane fade" id="egresos" role="tabpanel" aria-labelledby="contact-tab">
                <h4>egresos</h4>
            </div>
        </div>
    </div>
    </div>

{{--- MODAL PARA MOSTRAR LISTADO DE CLIENTES ---}}
<div class="modal fade" id="modal_listado_clientes" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #90EE90">
                <h4 class="text-white">Buscar cliente</h4>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped responsive nowrap" id="lista_search_cliente" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Num.Documento</th>
                                <th>Cliente</th>
                                <th>Enviar</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger rounded salir_search_cliente"><b>Salir X</b></button>
            </div>
        </div>
    </div>
</div>

{{--- MODAL PARA CONSULTAR PRODUCTOS Y AGREGARLOS A LA CESTA ---}}
<div class="modal fade" id="modal_listado_producto_venta" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header" style="background: #6495ED">
                <h4 class="text-white">Agregar Productos <i class='bx bx-plus'></i></h4>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped responsive nowrap" id="lista_search_productos" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="d-none">ID</th>
                                <th>Agregar</th>
                                <th>Producto</th>
                                <th>Stock</th>
                                <th>Estado</th>
                                <th>Precio  {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</th>
                                <th>Empaque</th>
                                <th>Tipo</th>
                                <th>Presentación</th>
                                <th>Grupo Terapeútico</th>

                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger rounded salir_search_producto"><b>Salir X</b></button>
            </div>
        </div>
    </div>
</div>
{{--- MODAL PARA MOSTRAR LOS PRODUCTOS PARA AÑADIR A LA CESTA DE LA COMPRA ---}}
<div class="modal fade" id="modal_listado_producto_compra" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="text-white">Productos existentes <i class='bx bx-plus'></i></h4>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped responsive nowrap" id="lista_search_productos_compra" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="d-none">ID</th>
                                <th>Agregar</th>
                                <th>Producto</th>
                                <th>Proveedor</th>
                                <th>Empaque</th>
                                <th>Tipo</th>
                                <th>Precio de venta actual {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }} </th>
                                <th>Presentación</th>
                                <th>Grupo Terapeútico</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="row"  >
                    <div class="col-auto">
                        <div class="form-group">
                            <label for="producto_compra"><b>Producto a comprar </b></label>
                            <input type="text" name="producto_compra" id="producto_compra" class="form-control" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="form-group">
                            <label for="empaque_compra"><b>Empaque</b></label>
                            <input type="text" name="empaque_compra" id="empaque_compra" class="form-control" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="form-group">
                            <label for="precio_compra"><b>Precio de compra <span class="text-primary">{{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</span> <span class="text-danger">*</span></b></label>
                            <input type="text" name="precio_compra" id="precio_compra" class="form-control" placeholder="0.00">
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="form-group">
                            <label for="cantidad_compra"><b>Cantidad <span class="text-danger">*</span></b></label>
                            <input type="text" name="cantidad_compra" id="cantidad_compra" class="form-control" placeholder="0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger rounded salir_search_producto_compra"><b>Salir X</b></button>
            </div>
        </div>
    </div>
</div>
{{-- modal para reporte de productos ----}}
<div class="modal fade" id="modal_reporte_productos" data-bs-backdrop="static">
    <div class="modal-dialog">
       <div class="modal-content">
        <div class="modal-header" style="background-color: aquamarine">
            <h5>Reporte de productos por vencer</h5>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="diasvencer"><b>Días por vencer <span class="text-danger">*</span></b></label>
                <select name="diasvencer" id="diasvencer" class="form-select">
                    <option value="10">10 días</option>
                    <option value="20">20 días</option>
                    <option value="30">30 días</option>
                    <option value="40">40 días</option>
                    <option value="50">50 días</option>
                    <option value="60">60 días</option>
                    <option value="70">70 días</option>
                    <option value="80">80 días</option>
                    <option value="90">90 días</option>
                    <option value="100">100 días</option>
                    <option value="mas de 100 días">Más de 100 días</option>
                </select>
            </div>
            <div class="form-group">
                <label for="proveedor_reporte"><b>Seleccione a un proveedor <span class="text-danger">*</span></b></label>
                <select name="proveedor_reporte" id="proveedor_reporte" class="form-control"></select>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger rounded" id="cerrar_reporte_productos">Cerrar <b>X</b></button>
            <button class="btn btn-success rounded" id="ver_reporte_productos">Ver reporte</button>
        </div>
       </div>
    </div>
</div>

{{---MODAL PARA PROVEEDORES---}}
<div class="modal fade" id="modal_open_proveedores" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
       <div class="modal-content">
        <div class="modal-header" style="background-color: rgb(89, 106, 180)">
            <h5 class="text-white">Buscar proveedor</h5>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped nowrap responsive" style="width: 100%" id="tabla_buscar_proveedores">
              <thead>
                <tr>
                    <th>#</th>
                    <th class="d-none">ID</th>
                    <th class="col-2">Seleccionar</th>
                    <th>Proveedor</th>
                    <th>Contacto</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger rounded" id="cerrar_modal_buscar_proveedor">Cerrar <b>X</b></button>
        </div>
       </div>
    </div>
</div>
@endsection

@section('js')

    <script src="{{ URL_BASE }}public/js/control.js"></script>
    <script src="{{ URL_BASE }}public/js/presentacion.js"></script>
    <script src="{{ URL_BASE }}public/js/laboratorio.js"></script>
    <script src="{{ URL_BASE }}public/js/grupos.js"></script>
    <script src="{{ URL_BASE }}public/js/empaques.js"></script>
    <script src="{{ URL_BASE }}public/js/proveedor.js"></script>
    <script src="{{ URL_BASE }}public/js/productofarmacia.js"></script>
    <script src="{{ URL_BASE }}public/js/clientes.js"></script>
    <script src="{{ URL_BASE }}public/js/ventas.js"></script>
    <script src="{{ URL_BASE }}public/js/historia_ventas.js"></script>
    <script src="{{ URL_BASE }}public/js/compra.js"></script>
    <script src="{{ URL_BASE }}public/js/reportes.js"></script>
    <script>
        var RUTA = "{{ URL_BASE }}" // la url base del sistema
        var TOKEN = "{{ $this->Csrf_Token() }}";
        var PROFILE_ = "{{ $this->profile()->rol }}";
        var TablaListaTipoProductos, TablaListaEmpaques;
        var TablaListaPresentacion, TablaListaLaboratorios, TablaListaGrupos, TablaListaProveedores,TablaListaClientes,
            TablaListaProductos,TablaSearchClienteVenta,TablaSearchProductoVenta,lista_historial_ventas,TablaProductosCompra,TablaRepoProductos,
            TablaBuscarProveedores;
        var IDTIPOPRODUCTO, IDPRESENTACION, IDLABORATORIO, IDGRUPO, IDEMBALAJE, IDPROVEEDOR, IDPRODUCTO,IDCLIENTE,IDPRODUCTOCOMPRA,
        CLIENTE_VENTA_ID,PROVEEDOR_ID_COMPRA;
        var ControlBotonTipo = 'save',
            ControlBotonPresnetacion = 'save',
            ControlButtonLaboratorio = 'save',
            ControlBotonGrupo = 'save',
            ControlBotonEmbalaje = 'save',
            ControlBotonProveedor = 'save',
            ControlBotonClientes = 'save';
            ControlBotonProducto = 'save';
            var TotalPricecompra = 0.00;
        var ViewDivMontos;
        var MONEDA = "{{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}";
        var IvaData = "{{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->iva_valor : 18 }}";
        var FechaActualVenta = "{{$this->FechaActual('Y-m-d')}}";
        var CantidadInputEnter;
        $(document).ready(function() {


            let NameTipoProducto = $('#name_tipo_producto');
            let NamePresentacion = $('#name_presentacion');
            let NameCortoPresentacion = $('#name_corto_presentacion');
            let NameLaboratorio = $('#name_laboratorio');
            let DireccionLaboratorio = $('#direccion_laboratorio');
            let NameGrupoTerapeutico = $('#name_grupo');
            let NameEmbalaje = $('#name_embalaje');
            let ProveedorName = $('#proveedor_name');
            let ProveedorContacto = $('#contacto_name');
            let NameProducto = $('#nombre_producto');
            let PrecioVentaProducto = $('#precio_venta');
            let Stock = $('#stock');
            let FechaVencimiento = $('#fecha_vencimiento');
            let TipoProducto = $('#tipo_select');
            let PresentacionProducto = $('#presentacion_select');
            let LaboratorioProducto = $('#laboratorio_select');
            let GrupoProducto = $('#grupo_select');
            let EmbalajeProducto = $('#embalaje_select');
            let ProveedorProducto = $('#proveedor_select');
            let StockMinimo = $('#stock_minimo');
            let NumDocCliente = $('#num_doc');
            let NameCliente = $('#name_cliente');
            let ApellidosCliente = $('#apellidos_cliente'); 

            loading('#farmacia_card','#4169E1','chasingDots') 
            setTimeout(() => {
            
            $('#farmacia_card').loadingModal('hide');
            $('#farmacia_card').loadingModal('destroy');
                /// mostramos la vista de la pestaña por defecto
            mostrarTipoProductos();
            /** Editar tipo de productos **/
            EditarTipoProducto(TablaListaTipoProductos, '#lista_tipo_productos tbody');
            /** Eliminar tipo de producto */
            EliminarTipoProducto(TablaListaTipoProductos, '#lista_tipo_productos tbody');
            /// activar nuevamente el tipo de producto
            ActivarTipoProducto(TablaListaTipoProductos, '#lista_tipo_productos tbody');

            /** Eliminar por completo el tipo de productos**/
            DeleteConfirmTipoProducto(TablaListaTipoProductos, '#lista_tipo_productos tbody');

            if(PROFILE_ === 'Farmacia' || PROFILE_ === 'Director')
            {
              
            showProductosDeLaCesta();

            /** Listar productos para agregar a la venta **/ 
            ListarProductosParaLaVenta();
            /** Agregar productos a la cesta **/ 
             addCestaProducto(TablaSearchProductoVenta,'#lista_search_productos tbody');

             /// quitar producto de la cesta
             QuitarProductoCesta();
             modificarCantidadProductoCesta();

             getSerieVenta();
            }
            }, 1000);

            $('#tab_farmacia a').on('click', function(evento) {
                evento.preventDefault();
                const idTab = $(this)[0].id;
                if (idTab === 'tipo_producto_') {
                    ControlBotonTipo = 'save';
                    mostrarTipoProductos();
                } else {
                    if (idTab === 'presentacion_') {
                        ControlBotonPresnetacion = 'save';
                        showPresentaciones();
                        /*Editar la presentación*/
                        editarPresentacion(TablaListaPresentacion, '#lista_presentacion tbody');
                        /*Eliminar la presentación*/
                        Eliminar(TablaListaPresentacion, '#lista_presentacion tbody');
                        /*Activar la presentación*/
                        Activar(TablaListaPresentacion, '#lista_presentacion tbody');
                        /** Eliminar por completo a la presentación **/
                        DeleteConfirmPresentacion(TablaListaPresentacion, '#lista_presentacion tbody');
                    } else {
                        if (idTab === 'laboratorios_') {
                            ControlButtonLaboratorio = 'save';
                            showLaboratorios();
                            /** Editar laboratorio */
                            editarLaboratorio(TablaListaLaboratorios, '#lista_laboratorios tbody');
                            /** Eliminar laboratorios*/
                            EliminarLaboratorio(TablaListaLaboratorios, '#lista_laboratorios tbody');
                            /** Activar laboratorio*/
                            ActivarLaboratorio(TablaListaLaboratorios, '#lista_laboratorios tbody');
                            /*Eliminar por completo de la base de datos a laboratorios*/
                            DeleteConfirmLaboratorio(TablaListaLaboratorios, '#lista_laboratorios tbody');
                        } else {
                            if (idTab === 'grupos_') {
                                ControlBotonGrupo = 'save';
                                mostrarGruposTerapeuticos();

                                /** Editar Grupo terapeutico**/
                                EditarGrupo(TablaListaGrupos, '#lista_grupo_terapeuticos tbody');
                                /*Eliminar grupo terapeutico*/
                                ConfirmEliminadoGrupo(TablaListaGrupos, '#lista_grupo_terapeuticos tbody');
                                /// activar grupo terapeútico
                                ActivateGrupo(TablaListaGrupos, '#lista_grupo_terapeuticos tbody');
                                /*Confirmar eliminado de los grupos terapeuticos*/
                                DeleteConfirmGrupos(TablaListaGrupos, '#lista_grupo_terapeuticos tbody');
                            } else {
                                if (idTab === 'embalaje_') {
                                    ControlBotonEmbalaje = 'save';
                                    mostrarEmpaques();
                                    /** Editar embalaje **/
                                    EditarEmpaque(TablaListaEmpaques, '#lista_embalajes tbody');
                                    /** Confirma eliminado del empaque**/
                                    ConfirmEliminadoEmpaque(TablaListaEmpaques, '#lista_embalajes tbody');
                                    /*Actiavar empaques*/
                                    ActivateEmpaque(TablaListaEmpaques, '#lista_embalajes tbody');
                                    /** Confirmar eliminado de empaques o embalajes*/
                                    DeleteConfirmEmbalajes(TablaListaEmpaques, '#lista_embalajes tbody');
                                } else {
                                    if (idTab === 'proveedores_') {
                                        $('#proveedor_name').val("");
                                        $('#contacto_name').val("");
                                        $('#telefono').val("");
                                        $('#correo').val("");
                                        $('#direccion').val("");
                                        $('#paginaweb').val("");
                                        ControlBotonProveedor = 'save';
                                        mostrarProveedores();
                                        /** Editar proveedores**/
                                        EditarProveedor(TablaListaProveedores, '#lista_proveedores tbody');
                                        /*Confirmar borrado de proveedores*/
                                        DeleteConfirmProveedor(TablaListaProveedores,
                                            '#lista_proveedores tbody');
                                        /** Confirmar eliminado del proveedor*/
                                        ConfirmEliminadoProveedor(TablaListaProveedores,
                                            '#lista_proveedores tbody');
                                        /*Activar proveedores*/
                                        ActivateProveedor(TablaListaProveedores,
                                        '#lista_proveedores tbody');
                                    } else {
                                        if (idTab === 'productos_') {
                                            $('#form_productos')[0].reset();
                                            ControlBotonProducto = 'save';
                                            showProducto();
                                            loading('#farmacia_card', '#4169E1', 'chasingDots');
                                            setTimeout(() => {
                                                $('#farmacia_card').loadingModal('hide');
                                                $('#farmacia_card').loadingModal('destroy');
                                                /** mostrar en los combos
                                                 * 1 mostrar tipo de productos*/
                                                mostrarTipoProductoCombo();
                                                //mostrar presentaciones
                                                mostrarPresentacionCombo();
                                                /// mostrar laboratorios
                                                mostrarLaboratoriosCombo();
                                                /// mostrar grupo terapeutico
                                                mostrarGruposTerapeuticosCombo();
                                                /// mostrar embalajes
                                                mostrarEmpaquesCombo();
                                                /** Mostrar proveedores*/
                                                mostrarProveedoresCombo();
                                                mostrarProveedoresComboReporte();

                                                /** acciones de la tabla productos*/
                                                //editar productos
                                                EditarProductos(TablaListaProductos,
                                                    '#lista_productos tbody');
                                                /*Confirmar borrado de productos*/
                                                ConfirmarBorradoProductos(TablaListaProductos,
                                                    '#lista_productos tbody');

                                                /** Confirmar eliminado de la listad de productos*/ 
                                                EliminadoConfirmProductos(TablaListaProductos,'#lista_productos tbody');
                                                /*Actiavr productos*/
                                                ActivarProductos(TablaListaProductos,'#lista_productos tbody');
                                            }, 200);
                                        }else{
                                            if(idTab === 'clientes_')
                                            {
                                                $('#form_clientes')[0].reset();
                                                ControlBotonClientes = 'save';
                                                mostrarClientes();
                                                $('#num_doc').focus();
                                                /** Editar clientes*/ 
                                                EditarClientes(TablaListaClientes,'#lista_clientes tbody');
                                                /** Confirmar borrado del clientes*/ 
                                                ConfirmarBorradoClientes(TablaListaClientes,'#lista_clientes tbody');
                                                /** Confirmar eliminado de clientes*/ 
                                                EliminadoConfirmClientes(TablaListaClientes,'#lista_clientes tbody');
                                                // Activar clientes 
                                                ActivarClientes(TablaListaClientes,'#lista_clientes tbody');
                                            }else{
                                                if(idTab === 'save_ventas_')
                                                {
                                                    getSerieVenta();
                                                }else{
                                                  if(idTab === 'historia_ventas_')
                                                  {
                                                    mostrarHistoriaVentas("{{$this->FechaActual('Y-m-d')}}");
                                                    printTicketDeVenta();
                                                  }else{
                                                    if(idTab === 'compras_')
                                                    {
                                                        getSerieCompra();
                                                        showProductosParaLaCompra();
                                                        addCestaProductoCompra();
                                                        showProductosDeLaCestaCompra();
                                                        QuitarProductoCestaCompra();
                                                        modificarCantidadProductoCestaCompra();
                                                        modificarPriceProductoCestaCompra();
                                                    }else{
                                                        if(idTab === 'reporte_ventas_'){
                                                            showRepoProductos($('#fi').val(),$('#ff').val());
                                                        }
                                                    }
                                                  }
                                                }
                                            } 
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                $(this).tab("show")
            });

            $('#save_tipo_producto').click(function(evento) {
                evento.preventDefault();
                if (NameTipoProducto.val().trim().length == 0) {
                    NameTipoProducto.focus();
                } else {

                    if (ControlBotonTipo === 'save') {
                        saveTipoProducto();
                    } else {
                        UpdateTipoProducto(IDTIPOPRODUCTO);
                    }
                }
            });

            /// abrir el explorador de archivos
            $('#importar_productos').click(function(evento){
                evento.preventDefault();
                if($('#excel_productos').val().trim().length >0 )
                {
                 loading('#farmacia_card','#4169E1','chasingDots');

                setTimeout(() => {
                 $('#farmacia_card').loadingModal('hide');
                 $('#farmacia_card').loadingModal('destroy');
                 importDataProductosToExcel();
                }, 1000);
                }else{
                Swal.fire({
                    title:"Mensaje del sistema!",
                    text:"Seleccione un archivo excel!",
                    icon:"error"
                });
                }
            });

            $('#reporte_productos').click(function(event){
                event.preventDefault();
                $('#modal_reporte_productos').modal("show");
            });
            
            $('#ver_reporte_productos').click(function(event){
                event.preventDefault();
                window.open(RUTA+"app/farmacia/productos/por/vencer?dias="+$('#diasvencer').val()+"&&v="+$('#proveedor_reporte').val(),"_blank")
            });
            $('#cerrar_reporte_productos').click(function(event){
                event.preventDefault();
                $('#modal_reporte_productos').modal("hide");
            });

            $('#save_presentacion').click(function(evento) {
                evento.preventDefault();
                if (NamePresentacion.val().trim().length == 0) {
                    NamePresentacion.focus();
                } else {
                    if (NameCortoPresentacion.val().trim().length == 0) {
                        NameCortoPresentacion.focus();
                    } else {
                        if (ControlBotonPresnetacion === 'save') {
                            save('form_presentacion', RUTA);
                        } else {
                            modificar(IDPRESENTACION);
                        }
                    }
                }

            });

            $('#save_laboratorio').click(function(evento) {
                evento.preventDefault();
                if (NameLaboratorio.val().trim().length == 0) {
                    NameLaboratorio.focus();
                } else {
                    if (ControlButtonLaboratorio === 'save') {
                        saveLaboratorio();
                    } else {
                        updateLaboratorio(IDLABORATORIO);
                    }
                }
            });

            $('#save_grupo').click(function(evento) {
                evento.preventDefault();

                if (NameGrupoTerapeutico.val().trim().length == 0) {
                    NameGrupoTerapeutico.focus();
                } else {
                    if (ControlBotonGrupo === 'save') {
                        saveGrupo();
                    } else {
                        updateGrupo(IDGRUPO);
                    }
                }
            });
            $('#save_embalaje').click(function(evento) {
                evento.preventDefault();
                if (NameEmbalaje.val().trim().length == 0) {
                    NameEmbalaje.focus();
                } else {
                    if (ControlBotonEmbalaje === 'save') {
                        saveEmbalaje();
                    } else {
                        updateEmbalaje(IDEMBALAJE);
                    }
                }
            });

            $('#save_proveedor').click(function(evento) {
                evento.preventDefault();
                if (ProveedorName.val().trim().length == 0) {
                    ProveedorName.focus();
                } else {
                    if (ProveedorContacto.val().trim().length == 0) {
                        ProveedorContacto.focus();
                    } else {
                        if (ControlBotonProveedor === 'save') {
                            saveProveedor();
                        } else {
                            updateProveedor(IDPROVEEDOR);
                        }
                    }
                }
            });

            $('#save_producto').click(function(evento) {
                evento.preventDefault();

                if (NameProducto.val().length == 0) {

                    NameProducto.focus();
                } else {
                    if (PrecioVentaProducto.val().trim().length == 0) {
                        PrecioVentaProducto.focus();
                    } else {
                        if (Stock.val().trim().length == 0) {
                            Stock.focus();
                        } else {
                            if (StockMinimo.val().trim().length == 0) {
                                StockMinimo.focus();
                            } else {
                                if (ControlBotonProducto === 'save') {
                                    registrarProducto();
                                } else {
                                    ModificarProducto(IDPRODUCTO);
                                }
                            }
                        }
                    }
                }

            });
            
            $('#save_cliente').click(function(evento){
                evento.preventDefault();

                if(NumDocCliente.val().trim().length == 0)
                {
                    NumDocCliente.focus();
                }else{
                    if(NameCliente.val().trim().length == 0)
                    {
                        NameCliente.focus();
                    }else{
                        if(ApellidosCliente.val().trim().length == 0)
                        {
                            ApellidosCliente.focus();
                        }else{
                           if(ControlBotonClientes == 'save')
                           {
                            saveCliente();
                           }else{
                             /*Modificar datos del cliente*/
                             updateCliente(IDCLIENTE);
                           }
                        }
                    }
                }
            });

            $('#search_cliente').click(function(){
             /// abrimos modal para buscar cliente para la venta
             $('#modal_listado_clientes').modal("show");
              /** Listar clientes para la venta **/ 
              ListarClientesParaLaVenta();

              /** Seleccionar cliente*/ 
              SeleccionarCliente(TablaSearchClienteVenta,'#lista_search_cliente tbody');
             });

             $('.salir_search_cliente').click(function(){
                $('#modal_listado_clientes').modal("hide");
             });
             $('.salir_search_producto').click(function(){
                $('#modal_listado_producto_venta').modal("hide");
             });

             $('#resultados').click(function(){
 
               window.open(RUTA+"resultados?fi="+$('#fi').val()+"&&ff="+$('#ff').val(),"_target");
             });

             /// Cancelar la venta
             $('.cancelar_venta').click(function(){
                CLIENTE_VENTA_ID = null;
                $('#documento_venta').val("");
                $('#cliente_venta').val("Público en general");
                $('#fecha_emision_venta').val("{{$this->FechaActual('Y-m-d')}}");
                $('#igv_venta').val("0.00");$('#total_venta').val("0.00");$('#sub_total_venta').val("0.00");
                $('#monto_recibido').val("");$('#vuelto').val("0.00");$('#proveedor_compra').val("");
                CancelVentaDetalle();
                
             });
              /// Cancelar la venta
              $('.cancelar_compra').click(function(){
               
                $('#fecha_emision_compra').val("{{$this->FechaActual('Y-m-d')}}");
                $('#igv_compra').val("0.00");$('#total_compra').val("0.00");$('#sub_total_compra').val("0.00");
                $('#proveedor_compra').val("");
                CancelCompraDetalle();
                
             });

             $('#agreagr_producto_venta').click(function(){
                
                $('#modal_listado_producto_venta').modal("show");
                ListarProductosParaLaVenta();
             });

             /** Guardar la venta **/ 
             $('#save_venta').click(function(){
                
               if($('#lista_detalle_venta_body tr').length >= 1)
               {
                 if($('#monto_recibido').val().trim().length == 0)
                 {
                    $('#monto_recibido').focus();
                 }else{
                    if($('#vuelto').val().trim().length == 0)
                    {
                       $('#vuelto').focus();
                    }else{
                       saveVentaFarmacia();
                    }
                 }
               }else{
                 Swal.fire({
                    title:"Mensaje del sistema!",
                    text:"Para completar la venta, debe de añadir como mínimo 1 producto a la cesta!",
                    icon:"error"
                 });
               }
             });
             
             /** Guardar la venta **/ 
             $('#save_compra').click(function(){
                
                if($('#lista_detalle_compra_body tr').length >= 1)
                {
                    saveCompraFarmacia();
                }else{
                  Swal.fire({
                     title:"Mensaje del sistema!",
                     text:"Para completar la compra, debe de añadir como mínimo 1 producto a la cesta!",
                     icon:"error"
                  });
                }
              });

              $('#ff').change(function(){
                showRepoProductos($('#fi').val(),$(this).val());
              });

              $('#fi').change(function(){
                showRepoProductos($(this).val(),$('#ff').val());
              });
 

             /// evento change para mostrar historial de ventas por fecha
             $('#fecha_venta_historial').change(function(){
                
                mostrarHistoriaVentas($(this).val());
             });

             /// abrir modal para ver los productos existentes para la compra
             $('#agregar_producto_compra').click(function(){
                $('#modal_listado_producto_compra').modal("show")
             });

             $('.salir_search_producto_compra').click(function(){
                $('#modal_listado_producto_compra').modal("hide");
                
                $('#precio_compra').val("");$('#cantidad_compra').val("");
             });


             $('#open_proveedor_compra').click(function(){
                $('#modal_open_proveedores').modal("show");
                BuscarProveedores();
                SeleccionarProveedor();
             });

             $('#cerrar_modal_buscar_proveedor').click(function(){
                $('#modal_open_proveedores').modal("hide");
             });
        });

        function mostrarTipoProductos() {
            TablaListaTipoProductos = $('#lista_tipo_productos').DataTable({
                language: SpanishDataTable(),
                retrieve: true,
                responsive: true,
                processing: true,
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
                ajax: {
                    url: RUTA + "app/farmacia/mostrar_tipo_productos/si",
                    method: "GET",
                    dataSrc: "response",
                },
                columns: [{
                        "data": "name_tipo_producto"
                    },
                    {
                        "data": "name_tipo_producto",
                        render: function(tipo) {
                            return tipo.toUpperCase();
                        }
                    },
                    {
                        "data": "deleted_at",
                        render: function(eliminado_at) {
                            if (eliminado_at == null) {
                                return `<button class='btn btn-danger rounded btn-sm' id='eliminar_tipo'><i class='bx bx-x'></i></button>
                <button class='btn btn-warning rounded btn-sm' id='editar_tipo'><i class='bx bx-pencil' ></i></button>
                <button class='btn btn-info rounded btn-sm' id='delete_tipo'><i class='bx bx-trash'></i></button>`;
                            }

                            return ` <button class='btn btn-success rounded btn-sm' id='activar_tipo'><i class='bx bx-check'></i></button>
                            <button class='btn btn-info rounded btn-sm' id='delete_tipo'><i class='bx bx-trash'></i></button>`;
                        }
                    }
                ]
            }).ajax.reload();

            /*=========================== ENUMERAR REGISTROS EN DATATABLE =========================*/
            TablaListaTipoProductos.on('order.dt search.dt', function() {
                TablaListaTipoProductos.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        }

        /// guardar los tipos de productos de la farmacia
        function saveTipoProducto() {
            $.ajax({
                url: RUTA + "app/farmacia/save_tipo_producto",
                method: "POST",
                data: $('#form_tipo_producto').serialize(),
                dataType: "json",
                success: function(response) {

                    if (response.response == 1) {
                        Swal.fire({
                            title: "Mensaje del sistema!",
                            text: "Tipo producto registrado correctamente 😁😎😀!",
                            icon: "success"
                        }).then(function() {
                            $('#name_tipo_producto').focus();
                            $('#name_tipo_producto').val("");
                            mostrarTipoProductos();

                        });
                    } else {
                        if (response.response === 'existe') {
                            Swal.fire({
                                title: "Mensaje del sistema!",
                                text: "No se permite duplicidad en tipo de productos !",
                                icon: "warning"
                            }).then(function() {
                                $('#name_tipo_producto').focus();
                                $('#name_tipo_producto').val("");
                            });
                        } else {
                            Swal.fire({
                                title: "Mensaje del sistema!",
                                text: "Error al registrar tipo de producto😔😢 !",
                                icon: "error"
                            });
                        }
                    }
                }
            })
        }

        /// modificar datos de tipo de productos
        function UpdateTipoProducto(id) {
            $.ajax({
                url: RUTA + "app/farmacia/update/" + id,
                method: "POST",
                data: $('#form_tipo_producto').serialize(),
                dataType: "json",
                success: function(response) {

                    if (response.response == 1) {
                        Swal.fire({
                            title: "Mensaje del sistema!",
                            text: "Tipo producto modificado correctamente 😁😎😀!",
                            icon: "success"
                        }).then(function() {
                            $('#name_tipo_producto').focus();
                            $('#name_tipo_producto').val("");
                            ControlBotonTipo = 'save';
                            mostrarTipoProductos();
                        });
                    } else {
                        Swal.fire({
                            title: "Mensaje del sistema!",
                            text: "Error al registrar tipo de producto😔😢 !",
                            icon: "error"
                        });
                    }
                }
            })
        }
        /// editar los tipos de productos
        function EditarTipoProducto(Tabla, Tbody) {
            $(Tbody).on('click', '#editar_tipo', function() {
                /// obtenemos la fila seleccionada
                let fila = $(this).parents('tr');

                if (fila.hasClass('child')) {
                    fila = fila.prev();
                }

                ControlBotonTipo = 'update';
                let Data = Tabla.row(fila).data();
                IDTIPOPRODUCTO = Data.id_tipo_producto;
                $('#name_tipo_producto').focus();
                $('#name_tipo_producto').val(Data.name_tipo_producto);
                $('#name_tipo_producto').select();
            });
        }

        /// inhabilitar tipos de productos
        function EliminarTipoProducto(Tabla, Tbody) {
            $(Tbody).on('click', '#eliminar_tipo', function() {
                /// obtenemos la fila seleccionada
                let fila = $(this).parents('tr');

                if (fila.hasClass('child')) {
                    fila = fila.prev();
                }

                ControlBotonTipo = 'update';
                let Data = Tabla.row(fila).data();
                let TipoProducto = Data.name_tipo_producto;
                IDTIPOPRODUCTO = Data.id_tipo_producto;
                Swal.fire({
                    title: "Estas seguro de eliminar al tipo producto " + TipoProducto + " ?",
                    text: "Al eliminar el tipo de producto se quitará automaticamente de la lista!",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, eliminar!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        ProcesoHabilitadoInhabilitadoTipoProducto(IDTIPOPRODUCTO, 'i');
                    }
                });
            });
        }
        /// habilitar nuevamente el tipo de producto
        function ActivarTipoProducto(Tabla, Tbody) {
            $(Tbody).on('click', '#activar_tipo', function() {
                /// obtenemos la fila seleccionada
                let fila = $(this).parents('tr');

                if (fila.hasClass('child')) {
                    fila = fila.prev();
                }

                ControlBotonTipo = 'update';
                let Data = Tabla.row(fila).data();
                let TipoProducto = Data.name_tipo_producto;
                IDTIPOPRODUCTO = Data.id_tipo_producto;

                ProcesoHabilitadoInhabilitadoTipoProducto(IDTIPOPRODUCTO, 'h');

            });
        }

        // Proceso para habilitar e inhabilitar los tipos de productos
        function ProcesoHabilitadoInhabilitadoTipoProducto(id, condition) {
            $.ajax({
                url: RUTA + "app/farmacia/habilitar_e_inhabilitar/tipo_producto/" + id + "/" + condition,
                method: "POST",
                data: {
                    _token: TOKEN
                },
                dataType: "json",
                success: function(response) {
                    if (response.response == 1) {
                        Swal.fire({
                            title: "Mensaje del sistema!",
                            text: condition === 'i' ?
                                "Tipo producto quitado de la lista correctamente" :
                                "Tipo producto activado nuevamente",
                            icon: "success"
                        }).then(function() {
                            mostrarTipoProductos();
                        });
                    } else {
                        Swal.fire({
                            title: "Mensaje del sistema!",
                            text: "Error al realizar el proceso de eliminado o activación del tipo de producto",
                            icon: "error"
                        });
                    }
                }
            });
        }
        /** Eliminar tipo de producto*/
        function DeleteConfirmTipoProducto(Tabla, Tbody) {
            $(Tbody).on('click', '#delete_tipo', function() {
                let fila = $(this).parents('tr');

                if (fila.hasClass('child')) {
                    fila = fila.prev();
                }

                let Data = Tabla.row(fila).data();

                IDTIPOPRODUCTO = Data.id_tipo_producto;
                Swal.fire({
                    title: "Estas seguro de borrar al tipo producto " + Data.name_tipo_producto + "?",
                    text: "Al eliminarlo, se borrará de la base de datos por completo!",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, eliminar!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        DeleteTipoProducto(IDTIPOPRODUCTO);
                    }
                });
            });
        }

        /*Eliminar el tipo producto de la base de datos*/
        function DeleteTipoProducto(id) {
            $.ajax({
                url: RUTA + "app/farmacia/tipo_producto/delete/" + id,
                method: "POST",
                data: {
                    _token: TOKEN
                },
                dataType: 'json',
                success: function(response) {
                    if (response.response == 1) {
                        Swal.fire({
                            title: "Mensaje del sistema!",
                            text: "Tipo de producto eliminado por completo!",
                            icon: "success"
                        }).then(function() {
                            mostrarTipoProductos();
                        });
                    } else {
                        Swal.fire({
                            title: "Mensaje del sistema!",
                            text: "Error al eliminar tipo de producto!",
                            icon: "error"
                        })
                    }
                },
                error: function(err) {
                    Swal.fire({
                        title: "Mensaje del sistema!",
                        text: "Error al eliminar el tipo de producto seleccionado!",
                        icon: "error"
                    });
                }
            });
        }
    </script>
@endsection
