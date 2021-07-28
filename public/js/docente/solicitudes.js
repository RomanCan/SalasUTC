var route = document.querySelector("[name=route]").value;
var urlSolicitudes= route+ '/' + 'apiSolicitudes';
var urlDocentes = route + '/' + 'apiDocentes';
var urlDocentesGrupos = route + '/' + 'getDocentesGrupos/';
var urlAsignaturas = route + '/' + 'getAsignaturas/';
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
    
    id_session:'',
    cedula:'',
	ClaveGrupo:'',
	ClaveAsig:'',


    
  },
  created:function(){
		this.getDocentes();
		
	},
  methods: {
    
    getDocentes:function(){
			this.$http.get(urlDocentes)
			.then(function(json){
				this.docentes=json.data
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

   


  },
})