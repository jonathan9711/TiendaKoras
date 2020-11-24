@extends('layouts.app')

@section('content')

<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-body">
                    <h2 class="title">Crear Cuenta</h2>
                    <form action="{{url('/registrarse')}}" method="POST">
                    {{csrf_field()}}
                        <div class="row row-space">
                            
                            <div class="col-6">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Nombre" name="nombre" autocomplete="off">
                                </div>
                                <span style="color: red;">{{ $errors->first('nombre')}}</span>

                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Apellido" name="apellido" autocomplete="off">
                                </div>
                                <span style="color: red;">{{ $errors->first('apellido')}}</span>

                            </div>

                            <div class="col-6">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Dirección" name="direccion" autocomplete="off">
                                </div>
                                <span style="color: red;">{{ $errors->first('direccion')}}</span>

                            </div>

                            
                        </div>
                      
                        <div class="row row-space">
                           
                            <div class="col-6">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="RFC" name="RFC" autocomplete="off">
                                </div>
                                <span style="color: red;">{{ $errors->first('RFC')}}</span>

                            </div>

                            <div class="col-6">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Ciudad" name="ciudad" autocomplete="off">
                                </div>
                                <span style="color: red;">{{ $errors->first('ciudad')}}</span>

                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-6">
                                <div class="input-group">
                                    <input class="input--style-1" type="email" placeholder="Correo" name="email" autocomplete="off">
                                </div>
                                <span style="color: red;">{{ $errors->first('email')}}</span>

                            </div>

                            <div class="col-6">
                                <div class="input-group">
                                    <input class="input--style-1" type="password" placeholder="Contraseña" name="password" autocomplete="off">
                                </div>
                                <span style="color: red;">{{ $errors->first('password')}}</span>

                            </div>

                       
                           
                        </div>

                        <div class="row row-space">
                            <div class="col-5">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Telefono" name="telefono" autocomplete="off">
                                </div>
                                <span style="color: red;">{{ $errors->first('telefono')}}</span>

                            </div>

                            <!-- <div class="col-3">
                                <label for="">Compras</label>
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Compras" name="compras" readonly value="0">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <input type="date" placeholder="Fecha" name="ultima_compra" autocomplete="off">

                                </div>
                                <span style="color: red;">{{ $errors->first('ultima_compra')}}</span>

                            </div> -->
                        </div>


                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Registrarse</button>
                        </div>

                        <div class="p-t-20">
                            <a href="{{url('/ingresar')}}" class="btn btn--radius btn--green" type="submit">ya tengo una cuenta</a>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    
</div>
@endsection