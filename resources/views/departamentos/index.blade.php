@extends($this->Layouts("dashboard"))

@section("title_dashboard","Departamento")
@section('css')
    <style>
       #tabla_dep>thead>tr>th
        {
            background-color: #4169E1;
            color: #fff;
        }
        #tabla_dep_eliminados>thead>tr>th
        {
            background-color: #F8F8FF;
            color: #000;
        }
        #tabla_prov_eliminados>thead>tr>th
        {
            background-color: #F8F8FF;
            color: #000;
        }
        #tabla_prov>thead>tr>th
        {
            background-color: #4169E1;
            color: #fff;
        }
        #tabla_distrito>thead>tr>th
        {
            background-color: #4169E1;
            color: #fff;
        }
    </style>
@endsection
@section('contenido')
<div class="col-12" id="car">
  <div class="nav-align-top mb-4">
    <ul class="nav nav-tabs nav-fill" role="tablist" id="tab_ciudades">
      <li class="nav-item">
        <button
          type="button"
          class="nav-link active"
          role="tab"
          data-bs-toggle="tab"
          data-bs-target="#navs-justified-home"
          aria-controls="navs-justified-home"
          aria-selected="true"
          style="color: #4169E1"
          id="departamento_view"
        >
        <i class='bx bxs-buildings'></i> Pais
        </button>
      </li>
      <li class="nav-item">
        <button
          type="button"
          class="nav-link"
          role="tab"
          data-bs-toggle="tab"
          data-bs-target="#navs-justified-profile"
          aria-controls="navs-justified-profile"
          aria-selected="false"
          style="color:#FF4500"
          id="provincia_view"
        >
        Provincias
        </button>
      </li>
      <li class="nav-item">
        <button
          type="button"
          class="nav-link"
          role="tab"
          data-bs-toggle="tab"
          data-bs-target="#navs-justified-messages"
          aria-controls="navs-justified-messages"
          aria-selected="false"
          style="color:#0f1413"
          id="distrito_view"
        >
          Ciudad
        </button>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-7 col-12">
          <button class="btn_blue" style="width: 100%" id="view_departamentos_eliminados"><b>Pais eliminado <i class='bx bxs-show'></i></b></button>
        </div>
         <div class="table-responsive">
          <table class="table table-bordered table-striped responsive nowrap" id="tabla_dep" style="width: 100%">
            <thead>
              <tr>
                <th>#</th>
                <th>PAIS</th>
                <th>ACCIÓN</th>
              </tr>
            </thead>
          </table>
         </div>
      </div>
      <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-7 col-12">
          <button class="btn_blue" style="width: 100%" id="view_provincias_eliminados"><b>Provincias eliminados <i class='bx bxs-show'></i></b></button>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered responsive table-striped nowrap" id="tabla_prov" style="width: 100%">
            <thead>
              <tr>
                <th>#</th>
                <th>PROVINCIA</th>
                <th>PAIS</th>
                <th>ACCIÓN</th>
              </tr>
            </thead>
          </table>
         </div>
          
      </div>
    
      <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-7 col-12">
          <button class="btn_blue" style="width: 100%" id="view_distritos_eliminados"><b>Distritos eliminados <i class='bx bxs-show'></i></b></button>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped responsive nowrap" id="tabla_distrito" style="width: 100%">
            <thead>
              <tr>
                <th>#</th>
                <th>CIUDAD-PROVINCIA-PAIS</th>
                <th>ACCIÓN</th>
              </tr>
            </thead>
          </table>
         </div>
      </div>
    </div>
  </div>
  </div>

  {{--- EDITAR PAIS--}}
  <div class="modal fade" id="modal_editar_dep" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg bg-warning">
          <p class="h4 text-white">Editar pais</p>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="departamento"><b>PAIS (*)</b></label>
            <input type="text" class="form-control" placeholder="Nombre departamento..." id="departamento">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-rounded btn-success" id="update_dep"><i class='bx bx-save' ></i> Guardar</button>
          <button class="btn btn-rounded btn-danger" id="cancel_dep"><i class='bx bx-x' ></i> Cancelar</button>
        </div>
      </div>
    </div>
  </div>

   {{--- DEPARTAMENTOS ELIMINADOS--}}
   <div class="modal fade" id="modal_dep_eliminados" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header bg bg-info">
          <p class="h5 text-white">PAIS eliminados</p>
        </div>

        <div class="modal-body">
          <div class="alert alert-success" id="mensaje_dep_eliminados" style="display: none">
            <span class="text-success"><b>PAIS habilitado correctamente 😁😎</b></span>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-striped responsive nowrap" id="tabla_dep_eliminados" style="width: 100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>PAIS</th>
                  <th>ACCIÓN</th>
                </tr>
              </thead>
            </table>
           </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-rounded btn-danger" id="cancel_dep_eliminados"><i class='bx bx-x' ></i> Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  {{---MODAL PARA EDITAR LAS PROVINCIAS---}}
  <div class="modal fade" id="modal_editar_provincia" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg bg-warning">
          <p class="h4 text-white">Editar provincia</p>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="provincia"><b>Provincia (*)</b></label>
            <input type="text" class="form-control" placeholder="Nombre provincia..." id="provincia">
          </div>
          <div class="form-group">
            <label for="dep_show"><b>Departamento (*)</b></label>
            <select name="dep_show" id="dep_show" class="form-select"></select>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-rounded btn-success" id="update_prov"><i class='bx bx-save' ></i> Guardar</button>
          <button class="btn btn-rounded btn-danger" id="cancel_prov"><i class='bx bx-x' ></i> Cancelar</button>
        </div>
      </div>
    </div>
  </div>
  {{--- VER PROVINCIAS ELIMINADOS----}}
  <div class="modal fade" id="modal_prov_eliminados" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header bg bg-info">
          <p class="h5 text-white">Provincias eliminados</p>
        </div>

        <div class="modal-body">
          <div class="alert alert-success" id="mensaje_prov_eliminados" style="display: none">
            <span class="text-success"><b>Provincia habilitado correctamente 😁😎</b></span>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-striped responsive nowrap" id="tabla_prov_eliminados" style="width: 100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>PROVINCIA</th>
                  <th>DEPARTAMENTO</th>
                  <th>ACCIÓN</th>
                </tr>
              </thead>
            </table>
           </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-rounded btn-danger" id="cancel_prov_eliminados"><i class='bx bx-x' ></i> Cerrar</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script>
  var RUTA = "{{URL_BASE}}" // la url base del sistema
  var TOKEN = "{{$this->Csrf_Token()}}"
