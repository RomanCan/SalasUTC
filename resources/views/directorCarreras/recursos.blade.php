@extends('layouts.masterDirector')
@section('titulo','Recursos')

@section('contenido')

<div class="container">
	<div id="recurso">
		<br>
		<br>
		<input type="text" placeholder="BUSCAR" v-model="buscar" class="form-control"><br>
		<button class="btn btn-md btn-success" data-toggle="modal" data-target="#agregar">Agregar</button>
		

      <br><br>


       <div class="row">
        <div class="col-md-12 col-xs-12">
        
          <div class="table-responsive">
          	<table class="table table-bordered">
            <thead class="tabla color ">
              <th>id</th>
              <th>Recurso</th>
              <th>Opciones</th>
            </thead>
            <tbody>
              <tr v-for="(rec,index) in filtroRecursos">
                <td>@{{rec.id_recurso}}</td>
                <td>@{{rec.recurso}}</td>
                
                
                <td>
                  <span class="btn btn-xs btn-primary" data-toggle="modal" data-target="#editarrecurso" v-on:click="showRecurso(rec.id_recurso)">EDITAR</span>
                  <span class="btn btn-xs btn-danger" v-on:click="eliminarRecurso(rec.id_recurso)">ELIMINAR</span>
                </td>
              </tr>
            </tbody>
          </table>
          </div>
          
        </div>
        
      </div>
	
          

                    <!-- Modal Agregar -->
		<div class="modal " id="agregar" tabindex="-1" role="dialog" >
		  <div class="modal-dialog" role="document" >
		    <div class="modal-content" >
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel"><strong>Recurso</strong></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="limpiar()">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body" style="background-color: #ECEEF0 ">
		      
		      <div class="row">
		        <div class="col-12">
		          
		          <label>Recurso</label>
		          <input type="text" name="recurso" class="form-control" v-model="recurso"><br>
		         


		        </div>
		      </div>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="limpiar()">Cancelar</button>
		        <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="agregarRec(id_recurso)">Guardar</button>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Fin de modal -->

		<!-- Modal Editar -->
		<div class="modal" id="editarrecurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content" >
		      <div class="modal-header" >
		        <h5 class="modal-title" id="exampleModalLabel"><strong>Editar Recurso</strong></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="limpiar()">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body" style="background-color: #ECEEF0 ">
		      
		      <div class="row">
		        <div class="col-12">
		          <label>Id</label>
		          <input type="text" disabled="" name="descripcion" class="form-control" v-model="id_recurso" placeholder="id">
		          <br>
		          <label>Nombre</label>
		          <input type="text" name="recurso" class="form-control" v-model="recurso"><br>
		          
		          


		        </div>
		      </div>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="limpiar()">Cancelar</button>
		        <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="updateRecurso(id_recurso)">Guardar cambios</button>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Fin de modal -->
	</div>
</div>



@endsection


@push('scripts')
	<script src="js/vue-resource.js"></script>
    
    
	<script src="js/director/recursos.js"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">

