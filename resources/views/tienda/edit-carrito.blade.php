@extends('plantilla.plantilla')

@section('contenido')






<div class="container">
	<?php $cart = session()->get('cart'); ?>
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
            <div class="btn-group">
                                            
                <script type="text/javascript">
    
                function volver()
                {
                    window.location = "/carrito";
                }
    
                </script>
    
                <button class="btn btn-danger" onclick="volver()"><i class="fa fa-fw fa-arrow-circle-left"></i>Volver</button>
    
            </div>
				<div class="table-shopping-cart">                   
                       
                        
                        @foreach($cart[$idcart]['descripcion'] as $i=>$value)
                        <form action="{{route('EditEnCart')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="id_carrito" idCart="{{$idcart}}" value="{{$idcart}}">

                            <div class="form-group row">
                                <label for=""  class="col-md-4 col-form-label text-md-right">Nombre: </label>

                                <div class="col-md-6">
                                    <label for="nombre" name="nombre" class="col-form-label text-md-right">{{$cart[$idcart]['nombre']}}</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right ">Tipo de talla: </label>

                                <div class="col-6">
                                    <div class="bo4 of-hidden size15 m-b-20">
                                        <input class="sizefull s-text7 p-l-22 p-r-22 TipoTalla" type="text" TipoTalla="{{$value['tipo_talla']}}" name="tipo_talla" value="{{$value['tipo_talla']}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                @if($value['tipo_talla']=='accesorio')                           

                                <div class="col-md-6">
                                    <label for="" name="talla" class="col-form-label text-md-right">{{$value['talla']}}</label>
                                </div>                                
                                
                                <label for="" class="col-md-4 col-form-label text-md-right">Cantidad: </label>

                                <div class="col-md-6 w-size16 flex-m flex-w">
                                    <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                        <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                    </button>

                                    <input class="size8 m-text18 t-center num-product" type="number" name="num-product" value="{{$value['cantidad']}}">

                                    <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                        <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                                
                                <button class="btn btn-danger BorrarProductoEspecifico" style="float: right;">Borrar</button>
                                @else    
                                    <label for="" class="col-md-4 col-form-label text-md-right">Talla:</label>
                                   
                                    <div class="col-md-6">
                                        <div class="bo4 of-hidden size10 m-b-20">
                                            <input class="sizefull s-text7 p-l-22 p-r-22 TipoTalla" type="text" TipoTalla="{{$value['talla']}}" name="talla" value="{{$value['talla']}}" readonly>
                                        </div>                                    
                                    </div>                                 
                               
                                    <label for="" class="col-md-4 col-form-label text-md-right">Cantidad: </label>

                                    <div class="col-md-6 w-size16 flex-m flex-w">
                                        <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                            <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                        </button>

                                        <input class="size8 m-text18 t-center num-product cantidad" type="number" name="cantidad" value="{{$value['cantidad']}}">

                                        <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                            <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>

                                    <div class="col-md-6 w-size16 flex-m flex-r" style="margin: 5px; ">
                                        <button class="btn btn-success EditarCart" style="margin-right: 5px;" >Guardar</button>
                                       
                                        <!-- <a type="button" href="{{url('/borrar-producto-carrito/'.$idcart)}}" class="btn btn-danger BorrarProductoEspecifico" >Borrar</a> -->
                                    </div>
                                @endif 
                            </div>
  
                        </form>
                     
                        <form action="{{url('/borrar-producto-carrito')}}" method="post">
                        {{csrf_field()}}
                                    <div class="col-md-6 w-size16 flex-m flex-r" style="margin: 5px; ">
                                        <input type="hidden" name="id_carrito" idCart="{{$idcart}}" value="{{$idcart}}">
                                        
                                        <input type="hidden" class="sizefull s-text7 p-l-22 p-r-22 TipoTalla" type="text" TipoTalla="{{$value['tipo_talla']}}" name="tipo_talla" value="{{$value['tipo_talla']}}" readonly>
                                        @if($value['tipo_talla']=='accesorio')
                                        <input type="hidden" class="sizefull s-text7 p-l-22 p-r-22 TipoTalla" type="text" Talla="{{$value['tipo_talla']}}" name="talla" value="{{$value['talla']}}" readonly>

                                        @else
                                            <input type="hidden" class="sizefull s-text7 p-l-22 p-r-22 TipoTalla" type="text" Talla="{{$value['talla']}}" name="talla" value="{{$value['talla']}}" readonly>                             
                                         @endif   
                                        <button class="btn btn-danger BorrarProductoEspecifico" style="margin-right: 5px;" onclick="return confirm('¿Esta seguro de eliminar el producto?');" >Borrar</button>

                                    </div>
                        </form>                
                       @endforeach
						
				</div>
            </div>
</div>

 
<div id="dropDownSelect1"></div>
<div id="dropDownSelect2"></div>