</script>
<script src="{{URL_BASE}}public/js/control.js"></script>
<script>
  var TablaDepartamento;
  var TablaDepartamentoEliminados;
  var TablaProvincia;
  var TablaDistrito;
  var TablaProvinciaEliminados;
  var ID_DEP,ID_PROV;

  $(document).ready(function(){

    /// inicializando datos 

    let Departamento_Text = $('#departamento');let Provincia = $('#provincia');
    let Departamento_select = $('#dep_show');

    showDepartamentosExistentes();
  

    /// abrimos el modal de editar
    editarDepartamento(TablaDepartamento,'#tabla_dep tbody');

    cancelEdicionDepartamento(TablaDepartamento,'#tabla_dep tbody');


    $('#tab_ciudades button').click(function(){
       const valor_Id = $(this)[0].id;
       
       if(valor_Id === 'departamento_view')
       {
        showDepartamentosExistentes();
       }
       else
       {
        if(valor_Id === 'provincia_view')
        {
          showProvinciasExistentes();

          EditarProvincia(TablaProvincia,'#tabla_prov tbody');
          EliminarListaProvincia(TablaProvincia,'#tabla_prov tbody');
        }
        else
        {
          showDistritosExistentes();
        }
       }
    });
    /// cancelar la edición de departamentos
    $('#cancel_dep').click(function(){
      $('#modal_editar_dep').modal("hide");
    });
    $('#cancel_prov').click(function(){
      $('#modal_editar_provincia').modal("hide");
    });
    $('#cancel_dep_eliminados').click(function(){
      $('#modal_dep_eliminados').modal("hide");
      $('#mensaje_dep_eliminados').hide();
      showDepartamentosExistentes();
    });
    $('#cancel_prov_eliminados').click(function(){
      $('#modal_prov_eliminados').modal("hide");
      $('#mensaje_prov_eliminados').hide();
      showProvinciasExistentes();
    });

    /// guardar cambios 
    $('#update_dep').click(function(){
      updateDataDepartamento(ID_DEP,Departamento_Text)
    });

    $('#update_prov').click(function(){
      updateProvincia(ID_PROV,Provincia.val(),Departamento_select.val());
    });

    /// ver departamentos eliminados
    $('#view_departamentos_eliminados').click(function(){
      showDepartamentosEliminados();
      $('#modal_dep_eliminados').modal("show");


      ActualizarDepartamento(TablaDepartamentoEliminados,'#tabla_dep_eliminados tbody');
    });

    /// mostrar las provincias eliminados
    $('#view_provincias_eliminados').click(function(){
       showProvinciasEliminados();
      $('#modal_prov_eliminados').modal("show");
      ActivarProvincia(TablaProvinciaEliminados,'#tabla_prov_eliminados tbody');
    });
  });
 
  function showDepartamentosEliminados()
  {
    TablaDepartamentoEliminados =$('#tabla_dep_eliminados').DataTable({
      retrieve:true,
      language:SpanishDataTable(),
      processing: true,
      "columnDefs": [{
      "searchable": false,
      "orderable": false,
      "targets": 0
    }],
    ajax:{
        url:RUTA+"departamento/eliminados?token_="+TOKEN,
        method:"GET",
        dataSrc:"response"
      },
      columns:[
        {"data":"name_departamento"},
        {"data":"name_departamento",render:function(dep){return dep.toUpperCase();}},
        {"defaultContent":`
        <div class="row">
         <div class="col-xl-3 col-lg-3 col-md-4 col-12 m-xl-0 m-lg-0 m-md-0 m-1">
           <button class="btn btn-rounded btn-success btn-sm" id="activar_dep"><i class='bx bx-check'></i></button>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-12 m-xl-0 m-lg-0 m-md-0 m-1">
           <button class="btn btn-rounded btn-danger btn-sm" id="destroy_dep"><i class='bx bx-down-arrow-alt'></i></button>
          </div>
        </div>
        `}
      ],
    }).ajax.reload(null,false);

    TablaDepartamentoEliminados.on( 'order.dt search.dt', function () {
    TablaDepartamentoEliminados.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    });
  }).draw();

  }
  /// método para mostrar los departamentos existentes
  function showDepartamentosExistentes()
  {
    TablaDepartamento =$('#tabla_dep').DataTable({
      retrieve:true,
      language:SpanishDataTable(),
      processing:true,
      "columnDefs": [{
      "searchable": false,
      "orderable": false,
      "targets": 0
    }],
      ajax:{
        url:RUTA+"departamento/mostrar?token_="+TOKEN,
        method:"GET",
        dataSrc:"response"
      },
      columns:[
        {"data":"name_departamento"},
        {"data":"name_departamento",render:function(dep){return dep.toUpperCase();}},
        {"defaultContent":`
        <div class="row">
         <div class="col-xl-2 col-lg-2 col-md-4 col-12 m-xl-0 m-lg-0 m-md-0 m-1">
           <button class="btn btn-rounded btn-outline-warning btn-sm" id="editar_dep"><i class='bx bxs-edit-alt'></i></button>
          </div>
          <div class="col-xl-2 col-lg-2 col-md-4 col-12 m-xl-0 m-lg-0 m-md-0 m-1">
           <button class="btn btn-rounded btn-outline-danger btn-sm" id="ocultar_departamento"><i class='bx bx-x'></i></button>
          </div>
        </div>
        `}
      ],
    }).ajax.reload();

    TablaDepartamento.on( 'order.dt search.dt', function () {
    TablaDepartamento.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    });
  }).draw();

  }

  /// método para mostrar las provincias existentes
  function showProvinciasExistentes()
  {
    TablaProvincia = $('#tabla_prov').DataTable({
      retrieve:true,
      language:SpanishDataTable(),
      processing:true,
      "columnDefs": [{
      "searchable": false,
      "orderable": false,
      "targets": 0
    }],
      ajax:{
        url:RUTA+"/provincia/mostrartodo?token_="+TOKEN,
        method:"GET",
        dataSrc:"response",
      },
      columns:[
        {"data":"name_provincia",render:function(prov){return prov.toUpperCase()}},
        {"data":"name_provincia",render:function(prov){return prov.toUpperCase()}},
        {"data":"name_departamento",render:function(dep){return dep.toUpperCase()}},
        {"defaultContent":`
        <div class="row">
         <div class="col-xl-3 col-lg-3 col-md-4 col-12 m-xl-0 m-lg-0 m-md-0 m-1">
           <button class="btn btn-rounded btn-outline-warning btn-sm" id="editar_prov"><i class='bx bxs-edit-alt'></i></button>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-4 col-12 m-xl-0 m-lg-0 m-md-0 m-1">
           <button class="btn btn-rounded btn-outline-danger btn-sm" id="ocultar_prov"><i class='bx bx-x'></i></button>
          </div>
        </div>
        `}
      ]
    }).ajax.reload();

    TablaProvincia.on( 'order.dt search.dt', function () {
    TablaProvincia.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    });
  }).draw();
  }

  /// ver provincias eliminados
  function showProvinciasEliminados()
  {
    TablaProvinciaEliminados = $('#tabla_prov_eliminados').DataTable({
      retrieve:true,
      language:SpanishDataTable(),
      processing:true,
      "columnDefs": [{
      "searchable": false,
      "orderable": false,
      "targets": 0
    }],
      ajax:{
        url:RUTA+"/provincia/mostrartodo/eliminados?token_="+TOKEN,
        method:"GET",
        dataSrc:"response",
      },
      columns:[
        {"data":"name_provincia",render:function(prov){return prov.toUpperCase()}},
        {"data":"name_provincia",render:function(prov){return prov.toUpperCase()}},
        {"data":"name_departamento",render:function(dep){return dep.toUpperCase()}},
        {"defaultContent":`
        <div class="row">
         <div class="col-xl-4 col-lg-4 col-md-5 col-12 m-xl-0 m-lg-0 m-md-0 m-1">
           <button class="btn btn-rounded btn-outline-success btn-sm" id="habilitar_prov"><i class='bx bx-check'></i></button>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-5 col-12 m-xl-0 m-lg-0 m-md-0 m-1">
           <button class="btn btn-rounded btn-outline-danger btn-sm" id="delete_prov"><i class='bx bx-x'></i></button>
          </div>
        </div>
        `}
      ]
    }).ajax.reload();

    TablaProvinciaEliminados.on( 'order.dt search.dt', function () {
    TablaProvinciaEliminados.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    });
  }).draw();
  }

  /// método para mostrar los distritos existentes
  function showDistritosExistentes()
  {
    TablaDistrito = $('#tabla_distrito').DataTable({
      retrieve:true,
      language:SpanishDataTable(),
      processing:true,
      "columnDefs": [{
      "searchable": false,
      "orderable": false,
      "targets": 0
    }],
      ajax:{
        url:RUTA+"distritos/all?token_="+TOKEN,
        method:"GET",
        dataSrc:"response"
      },
      columns:[
        {"data":"name_distrito"},
        {"data":null,render:function(dta){return '<b class="badge bg-primary">'+dta.name_distrito+' - '+dta.name_provincia+' - '+dta.name_departamento+'</b>'}},
        {"defaultContent":`
        <div class="row">
         <div class="col-xl-4 col-lg-4 col-md-5 col-12 m-xl-0 m-lg-0 m-md-0 m-1">
           <button class="btn btn-rounded btn-outline-warning btn-sm" id="editar_dis"><i class='bx bxs-edit-alt'></i></button>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-5 col-12 m-xl-0 m-lg-0 m-md-0 m-1">
           <button class="btn btn-rounded btn-outline-danger btn-sm" id="ocultar_dis"><i class='bx bx-x'></i></button>
          </div>
        </div>
        `}
      ]
    }).ajax.reload();
    TablaDistrito.on( 'order.dt search.dt', function () {
    TablaDistrito.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    });
  }).draw();
  }

  /// editar departamento
  function editarDepartamento(Tabla,Tbody)
  {
    $(Tbody).on('click','#editar_dep',function(){

      $('#modal_editar_dep').modal("show");

      let filaSeleccionado = $(this).parents('tr');

      if(filaSeleccionado.hasClass("child"))
      {
        filaSeleccionado = filaSeleccionado.prev();
      }

      let Datos = Tabla.row(filaSeleccionado).data();

      ID_DEP = Datos.id_departamento;

      $('#departamento').val(Datos.name_departamento);

      
    });
  }

  /// Editar las provincias existentes
  var EditarProvincia = function(Tabla,Tbody){

    $(Tbody).on('click','#editar_prov',function(){

       $('#modal_editar_provincia').modal("show");
       let filaSeleccionado = $(this).parents('tr');

       if(filaSeleccionado.hasClass('child'))
       {
        filaSeleccionado = filaSeleccionado.prev();
       }

       /// obtenemos los datos
       let Datos = Tabla.row(filaSeleccionado).data();

       ID_PROV = Datos.id_provincia; // obtenemos el id de la provincia para actualizar

       $('#provincia').val(Datos.name_provincia);

       showDepartamentosEnCombo('dep_show');

       $('#dep_show').val(Datos.id_departamento)
       
    });
  }

   /// Eliminar de la lista a provincias
  var EliminarListaProvincia = function(Tabla,Tbody){

$(Tbody).on('click','#ocultar_prov',function(){

   let filaSeleccionado = $(this).parents('tr');

   if(filaSeleccionado.hasClass('child'))
   {
    filaSeleccionado = filaSeleccionado.prev();
   }

   /// obtenemos los datos
   let Datos = Tabla.row(filaSeleccionado).data();

   ID_PROV = Datos.id_provincia;

   Swal.fire({
  html: '<h3>Estas seguro de eliminar de la lista a la provincia de <b class="badge bg-primary">'+Datos.name_provincia+'</b> ?</h3>'
  +'Al eliminar de la lista a la provincia seleccionada, ya no podrás usarlo nuevamente.!',
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, eliminar!'
}).then((result) => {
  if (result.isConfirmed) {
   ModifyStatusProvincia(ID_PROV,"2");
  }
}); 
   
});
}

  /// cancelar la edición de departamentos
  function cancelEdicionDepartamento(Tabla,Tbody)
  {
   $(Tbody).on('click','#ocultar_departamento',function(){
      let filaSeleccionado = $(this).parents('tr');

      if(filaSeleccionado.hasClass("child"))
      {
        filaSeleccionado = filaSeleccionado.prev();
      }

      let Datos = Tabla.row(filaSeleccionado).data();
      ID_DEP = Datos.id_departamento;
  Swal.fire({
  title: 'Estas seguro de eliminar de la lista al departamento '+Datos.name_departamento+' ?',
  text: "Al eliminar de la lista, ya no podrás usarlo nuevamente.!",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, eliminar!'
}).then((result) => {
  if (result.isConfirmed) {
   CambiarEstadoDepartamento(ID_DEP,"2");
  }
});      
  });
  }

  /// actualizar datos del departamento seleccionado
  function updateDataDepartamento(id,depart_)
  {
    $.ajax({
      url:RUTA+"departamento/"+id+"/update",
      method:"POST",
      data:{token_:TOKEN,dep:depart_.val()},
      success:function(response)
      {
        response = JSON.parse(response);

        if(response.response == 1 || response.response === 'existe')
        {
          Swal.fire(
            {
              title:"Mensaje del sistema!",
              text:"Departamento actualizado",
              icon:"success",
              target:document.getElementById('modal_editar_dep')
            }
          ).then(function(){
            $('#modal_editar_dep').modal("hide");
            showDepartamentosExistentes();
          });
        }
        else
        {
          Swal.fire(
            {
              title:"Mensaje del sistema!",
              text:"Acaba de ocurrir un error al actualizar los datos del departamento",
              icon:"error",
              target:document.getElementById('modal_editar_dep')
            }
          )
        }
      }
    })
  }
  /// eliminar al departamento de la lista
  function CambiarEstadoDepartamento(id,estado)
  {
    $.ajax({
      url:RUTA+"departamento/"+id+"/cambiar_estado/"+estado,
      method:"POST",
      data:{token_:TOKEN},
      success:function(response)
      {
        response = JSON.parse(response);

        if(response.response == 1)
        {
         if(estado == 2)
         {
          Swal.fire({
            title:"Mensaje del sistema!",
            text:"Departamento eliminado exitosamente",
            icon:"success",
          }).then(function(){
            showDepartamentosExistentes();
          });
         }
         else{
           $('#mensaje_dep_eliminados').show(120);
           showDepartamentosEliminados();
         }
        }
        else
        {
          Swal.fire({
            title:"Mensaje del sistema!",
            text:"Error, el proceso falló, intentelo de nuevo o más tarde",
            icon:"error"
          })
        }
      }
    })
  }

  /// activar el departamento
  function ActualizarDepartamento(Tabla,Tbody)
  {
    $(Tbody).on('click','#activar_dep',function(){

      let filaSeleccionado = $(this).parents('tr');

      if(filaSeleccionado.hasClass("child"))
      {
        filaSeleccionado = filaSeleccionado.prev();
      }

      let Datos = Tabla.row(filaSeleccionado).data();

      ID_DEP = Datos.id_departamento;

      CambiarEstadoDepartamento(ID_DEP,"1");
      
    });
  }

  /// mostrar los departamentos en comboBox
  var showDepartamentosEnCombo = (idCombo)=>{
    let option = '';

    let response =  show(RUTA+"departamento/mostrar?token_="+TOKEN);

    response.forEach(deps => {
      option+='<option value='+deps.id_departamento+'>'+deps.name_departamento+'</option>';
    });

    // mostramos en el combo
    $('#'+idCombo).html(option);
   
  }
  /// Actualizar datos de la provincia
  var updateProvincia = (id,provincia_,departamento_)=>{
    $.ajax({
      url:RUTA+"provincia/"+id+"/update",
      method:"POST",
      data:{token_:TOKEN,prov:provincia_,dep:departamento_},
      success:function(response)
      {
        response = JSON.parse(response);

        if(response.response == 1)
        {
          Swal.fire({
            title:"Mensaje del sistema !",
            text:"Provincia actualizado correctamente",
            icon:'success',
            target:document.getElementById('modal_editar_provincia')
          }).then(function(){
            showProvinciasExistentes();
            $('#modal_editar_provincia').modal('hide')
          });
        }
        else
        {
          if(response.response === 'existe')
          {
            Swal.fire({
            title:"Mensaje del sistema !",
            text:"Usted! no realizó ningún cambio, sus datos permanecen de la misma manera",
            icon:'info',
            target:document.getElementById('modal_editar_provincia')
          })
          } else
           {
          Swal.fire({
            title:"Mensaje del sistema !",
            text:"Error al intentar actualizar datos de la provincia seleccionado",
            icon:'error',
            target:document.getElementById('modal_editar_provincia')
          })
           }
        }
      }
    })
  }

  /// Cambiar de estado a la provincia
  var ModifyStatusProvincia = (id,estatus_)=>
  {
    $.ajax({
      url:RUTA+"provincia/"+id+"/modifystatus/"+estatus_,
      method:"POST",
      data:{token_:TOKEN},
      success:function(response)
      {
        response = JSON.parse(response);

        if(response.response == 1)
        {
          if(estatus_ === "2")
          {
            Swal.fire({
            title:'Mensaje del sistema !',
            text:'Provincia eliminado de la lista',
            icon:'success',
          }).then(function(){
            showProvinciasExistentes();
          });
          }
          else
          {
           $('#mensaje_prov_eliminados').show(120);
           showProvinciasEliminados();
          }
        }
        else
        {
          
            Swal.fire({
            title:'Mensaje del sistema !',
            text:'Error, el proceso falló, inténtelo de nuevo o más tarde',
            icon:'error',
          }) 
        }
      }
    })
  }

  /**
   *Activar la provincia 
   */
  var ActivarProvincia = (Tabla,Tbody)=>{
    $(Tbody).on('click','#habilitar_prov',function(){
      let filaSeleccionado = $(this).parents('tr');

      if(filaSeleccionado.hasClass('child'))
      {
        filaSeleccionado = filaSeleccionado.prev();
      }

      let Datas = Tabla.row(filaSeleccionado).data();

      ModifyStatusProvincia(Datas.id_provincia,"1");

    })
  }
</script>
@endsection