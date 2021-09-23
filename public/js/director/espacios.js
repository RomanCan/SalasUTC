
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
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '¡Guardado exitosamente!',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.nombre="";
                this.ubicacion="";
                this.cupo="";
                this.getEspacio();
            }).catch(function(json){
                Swal.fire({
                    icon: 'error',
                    title: '¡Ha ocurrido un error!',
                    text: '¡No deje campos vacíos!',
                })
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
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '¡Actualizado exitosamente!',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.getEspacio();
                this.nombre="";
                this.ubicacion="";
                this.cupo="";
                this.editar=false;
            }).catch(function(){
                Swal.fire({
                    icon: 'error',
                    title: '¡Ha ocurrido un error!',
                    text: '¡No deje campos vacios!',
                })
            })
        },
        eliminarEspacio:function(id){
            Swal.fire({
				title: "No podrás revertir este cambio!,¿Estás seguro?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sí, bórralo',
				cancelButtonText:'No, cancelar',
			}).then((result)=>{
                if(result.value){
                    this.$http.delete(UrlEspacio +'/'+id)
                    .then(function(){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: '¡Eliminado exitosamente!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        this.getEspacio();
                    }).catch(function(json){
                        console.log(json);
                    })
                }
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
                return espac.nombre.toLowerCase().match(this.search.trim().toLowerCase())
                || espac.ubicacion.toLowerCase().match(this.search.trim().toLowerCase())
                || espac.cupo.toLowerCase().match(this.search.trim().toLowerCase());
            })
        }
    }
})