<script type="text/javascript">
        
        var pais="";    

        $(document).ready(function()
        {
            // alert($(this).getAttribute("TipoTalla").val);
               var contenido="";
               $('.error').hide();
            //    
              pais=document.getElementsByClassName("TipoTalla").value;  
               
              console.log(pais +" la tipó talla");
               // console.log('el pais es: '+pais);
               if(pais=="MXN_sombrero")
               {
                   contenido+='<option value="">Elija una Opción</option>';
                   contenido+='<option value="60">60</option>';
                   contenido+='<option value="59">59</option>';
                   contenido+='<option value="58">58</option>';
                   contenido+='<option value="57">57</option>';
                   contenido+='<option value="56">56</option>';
                   contenido+='<option value="55">55</option>';
                   contenido+='<option value="54">54</option>';
                   contenido+='<option value="53">53</option>'; 
                   $('.talla_size').html(contenido);
                   $('.textoTalla').html('Talla MXN');
                   
                   // $('#USA_som').hide();
                   // $('#MXN_som').show();
                   // $('#USA').hide();
                   // $('#MXN').hide();
   
               }else if(pais=="USA_sombrero")
               {
                   contenido+='<option value="">Elija una Opción</option>'
                   contenido+='<option value="7 1/2">7 1/2</option>'
                   contenido+='<option value="7 3/8">7 3/8</option>'
                   contenido+='<option value="7 1/4">7 1/4</option>'
                   contenido+='<option value="7 1/8">7 1/8</option>'
                   contenido+='<option value="7">7</option>'
                   contenido+='<option value="6 7/8">6 7/8</option>'
                   contenido+='<option value="6 3/4">6 3/4</option>'
                   contenido+='<option value="6 5/8">6 5/8</option>'
                   $('.talla_size').html(contenido);
                   $('.textoTalla').html('Talla USA');
                   // $('#USA_som').show();
                   // $('#MXN_som').hide();
                
   
               }else if(pais=="MXN")
               {
                   contenido+='<option value="">Elija una Opción</option>';
                   contenido+='<option value="S">Chico S</option>';
                   contenido+='<option value="M">Mediano M</option>';
                   contenido+='<option value="L">Grande L</option>';
                   contenido+='<option value="XL">Grande XL</option>';
                   $('.talla_size').html(contenido);
                   $('.textoTalla').html('Talla MXN');
                   // $('#USA').hide();
                   // $('#MXN').show();
   
               }else if(pais=="USA")
               {   
                   contenido+='<option value="">Elija una Opción</option>';
                   contenido+='<option value="S">Small S</option>';
                   contenido+='<option value="M">Medium M</option>';
                   contenido+='<option value="L">Large L</option>';
                   contenido+='<option value="XL">XL Large</option>';
                   $('.talla_size').html(contenido);
                   $('.textoTalla').html('Talla USA');
                   // $('#USA').show();
                   // $('#MXN').hide();
                 
               }else if(pais=="MXN_Botas para caballero")
               {
                   contenido+='<option value="">Elija una Opción</option>'
                   contenido+='<option value="30">30</option>'
                   contenido+='<option value="29.5">29.5</option>'
                   contenido+='<option value="29">29</option>'
                   contenido+='<option value="28.5">28.5</option>'
                   contenido+='<option value="28">28</option>'
                   contenido+='<option value="27.5">27.5</option>'
                   contenido+='<option value="27">27</option>'
                   contenido+='<option value="26.5">26.5</option>'
                   contenido+='<option value="26">26</option>'
                   contenido+='<option value="25.5">25.5</option>'
                   contenido+='<option value="25">25</option>'
                   $('.talla_size').html(contenido);
                   $('.textoTalla').html('Talla MXN');
                   // $('#USA_zap').hide();
                   // $('#MXN_zap').show();
               }else if(pais=="USA_Botas para caballero")
               {
                   contenido+='<option value="">Elija una Opción</option>'
                   contenido+='<option value="11">11</option>'
                   contenido+='<option value="10.5">10.5</option>'
                  contenido+='<option value="10">10</option>'
                   contenido+='<option value="9.5">9.5</option>'
                   contenido+='<option value="9">9</option>'
                   contenido+='<option value="8.5">8.5</option>'
                   contenido+='<option value="8">8</option>'
                   contenido+='<option value="7.5">7.5</option>'
                   contenido+='<option value="7">7</option>'
                   contenido+='<option value="6.5">6.5</option>'
                   contenido+='<option value="6">6</option>'
                   $('.talla_size').html(contenido);
                   $('.textoTalla').html('Talla USA');
                   // $('#USA_zap').show();
                   // $('#MXN_zap').hide();
               }else if(pais=="MXN_Botas para damas")
               {
                   contenido+='<option value="">Elija una Opción</option>  '                                           
                   contenido+='<option value="27">27</option>'
                   contenido+='<option value="26.5">26.5</option>'
                   contenido+='<option value="26">26</option>'
                   contenido+='<option value="25.5">25.5</option>'
                   contenido+='<option value="25">25</option>'
                   contenido+='<option value="24.5">24.5</option>'
                   contenido+='<option value="24">24</option>'
                   contenido+='<option value="23.5">23.5</option>'
                   contenido+='<option value="23">23</option>'
                   contenido+='<option value="22.5">22.5</option>'
                   contenido+='<option value="22">22</option>'
                   $('.talla_size').html(contenido);
                   $('.textoTalla').html('Talla MXN');
               }else if(pais=="USA_Botas para damas")
               {
                   contenido+='<option value="">Elija una Opción</option>'
                   contenido+='<option value="10">10</option>'
                   contenido+='<option value="9.5">9.5</option>'
                   contenido+='<option value="9">9</option>'
                   contenido+='<option value="8.5">8.5</option>'
                   contenido+='<option value="8">8</option>'
                   contenido+='<option value="7.5">7.5</option>'
                   contenido+='<option value="7">7</option>'
                   contenido+='<option value="6.5">6.5</option>'
                   contenido+='<option value="6">6</option>'
                   contenido+='<option value="5.5">5.5</option>'
                   contenido+='<option value="5">5</option>'
                   $('.talla_size').html(contenido);
                   $('.textoTalla').html('Talla USA');
               }else if(pais=="MXN_Botas para niños")
               {
                   contenido+='<option value="">Elija una Opción</option>'
                   contenido+='<option value="24">24</option>'
                   contenido+='<option value="23.5">23.5</option>'
                   contenido+='<option value="23">23</option>'
                   contenido+='<option value="22.5">22.5</option>'
                   contenido+='<option value="22">22</option>    '                                                                                          
                   contenido+='<option value="21.5">21.5</option>'
                   contenido+='<option value="21">21</option>'
                   contenido+='<option value="20.5">20.5</option>'
                   contenido+='<option value="20">20</option>'
                   contenido+='<option value="19.5">19.5</option>'
                   contenido+='<option value="19">19</option>'
                   contenido+='<option value="18.5">18.5</option>'
                   contenido+='<option value="18">18</option>'
                   contenido+='<option value="17.5">17.5</option> ' 
                   contenido+='<option value="17">17</option>'
                   contenido+='<option value="16.5">16.5</option>'
                   contenido+='<option value="16">16</option>'
                   contenido+='<option value="15.5">15.5</option>'
                   contenido+='<option value="15">15</option>'
                   contenido+='<option value="14.5">14.5</option>'
                   contenido+='<option value="14">14</option>'
                   contenido+='<option value="13.5">13.5</option>'
                   contenido+='<option value="13">13</option>'
                   contenido+='<option value="12.5">12.5</option>'
                   contenido+='<option value="12">12</option>   '                                             
                   contenido+='<option value="11.5">11.5</option>'
                   contenido+='<option value="11">11</option>'
                   contenido+='<option value="10">10</option>'
                   $('.talla_size').html(contenido);
                   $('.textoTalla').html('Talla MXN');
               }else if(pais=="USA_Botas para niños")
               {
                   contenido+='<option value="">Elija una Opción</option>'
                   contenido+='<option value="4">4</option>'
                   contenido+='<option value="3.5">3.5</option>'
                   contenido+='<option value="3">3</option>'
                   contenido+='<option value="2.5">2.5</option>'
                   contenido+='<option value="2">2</option>'
                   contenido+='<option value="1.5">1.5</option>'
                   contenido+='<option value="1">1</option>'
                   contenido+='<option value="13.5">13.5</option>'
                   contenido+='<option value="13">13</option>'
                   contenido+='<option value="12.5">12.5</option>'
                   contenido+='<option value="12">12</option>'
                   contenido+='<option value="11.5">11.5</option>'
                   contenido+='<option value="10">10</option>'
                   contenido+='<option value="9.5">9.5</option>'
                   contenido+='<option value="9">9</option>'
                   contenido+='<option value="8.5">8.5</option>'
                   contenido+='<option value="8">8</option>'
                   contenido+='<option value="7.5">7.5</option>'
                   contenido+='<option value="7">7</option>'
                   contenido+='<option value="6.5">6.5</option>'
                   contenido+='<option value="6">6</option>'
                   contenido+='<option value="5.5">5.5 (12.5 mxn)</option>'
                   contenido+='<option value="5.5">5.5 (12 mxn)</option>'
                   contenido+='<option value="5">5</option>'
                   contenido+='<option value="4">4</option>'
                   contenido+='<option value="3">3</option>'
                   $('.talla_size').html(contenido);
                   $('.textoTalla').html('Talla USA');
               }
   
        })
   
       
        // $('.btn-num-product-up').on('click',function(){
        //     var cantidad=$(this).attr('.cantidad').val();
        //     cantidad++;
        //     var id=$(this).attr('idCart');
        //     var datos  = new FormData();
        //     datos.append("cantidad",cantidad);
        //     datos.append("id",id);
        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url:"/ajax/producto/cantidad-exitencia",
        //         method:"POST",
        //         data: datos,
        //         cache:false,
        //         contentType:false,
        //         processData:false,
        //         dataType:"json",
        //         success:function(respuesta)
        //         {
                    
        //             if(respuesta==0){                                   
        //             swal('Error', "¡Ha superado la cantidad existente del producto!", "error").then((value) => {
        //                 clearTimeout(3000);
        //                 // window.location.reload();
        //             });
                    
        //             }
        //         }
        //     })
        // });
   
   
   






</script>

@endsection