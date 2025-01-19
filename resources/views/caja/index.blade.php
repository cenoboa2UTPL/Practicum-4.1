@extends($this->Layouts('dashboard'))

@section('title_dashboard', 'Gestionar caja')

@section('css')
  <style>
    .card{
        background-color: #F0FFFF;
    }
    td.hide_me
    {
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
                <h5>Apertura inicial de caja</h5>
               </div>

               <div class="card-text">
                <b class="float-start">Total Saldo {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }} :    </b> <span id="totalsaldo_" class="badge bg-primary mx-2"></span>
                @if ($this->profile()->rol === 'Director' || $this->profile()->rol === 'admin_farmacia' || $this->profile()->rol === 'Farmacia')
                <button class="btn_twiter float-end mb-3 col-xl-4 col-lg-5 col-md-6 col-12 mt-xl-0 mt-lg-0 mt-md-0 mt-2" id="add_apertura_caja"><b>Agregar uno nuevo <i class='bx bx-plus'></i></b></button>                    
                @endif
                 <div class="table-responsive">
                    <table class="table table-bordered table-striped nowrap responsive" id="lista_apertura_caja" style="width: 100%">
                     <thead>
                        <tr>
                            <th>#</th>
                            <th>Acciones</th>
                            <th>Fecha apertura</th>
                            <th>Saldo inicial {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</th>
                            <th>Fecha de cierre</th>
                            
                            <th @if($this->profile()->rol !== 'Director') class="d-none" @endif>Ingreso clínica {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</th>
                  
                            <th @if($this->profile()->rol !== 'admin_farmacia' and $this->profile()->rol !== 'Farmacia' and $this->profile()->rol !== 'admin_general') class="d-none" @endif>Ventas {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</th>
                            
                            <th @if($this->profile()->rol !== 'admin_farmacia' and $this->profile()->rol !== 'Farmacia' and $this->profile()->rol !== 'admin_general') class="d-none" @endif>Compras {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</th>
                            <th>Saldo {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }}</th>
                             
                        </tr>
                     </thead>
                     
                    </table>
                 </div>
               </div>
               
            </div>
        </div>
    </div>
</div>
{{--- MODAL PARA APERTURAR NUEVA CAJA ----}}
<div class="modal fade" id="modal_apertura_caja">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #4169E1">
        <h5 class="text-white">Nueva apertura de caja</h5>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="form_apertura_caja">
          <input type="hidden" name="_token" value="{{$this->Csrf_Token()}}">
          <div class="form-group">
            <label for="monto_apertura"><b>Monto inicial {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }} <span class="text-danger"> * </span></b></label>
            <input type="text" class="form-control" id="monto_apertura" name="monto_apertura" placeholder="0.00">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success rounded" id="save_apertura_caja"><b>Guardar <i class='bx bxs-save' ></i></b></button>
      </div>
    </div>
  </div>
</div>

{{---MODAL PARA EDITAR LA CAJA ---}}
<div class="modal fade" id="modal_editar_apertura_caja">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #4169E1">
        <h5 class="text-white">Editar la apertura de caja</h5>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="form_apertura_caja_editar">
          <input type="hidden" name="_token" value="{{$this->Csrf_Token()}}">
          <div class="form-group">
            <label for="monto_apertura_editar"><b>Monto inicial {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }} <span class="text-danger"> * </span></b></label>
            <input type="text" class="form-control" id="monto_apertura_editar" name="monto_apertura_editar" placeholder="0.00">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success rounded" id="update_apertura_caja"><b>Guardar <i class='bx bxs-save' ></i></b></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_add_apertura_caja_farmacia">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #4169E1">
        <h5 class="text-white">Nueva apertura de caja</h5>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="form_apertura_caja_far">
          <input type="hidden" name="_token" value="{{$this->Csrf_Token()}}">
          <div class="form-group">
            <label for="monto_apertura_far"><b>Monto inicial {{ count($this->BusinesData()) == 1 ? $this->BusinesData()[0]->simbolo_moneda : 'S/.' }} <span class="text-danger"> * </span></b></label>
            <input type="text" class="form-control" id="monto_apertura_far" name="monto_apertura_far" placeholder="0.00">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success rounded" id="far_apertura_caja"><b>Guardar <i class='bx bxs-save' ></i></b></button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script src="{{ URL_BASE }}public/js/control.js"></script>
<script src="{{ URL_BASE }}public/js/egresos.js"></script>
<script>
  var RUTA = "{{ URL_BASE }}" // la url base del sistema
  var TOKEN = "{{ $this->Csrf_Token() }}";
  var PROFILE_ = "{{ $this->profile()->rol }}";
  var ID_CAJA;
  var TablaAperturaCaja ;
$(document).ready(function(){
  let MontoApertura = $('#monto_apertura'); 
  let MontoAperturaEditar = $('#monto_apertura_editar'); 
  let MontoAperturaFar = $('#monto_apertura_far');
  mostrarAperturaCajasInicial();
  ConfirmarCerrarCajaAperturada(TablaAperturaCaja,'#lista_apertura_caja tbody');
  VerInformeCajaCierre(TablaAperturaCaja,'#lista_apertura_caja tbody');
  EditarCajaCierre(TablaAperturaCaja,'#lista_apertura_caja tbody');
  ConfirmarEliminadoCajaAperturada(TablaAperturaCaja,'#lista_apertura_caja tbody');

$('#add_apertura_caja').click(function(){
 $('#modal_apertura_caja').modal("show")
});
MontoApertura.keyup(function (){
        this.value = (this.value + '').replace(/[^0-9]/g, '');
 });

MontoApertura.keypress(function(evento){
 if(evento.which == 13){
  evento.preventDefault();
  if($(this).val().trim().length == 0){
    $(this).focus();
  }else{
    saveAperturaCaja();
  }
 }
});
MontoAperturaFar.keypress(function(evento){
 if(evento.which == 13){
  evento.preventDefault();
  if($(this).val().trim().length == 0){
    $(this).focus();
  }else{
    updateAperturaCajaExists()
  }
 }
});
MontoAperturaEditar.keypress(function(evento){
 if(evento.which == 13){
  evento.preventDefault();
  if($(this).val().trim().length == 0){
    $(this).focus();
  }else{
    updateAperturaCaja();
  }
 }
});
$('#save_apertura_caja').click(function(){
  if(MontoApertura.val().trim().length == 0)
  {
    MontoApertura.focus();
  }else{
    saveAperturaCaja();
  }
});

$('#far_apertura_caja').click(function(){
  if(MontoAperturaFar.val().trim().length == 0)
  {
    MontoAperturaFar.focus();
  }else{
    updateAperturaCajaExists()
  }
});
$('#update_apertura_caja').click(function(){
  if(MontoAperturaEditar.val().trim().length == 0)
  {
    MontoAperturaEditar.focus();
  }else{
    updateAperturaCaja();
  }
});

});

/// mostrar todas las aperturas de caja
function mostrarAperturaCajasInicial()
{
TablaAperturaCaja = $('#lista_apertura_caja').DataTable({
  "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            
            // converting to interger to find total
            var intVal = function ( i ) {
            return typeof i === 'string' ?
            i.replace(/[\$,]/g, '')*1 :
            typeof i === 'number' ?
            i : 0;
            };
            
            // computing column Total the complete result
            var TotalSaldo= api
            .column(8)
            .data()
            .reduce( function (a, b) {
            return intVal(a) + intVal(b);
            }, 0 );
            // Update footer by showing the total with the reference of the column index
            $('#totalsaldo_').html("<b>"+TotalSaldo.toFixed(2)+"</b>");
            
   },  
 language: SpanishDataTable(),
 retrieve:true,
 processing:true,
 responsive:true,
 "columnDefs": [{
        "searchable": false,
        "orderable": false,
        "targets": 0
    }],
 ajax:{
  url:RUTA+"clinica_farmacia/mostrar/aperturas/caja",
  method:"GET",
  dataSrc:"response"
 },
 columns:[
  {"data":null},
  {"data":null,render:function(dataresp){
    if(PROFILE_ === 'Director')
    {
    if(dataresp.estado_clinica === 'a' || dataresp.estado_clinica == null)
    {
       if(dataresp.estado_clinica ==  null){
        return `<button class='btn btn-warning rounded btn-sm' id='editar_caja'><i class='bx bxs-pencil'></i></button>`;
       }
       return `<button class='btn btn-warning rounded btn-sm' id='editar_caja'><i class='bx bxs-pencil'></i></button>
    <button class='btn btn-danger rounded btn-sm' id='eliminar_caja'> <i class='bx bxs-trash' ></i> </button>
    <button class='btn btn-primary rounded btn-sm' id='cerrar_caja'> <i class='bx bx-key' ></i> </button>`;
    }
    return `<button class='btn btn-danger rounded btn-sm' id='eliminar_caja'> <i class='bx bxs-trash' ></i></button>
    <button class='btn btn-info rounded btn-sm' id='print_caja'> <i class='bx bxs-file-pdf'></i> </button>`;
    }

    if(dataresp.estado_farmacia === 'a' || dataresp.estado_farmacia == null )
    {
      if(dataresp.estado_farmacia ==  null){
        return `<button class='btn btn-warning rounded btn-sm' id='editar_caja'><i class='bx bxs-pencil'></i></button>`;
       }
       return `<button class='btn btn-warning rounded btn-sm' id='editar_caja'><i class='bx bxs-pencil'></i></button>
    <button class='btn btn-danger rounded btn-sm' id='eliminar_caja'> <i class='bx bxs-trash' ></i> </button>
    <button class='btn btn-primary rounded btn-sm' id='cerrar_caja'> <i class='bx bx-key' ></i> </button>`;
    }
    return `<button class='btn btn-danger rounded btn-sm' id='eliminar_caja'> <i class='bx bxs-trash' ></i></button>
    <button class='btn btn-info rounded btn-sm' id='print_caja'> <i class='bx bxs-file-pdf'></i> </button>`;
  }},
  {"data":null,render:function(cajadata){
    if(PROFILE_ === 'Director')
    {
      if(cajadata.fecha_apertura_clinica == null){
        return `<span class='badge bg-danger'>---------------</span>`;
      }
      return cajadata.fecha_apertura_clinica;
    }

    if(cajadata.fecha_apertura_farmacia == null){
        return `<span class='badge bg-danger'> --------------- </span>`
     }
      return cajadata.fecha_apertura_farmacia;
     
  }},
  {"data":null,render:function(caja){
    if(PROFILE_ === 'Director')
    {
       if(caja.saldo_inicial_clinica == null){
        return `<span class='badge bg-danger'><b>0.00</b></span>`
       }
       return `<span class='badge bg-success'><b>`+caja.saldo_inicial_clinica+`</b></span>`
    }
    if(caja.saldo_inicial_farmacia == null){
        return `<span class='badge bg-danger'><b>0.00</b></span>`
       }
       return `<span class='badge bg-success'><b>`+caja.saldo_inicial_farmacia+`</b></span>`
  }},
  {"data":null,render:function(caja){

   if(PROFILE_ === 'Director'){
   if(caja.fecha_cierre_clinica == null)
   {
     return `<span class='badge bg-danger'><b>--------------------</b></span>`
   }

   return caja.fecha_cierre_clinica;
  }

  if(caja.fecha_cierre_farmacia == null)
   {
     return `<span class='badge bg-danger'><b>--------------------</b></span>`
   }

   return caja.fecha_cierre_farmacia;

  }},
  {"data":"ingreso_clinica",render:function(ingreso_clinica){
   if(ingreso_clinica == null)
   {
     return `<span class='badge bg-danger'><b>0.00</b></span>`
   }

   return ingreso_clinica;

  }},
  {"data":"total_ventas",render:function(total_ventas){
   if(total_ventas == null)
   {
     return `<span class='badge bg-danger'><b>0.00</b></span>`
   }

   return total_ventas;

  }},
   
  {"data":"total_compras",render:function(total_compras){
   if(total_compras == null)
   {
     return `<span class='badge bg-danger'><b>0.00</b></span>`
   }

   return total_compras;

  }},
  {"data":null,render:function(caja){
   if(PROFILE_ === 'Director')
   {
    if(caja.saldo_final_clinica == null)
   {
     return `<span class='badge bg-danger'><b>0.00</b></span>`
   }

   return  `<span class='badge bg-success'><b>`+caja.saldo_final_clinica+`</b></span>`
   }
   if(caja.saldo_final_farmacia == null)
   {
     return `<span class='badge bg-danger'><b>0.00</b></span>`
   }

   return  `<span class='badge bg-success'><b>`+caja.saldo_final_farmacia +`</b></span>`

  }}
 ],
 
  columnDefs:[
        (  PROFILE_ !== 'Director' ) ? { "sClass": "hide_me", target: [5] } : (PROFILE_ !== 'Farmacia') ? { "sClass": "hide_me", target: [6,7]}:''
    ]
 
}).ajax.reload();

 /*=========================== ENUMERAR REGISTROS EN DATATABLE =========================*/
 TablaAperturaCaja.on('order.dt search.dt', function() {
    TablaAperturaCaja.column(0, {
        search: 'applied',
        order: 'applied'
    }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1;
    });
}).draw();
}

