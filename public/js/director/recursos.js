var route = document.querySelector("[name=route]").value;

var urlRecurso= route+ '/' + 'apiRecurso';
new Vue({
	el:'#recurso',
	// token
	http:{
		headers:{
			'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
		}
	},

	data:{
		n:'recursos',
		recursos:[],
		
		
		recurso:'',
		
		id_recurso:0,
		
		buscar:''
		
	},

	created:function(){
		this.getRecurso();
		this.getBuscar();
	},


	methods:{
		getRecurso:function(){
			this.$http.get(urlRecurso)
			.then(function(json){
				this.recursos=json.data
			});
		},

		getBuscar:function(){
			this.$http.get(urlRecurso)
			.then(function(json){
				this.recursos=json.data;
			}).catch(function(json){
				console.log(json);
			})
		},
		

		eliminarRecurso:function(id){
			var resp=confirm("¿estas seguro de eliminar el recurso?")
			if(resp==true)
			{
				this.$http.delete(urlRecurso + '/' + id)
				.then(function(json){
				this.getRecurso();
				});
			}
			
		},

		

		agregarRec:function(){
			// crear un json 
			var recurso={
					id_recurso:this.id_recurso,
					  recurso:this.recurso,
					  
					  }

			this.$http.post(urlRecurso,recurso)
			.then(function(json){
				this.getRecurso();
				// limpiar
				this.limpiar();

				
			
			});
		},

		showRecurso:function(id){
			this.$http.get(urlRecurso+ '/' + id)
			.then(function(json){
				this.id_recurso=json.data.id_recurso;
				this.recurso=json.data.recurso;
				
				
			});
		},

		updateRecurso:function(id){
			//crear un json
			var recurso={
					id_recurso:this.id_recurso,
					recurso:this.recurso,
					}

			this.$http.patch(urlRecurso+ '/' + id,recurso)
				.then(function(json){
					this.getRecurso();
					this.limpiar();
			});
		},


		

		limpiar:function(){
			this.id_recurso=0;
			this.recurso='';
			
			
		}

	},
	computed:{
		filtroRecursos:function(){
			return this.recursos.filter((recursos)=>{
				return recursos.recurso.match(this.buscar.trim()) || recursos.recurso.toLowerCase()
				.match(this.buscar.trim().toLowerCase());
			})
		}
	}
});