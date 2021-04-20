
var route= document.querySelector("[name=route]").value;
var UrlEspacio = route + '/apiEspacios';
new Vue({
    http:{
        headers:{
           'X-CSRF-TOKEN':document.querySelector('#token').getAttribute('value')
        }
      },
    el: '#espacio',
    data:{
        espacio: [],
        id_espacio: '',
        id_e:'',
        nombre: '',
        ubicacion: '',
        cupo: '',
        editar: false,
        search:'',
    },
    created:function(){
        this.getEspacio();
    },
    methods: {
        getEspacio:function(){
            this.$http.get(UrlEspacio)
            .then(function(json){
                this.espacio = json.data;
            })
        },
        showModal:function(){
			$('#agregar_espacio').modal('show');
		},
        agregarEspacio:function(){
            var e={
                nombre: this.nombre,
                ubicacion: this.ubicacion,
                cupo: this.cupo
            };
            this.$http.post(UrlEspacio,e)
            .then(function(json){
                $('#agregar_espacio').modal('hide');
                this.nombre="";
                this.ubicacion="";
                this.cupo="";
                this.getEspacio();
            }).catch(function(json){
                console.log(json);
            })
        },
        editarEspacio:function(id){
            this.editar=true;
            this.$http.get(UrlEspacio + '/' + id)
            .then(function(json){
                this.nombre = json.data.nombre
                this.ubicacion = json.data.ubicacion
                this.cupo = json.data.cupo
                this.id_e = json.data.id_espacio

                $('#agregar_espacio').modal('show');
            })
        },
        actualizarEspacio:function(){
            var espac = {
                nombre: this.nombre,
                ubicacion: this.ubicacion,
                cupo: this.cupo
            };
            this.$http.patch(UrlEspacio + '/' + this.id_e,espac)
            .then(function(){
                $('#agregar_espacio').modal('hide');
                alert ('agregado con exito');
                this.getEspacio();

                this.nombre="";
                this.ubicacion="";
                this.cupo="";
                this.editar=false;
            })
        },
        eliminarEspacio:function(id){
            this.$http.delete(UrlEspacio +'/'+id)
            .then(function(){
                alert ('eliminado con exito');
                // this.getEspacio();
            }).catch(function(json){
                console.log(json);
            })

        },
        salir:function(){
            this.editar=false;
            this.nombre = "";
            this.ubicacion ="";
            this.cupo = "";
        }
    },
    computed:{
        searchE:function(){
            return this.espacio.filter((espac)=>{
                return espac.nombre.match(this.search.trim().toLowerCase());
            })
        }
    }
})