/// apertura de caja
function saveAperturaCaja()
{
  let respuesta = crud(RUTA+"clinica_farmacia/apertura_caja",'form_apertura_caja');
 
  if(respuesta  == 1)
  {
    Swal.fire({
      title:"Mensaje del sistema!",
      text:"La apertura se a iniciado sin problemas!",
      icon:"success",
      target:document.getElementById('modal_apertura_caja')
    }).then(function(){
      $('#form_apertura_caja')[0].reset();
      mostrarAperturaCajasInicial();
    });
  }else{
    Swal.fire({
      title:"Mensaje del sistema!",
      text:"Error al registrar nueva apertura de caja, para aperturar una nueva, se recomienda cerrar la caja actual aperturada!",
      icon:"error",
      target:document.getElementById('modal_apertura_caja')
    }).then(function(){
      mostrarAperturaCajasInicial();
    })
  }
}
/// modificar la apertura de caja
function updateAperturaCaja()
{
  
  let respuesta = crud(RUTA+"clinica_farmacia/apertura_caja/update/"+ID_CAJA,'form_apertura_caja_editar');
 
  if(respuesta  == 1)
  {
    Swal.fire({
      title:"Mensaje del sistema!",
      text:"La apertura a sido modificado sin problemas!",
      icon:"success",
      target:document.getElementById('modal_editar_apertura_caja')
    }).then(function(){
      $('#form_apertura_caja_editar')[0].reset();
      mostrarAperturaCajasInicial();
    });
  }else{
    Swal.fire({
      title:"Mensaje del sistema!",
      text:"Error al modificar la apertura de caja!",
      icon:"error",
      target:document.getElementById('modal_editar_apertura_caja')
    })
  }
}

