@extends('plantilla.plantilla')

@section('contenido')
<?php 	$usuario = Auth::guard("cliente")->user();?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color: #e65540;"> <strong style="color: white;">Mis datos</strong> </div>

                <div class="card-body">
                    <form >
                      
                    {{csrf_field()}}
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Nombre: </label>

                            <div class="col-md-6">
                                <label for="email" class="col-form-label text-md-right">{{$usuario->nombre}}</label>
  
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Apellido: </label>

                            <div class="col-md-6">
                                <label for="password" class=" col-form-label text-md-right">{{$usuario->apellido}}</label>
   
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Direccion: </label>

                            <div class="col-md-6">
                                <label for="email" class=" col-form-label text-md-right">{{$usuario->direccion}}</label>
  
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Ciudad: </label>

                            <div class="col-md-6">
                                <label for="email" class=" col-form-label text-md-right">{{$usuario->ciudad}}</label>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Correo: </label>

                            <div class="col-md-6">
                                <label for="password" class="col-form-label text-md-right">{{$usuario->email}}</label>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Telefono: </label>

                            <div class="col-md-6">
                                <label for="password" class=" col-form-label text-md-right">{{$usuario->telefono}}</label>

                                
                            </div>
                        </div>
                   

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">

                                <button type="button" class='btn btn-warning btnEditarPerfil' style="color: white;"  data-toggle='modal' data-target='#modal-perfil'><i class='fa fa-pencil'></i>Editar</button>

                                <a  href="{{'/cliente/compras/'.$usuario->id_cliente}}" class="btn btn-success" >
                                    Mis compras
                                </a>
                            </div>
                           
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<!-- editar perfil modal -->
<div id="modal-perfil" class="modal fade" role="dialog">

	<div class="modal-dialog modal-lg">

		<div class="modal-content">

			<form role="form" method="post"  action="{{route('EditarPerfil')}}"  enctype="multipart/form-data">
				{{csrf_field()}}
			<div class="modal-header" style="background: #e65540; color:white">

				<button type="button" class="close"  data-dismiss="modal">&times;</button>

				<h4 class="modal-title">Editar Información</h4>

			</div>

			<div class="modal-body">
					<input type="text" readonly class="nombreProducto">
					<input type="hidden" name="id_cliente" id = "editarCodigo" value="{{$usuario->id_cliente}}">

                    <div class="row row-space">
                        <div class="col-md-12 p-b-30">
					        <div class="leave-comment">

                                <div class="row row-space">
                                    <div class="col-6">
                                        <label for="">Nombre</label>					            
                                        <div class="bo4 of-hidden size15 m-b-20">
                                        
                                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="nombre" value="{{$usuario->nombre}}" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="">Apellido</label>
                                        <div class="bo4 of-hidden size15 m-b-20">
                                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="apellido" value="{{$usuario->apellido}}" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="">Dirección</label>
                                        <div class="bo4 of-hidden size15 m-b-20">
                                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="direccion" value="{{$usuario->direccion}}" required>
                                        </div>
                                    </div>
                                </div>

                                    

                                <div class="row row-space">
                                    
                                    <div class="col-6">
                                        <label for="">Ciudad</label>
                                        <div class="bo4 of-hidden size15 m-b-20">
                                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="ciudad" value="{{$usuario->ciudad}}" required>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label for="">Correo</label>
                                        <div class="bo4 of-hidden size15 m-b-20">
                                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" value="{{$usuario->email}}" required>
                                        </div>

                                    </div>
                                </div>

                                <div class="row row-space">
                                    <div class="col-6">
                                            <label for="">RFC</label>
                                            <div class="bo4 of-hidden size15 m-b-20">
                                                <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="RFC" value="{{$usuario->RFC}}" required>
                                            </div>

                                    </div>

                                    <div class="col-6">
                                            <label for="">Telefono</label>
                                            <div class="bo4 of-hidden size15 m-b-20">
                                                <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="telefono" value="{{$usuario->telefono}}" required>
                                            </div>
                                    </div>
                                </div>

                                <div class="row row-space">
                                    <div class="col-5">
                                        
                                            <label for="">Contraseña</label>
                                            <div class="bo4 of-hidden size15 m-b-20">
                                                <input class="sizefull s-text7 p-l-22 p-r-22 " type="password" name="password" placeholder="Nueva Contraseña" >
                                               
                                            </div>
                                            <label for="" style="font-size: 12px;">*si desea conservar su contraseña deje el campo vacio</label>
                                            <label for="" style="font-size: 12px;">*si desea escribir una nueva contraseña debera tener almenos 6 caracteres</label>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">salir</button>

				<button type="submit" class="btn btn-primary">Guardar</button>

			</div>

			</form>

		</div>

	</div>

</div>

<!-- modal de listado de compras -->



<script src="{{asset('vistas/js/compras-cliente.js')}}"></script>

@endsection