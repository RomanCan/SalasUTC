var route = document.querySelector("[name=route]").value;
var urlPerfilDocente = route + '/apiPerfilDocentes';

new Vue({
    http: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
    },

    el:'#usuariodocente',

    data:{
        docentes:[],
        cedula:'',
        nombre:'',
        id_session:'',
        apellidop:'',
        apellidom:'',
        tratamiento:'',
        profesio:'',
        usuario:'',
        password:'',
        email:'',
    },

    created(){
    	this.getUsuarioDocentes();
    },

    methods:{
    	getUsuarioDocentes:function(){
    		this.$http.get(urlPerfilDocente)
    			.then(function(json){
    				this.docentes = json.data;
    				console.log(json);
    			});
    	},

        editarDatos:function(id){
            //this.cedula=id;
            this.$http.get(urlPerfilDocente + '/' + id).then(function(json){
                this.usuario = json.data.usuario;
                this.password = json.data.password;
                this.email = json.data.email;
                this.id_session = json.data.cedula;
                $('#Mostrar').modal('show');
            });
        },

        actualizarDatosDocente:function(){
            //this.cedula=id;
            var datos = {
                cedula:this.id_session,
                usuario:this.usuario,
                password:this.password,
                email:this.email
            };
            this.$http.patch(urlPerfilDocente + '/' + this.id_session,datos)
            .then(function(json){
                Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Guardado exitosamente',
                        showConfirmButton: false,
                        timer: 1500
                      })
                this.getUsuarioDocentes();
                $('#Mostrar').modal('hide');
            }).catch(function(json){
                Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Ha ocurrido un error',
                        text: 'Verifique sus datos',
                      })
                console.log(json);
            });
        }
    }
});