function updateAperturaCajaExists()
{
 
  let respuesta = crud(RUTA+"clinica/apertura_caja/farmacia/"+ID_CAJA,'form_apertura_caja_far');
 
  if(respuesta  == 1)
  {
    Swal.fire({
      title:"Mensaje del sistema!",
      text:"La apertura de caja a sido registrada sin problemas!",
      icon:"success",
      target:document.getElementById('modal_add_apertura_caja_farmacia')
    }).then(function(){
      $('#form_apertura_caja_far')[0].reset();
      mostrarAperturaCajasInicial();
    });
  }else{
    Swal.fire({
      title:"Mensaje del sistema!",
      text:"Error al aperturar la caja!",
      icon:"error",
      target:document.getElementById('modal_add_apertura_caja_farmacia')
    })
  }
}

/// proceso para eliminar la caja aperturada

function eliminarAperturaCaja()
{
   $.ajax({
    url:RUTA+"eliminar/caja_aperturada/"+ID_CAJA,
    method:"POST",
    data:{
      _token:TOKEN
    },
    dataType:"json",
    success:function(response)
    {
      if(response.response == 1)
      {
      Swal.fire({
      title:"Mensaje del sistema!",
      text:"La apertura a sido eliminado sin problemas!",
      icon:"success",
      
    }).then(function(){
      
      mostrarAperturaCajasInicial();
    }); 
    }else{
      Swal.fire({
      title:"Mensaje del sistema!",
      text:"Error al eliminar la caja aperturada!",
      icon:"error",
    
    })
    }
    },err:function(error){
      Swal.fire({
      title:"Mensaje del sistema!",
      text:"Error al eliminar la caja aperturada!",
      icon:"error",
    
    });
    }
   })
}


