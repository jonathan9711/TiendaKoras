@extends('layouts.app')

@section('content')

<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-body">
                    <h2 class="title">Solicitar Contraseña</h2>
                    <form action="{{url('/solicitar-contraseña')}}" method="POST">
                    {{csrf_field()}}

                       
                        @if($contraseña!="")        
                        <div class="row row-space">
                            <div class="col-8"> 
                                <span >su nueva contraseña es: </span>
                                <div class="input-group">
                                   {{$contraseña}}
                                    <!-- <input class="input--style-1" type="text" placeholder="Telefono" name="telefono" autocomplete="off"> -->
                                </div>
                                <span style="color: red;"><strong>Por favor anote su contraseña y no olvide cambiarla una ves ingrese a su cuenta.</strong></span>

                            </div>

                        </div>
                        @else
                            <div class="row row-space">
                                
                                <div class="col-6">
                                    <div class="input-group">
                                        <input class="input--style-1" type="text" placeholder="RFC" name="RFC" autocomplete="off" required>
                                    </div>
                                    <span style="color: red;">{{ $errors->first('RFC')}}</span>

                                </div>

                                
                            </div>

                            <div class="row row-space">
                                <div class="col-6">
                                    <div class="input-group">
                                        <input class="input--style-1" type="email" placeholder="Correo" name="email" autocomplete="off" required>
                                    </div>
                                    <span style="color: red;">{{ $errors->first('email')}}</span>

                                </div>
        
                            </div>

                            <div class="p-t-20">
                                <button class="btn btn--radius btn--green" type="submit">Solicitar contraseña</button>
                            </div>
                        @endif
                      
                        <div class="p-t-20">
                            <a href="{{url('/ingresar')}}" class="btn btn--radius btn--green" type="button">ir al Login</a>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    
</div>

@endsection