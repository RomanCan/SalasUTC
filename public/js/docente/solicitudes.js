var route = document.querySelector("[name=route]").value;
var urlSolicitudes= route+ '/' + 'apiSolicitudes';
var urlDocentes = route + '/' + 'apiDocentes';
var urlDocentesGrupos = route + '/' + 'getDocentesGrupos/';
var urlAsignaturas = route + '/' + 'getAsignaturas/';
var urlEspacios= route+ '/' + 'apiEspacios';
var urlHorarios= route+ '/' + 'apiHorarios';

new Vue ({
  el: '#soli',
  // token
	http:{
		headers:{
			'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
		}
	},

  data: {
    n:'Hola',
    
    docentes:[],
	docentesgrupos:[],
	asignaturas:[],
	espacios:[],
	horarios:[],
	solicitudes:[],
    
    id_session:'',
    cedula:'',
	ClaveGrupo:'',
	ClaveAsig:'',
	id_espacio:'',
	fecha_solicitud:'',
	fecha_solicitada:'',
	titulo_actividad:'',
	detalle_actividad:'',
	status:0,
	participantes:'',
	tipo_solicitud:'',
	asignatura:'',
	hora:'',

    
  },
  created:function(){
		this.getDocentes();
		this.getEspacios();
		this.getHorarios();
		this.getSolicitudes();
		
	},
  methods: {

	getSolicitudes:function(){
		this.$http.get(urlSolicitudes)
		.then(function(json){
			this.solicitudes=json.data
		});
	},
    
    getDocentes:function(){
			this.$http.get(urlDocentes)
			.then(function(json){
				this.docentes=json.data
			});
		},

	getEspacios:function(){
			this.$http.get(urlEspacios)
			.then(function(json){
				this.espacios=json.data
			});
		},
	getHorarios:function(){
			this.$http.get(urlHorarios)
			.then(function(json){
				this.horarios=json.data
			});
		},

		// evento docentes por grupo
		getDocentesGrupos(event){
			var cedula = event.target.value;
			this.$http.get(urlDocentesGrupos + cedula)
			.then(function(json){
				this.docentesgrupos = json.data;
			})
		},

		// evento asignaturas
		getAsignaturas(event){
			var ClaveAsig = event.target.value;
			this.$http.get(urlAsignaturas + ClaveAsig)
			.then(function(json){
				this.asignaturas = json.data;
			})
		},

		// guardar registro de solicitud
		agregarSol:function(){
			// crear un json 
			var solicitud={
					  cedula:this.cedula,
					  ClaveGrupo:this.ClaveGrupo,
					  ClaveAsig:this.ClaveAsig,
					  id_espacio:this.id_espacio,
					  fecha_solicitud:this.fecha_solicitud,
					  fecha_solicitada:this.fecha_solicitada,
					  titulo_actividad:this.titulo_actividad,
					  detalle_actividad:this.detalle_actividad,
					  status:this.status,
					  participantes:this.participantes,
					  tipo_solicitud:this.tipo_solicitud,
					  asignatura:this.asignatura,
					  hora:this.hora,

					  
					  }

			this.$http.post(urlSolicitudes,solicitud)
			.then(function(json){
				this.getSolicitudes();
				// limpiar
				this.limpiar();

				
			
			});
		},
		limpiar:function(){
			
			this.cedula='';
			this.ClaveGrupo='';
			this.ClaveAsig='';
			this.id_espacio='';
			this.fecha_solicitud='';
			this.fecha_solicitada='';
			this.titulo_actividad='';
			this.detalle_actividad='';
			this.status=0;
			this.participantes='';
			this.tipo_solicitud='';
			this.asignatura='';
			this.hora='';
			
			
		},

   


  },
})