/// cerrar la caja
function ConfirmarCerrarCajaAperturada(Tabla,Tbody)
{
 $(Tbody).on('click','#cerrar_caja',function(){
  let fila = $(this).parents('tr');

  if(fila.hasClass('child'))
  {
    fila = fila.prev();
  }

  let Data = Tabla.row(fila).data();
  let Saldo = PROFILE_ === 'Director' ? Data.saldo_inicial_clinica : Data.saldo_inicial_farmacia;
  let fecha = PROFILE_ === 'Director' ? Data.fecha_apertura_clinica :Data.fecha_apertura_farmacia;
  ID_CAJA = Data.id_apertura_caja;

  Swal.fire({
  title: "Estas seguro de cerrar la caja con saldo inicial de : "+Saldo+" con fecha : "+fecha+" ?",
  text: "Al cerrar la caja, ya podrás ver todos los datos restantes de ingresos y egresos completados en la caja aperturada, a la vez podrás crear una nueva apertura de caja!",
  icon: "question",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Si, cerrar!",
  
}).then((result) => {
  if (result.isConfirmed) {
     CerrarCaja(ID_CAJA);
  }
});
   
 });
}

/// confirma eliminado de caja
function ConfirmarEliminadoCajaAperturada(Tabla,Tbody)
{
 $(Tbody).on('click','#eliminar_caja',function(){
  let fila = $(this).parents('tr');

  if(fila.hasClass('child'))
  {
    fila = fila.prev();
  }

  let Data = Tabla.row(fila).data();
  let Saldo = PROFILE_ === 'Director' ? Data.saldo_inicial_clinica : Data.saldo_inicial_farmacia;
  let fecha = PROFILE_ === 'Director' ? Data.fecha_apertura_clinica :Data.fecha_apertura_farmacia;
  ID_CAJA = Data.id_apertura_caja;

  Swal.fire({
  title: "Estas seguro de eliminar la caja con saldo inicial de : "+Saldo+" con fecha : "+fecha+" ?",
  text: "Al eliminar la caja aperturada, ya no podrás recuperarlo y se restará su saldo!",
  icon: "question",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Si, eliminar!",
  
}).then((result) => {
  if (result.isConfirmed) {
     eliminarAperturaCaja();
  }
});
   
 });
}

/// ver informe de cierre de caja
function VerInformeCajaCierre(Tabla,Tbody)
{
 $(Tbody).on('click','#print_caja',function(){
  let fila = $(this).parents('tr');

  if(fila.hasClass('child'))
  {
    fila = fila.prev();
  }

  let Data = Tabla.row(fila).data();
 
  ID_CAJA = Data.id_apertura_caja;
   
  window.open(RUTA+"informe/cierre_de_caja/"+ID_CAJA,"_blank");
   
 });
}

// editar la caja
function EditarCajaCierre(Tabla,Tbody)
{
 $(Tbody).on('click','#editar_caja',function(){
  let fila = $(this).parents('tr');

  if(fila.hasClass('child'))
  {
    fila = fila.prev();
  }

  let Data = Tabla.row(fila).data();
 
  ID_CAJA = Data.id_apertura_caja;
   
  if(PROFILE_ === 'Director' && Data.saldo_inicial_clinica != null){
  $('#monto_apertura_editar').val(Data.saldo_inicial_clinica);
  $('#modal_editar_apertura_caja').modal("show");
  }else{
    if(PROFILE_ === 'Director' && Data.saldo_inicial_clinica == null)
    {
      $('#monto_apertura_far').val(Data.saldo_inicial_clinica);
      $('#modal_add_apertura_caja_farmacia').modal("show");
    }else{
      if((PROFILE_ === 'admin_farmacia' || PROFILE_ === 'Farmacia') && Data.saldo_inicial_farmacia != null){
       $('#monto_apertura_editar').val(Data.saldo_inicial_farmacia);
       $('#modal_editar_apertura_caja').modal("show");
  }else{
    if((PROFILE_ === 'admin_farmacia' || PROFILE_ === 'Farmacia') && Data.saldo_inicial_farmacia == null)
    {
      $('#monto_apertura_far').val(Data.saldo_inicial_farmacia);
      $('#modal_add_apertura_caja_farmacia').modal("show");
    }
  }
    }
  }
   
 });
}

/// proceso para cerrar la caja aperturada 
function CerrarCaja(id)
{
   $.ajax({
    url:RUTA+"cerrar/caja/aperturada/"+id,
    method:"POST",
    data:{
      _token:TOKEN
    },
    dataType:"json",
    success:function(response)
    {
     if(response.response == 1)
     {
      Swal.fire({
        title:"Mensaje del sistema!",
        text:"Caja cerrada correctamente!",
        icon:"success"
      }).then(function(){
        mostrarAperturaCajasInicial();
      });
     }
    },err:function(error)
    {
      Swal.fire({
        title:"Mensaje del sistema!",
        text:"Error al cerrar la caja aperturada!",
        icon:"error"
      });
    }
   })
}
</script> 

@endsection