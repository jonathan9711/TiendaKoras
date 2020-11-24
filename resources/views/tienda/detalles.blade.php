@extends('plantilla.plantilla')

@section('contenido')

    <!-- Product Detail action="{{url('/producto/agregar-producto-carrito')}}"-->

        <div class="container bgwhite p-t-35 p-b-80">
        <div class="btn-group">
                                            
            <script type="text/javascript">

            function volver()
            {
                window.location = "/";
            }

            </script>

            <button class="btn btn-danger" onclick="volver()"><i class="fa fa-fw fa-arrow-circle-left"></i>Seguir Comprando</button>

        </div>
            @foreach($productos as $producto)
                <div class="flex-w flex-sb">
                    <div class="w-size13 p-t-30 respon5">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>

                            <div class="slick3">
                                <div class="item-slick3" data-thumb="{{asset($producto->imagen)}}">
                                    <div class="wrap-pic-w">
                                        <img src="{{asset($producto->imagen)}}" alt="IMG-PRODUCT">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-size14 p-t-30 respon5">
                        <h4 class="product-detail-name m-text16 p-b-13">
                            {{$producto->nombre}} ${{$producto->precio_venta}}
                        </h4>
                        <input type="hidden" class="block2-name dis-block s-text3 p-b-5" value="{{$producto->nombre}}"></input>
                        <input type="hidden" class="block2-name dis-block s-text3 p-b-5" name='idproduct' id="idproduct" value="{{$producto->id_producto}}"></input>
						
                        <span class="m-text17">
                        <!-- <p class="error" style="color:white;">{{ $errors->first('size')}} </p> -->
                        <p id="Errores" class="error" style="color:red;">{{ $errors->first()}} </p>
                        </span>

                        <!--  --> 
                        
                        <div class="p-t-33 p-b-60 contenido_tallas">
                            @foreach($categoriaProducto as $categoria)
                            <input type="hidden" class="block2-name dis-block s-text3 p-b-5" name='categoria' value="{{$categoria->categoria}}"></input>

                             @if($categoria->categoria!="Accesorios")
                            <div class="flex-m flex-w p-b-10">
                           
                                <div class="s-text15 w-size15 t-center">
                                    Opciones para tallas
                                </div>

                                <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                    <select class="selection-2" id="tallapais" name="tallapais" onChange="opcionesTalla()">
                                        <option value="">Elija una Opción</option>
                                        
                                        
                                           
                                                @if($categoria->categoria=="Botas para caballero" ||$categoria->categoria=="Botas para Caballero" || $categoria->categoria=="Botas para Damas" ||$categoria->categoria=="Botas para damas"
                                                || $categoria->categoria=="Botas para Niños" ||$categoria->categoria=="Botas para niños")
                                                    <option value="MXN_{{$categoria->categoria}}">MXN Calzado</option>
                                                    <option value="USA_{{$categoria->categoria}}">USA Calzado</option>

                                                @elseif($categoria->categoria=="Sombreros" || $categoria->categoria=="sombreros" || $categoria->categoria=="Texanas" || $categoria->categoria=="texanas"
                                                || $categoria->categoria=="Gorras" || $categoria->categoria=="gorras")
                                                    <option value="MXN_sombrero">MXN Sombreros, Gorras</option>
                                                    <option value="USA_sombrero">USA Sombreros, Gorras</option>

                                                @elseif($categoria->categoria!="Sombreros" && $categoria->categoria!="sombreros" && $categoria->categoria!="Texanas" && $categoria->categoria!="texanas"
                                                && $categoria->categoria!="Gorras" && $categoria->categoria!="gorras")
                                                    <option value="MXN">MXN</option>
                                                    <option value="USA">USA</option>
                                            
                                                @endif
                                            
                                       
                                    </select>
                                </div>
                            </div>
                           <!-- talla generica mexicana -->
                            <div class="flex-m flex-w p-b-10" id=""> 
                               
                                    <div class="s-text15 w-size15 t-center textoTalla">
                                        Talla
                                    </div>

                                    <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                        <select class="selection-2 talla_size" id="talla" name="size">
                                            <option value="">Elija una Opción de talla primero</option>
                                                                                        
                                        </select>
                                    </div>
                               
                            </div>
                            @endif
                            @endforeach 
                 
                            <!-- contenido tallas -->
                            <div class="flex-r-m flex-w p-t-10">
                                <div class="w-size16 flex-m flex-w">
                                    <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                                        <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                            <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                        </button>

                                        <input class="size8 m-text18 t-center num-product" type="number" id="cantidad" name="cantidad" value="1">

                                        <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                            <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                   

                                </div>
                                
                                <div class="w-size16 flex-m flex-w">
                                   
                                    <div class="btn-addcart size9  size9 trans-0-4 m-t-10 m-b-10 añadircarrito">
                                        <!-- Button -->
                                        <button  class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4 addtoCart" value="{{$producto->id_producto}}">
                                                    Añadir al carrito
                                        </button>
                                        <br>
                                       
                                        <!-- <a type="button" href="{{route('inicio')}}"  class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" >
                                                   Seguir Comprando
                                        </a> -->

                                       
                                    </div>
                                </div>
                                    
                            </div>
                        </div>

                      

                        <div class="p-b-45">
                            <!-- <span class="s-text8 m-r-35">SKU: MUG-01</span> -->
                            <span class="s-text8">Marca: {{$producto->marca}} </span>
                        </div>

                        <!--  -->
                        <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                            <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                                Descripción
                                <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                                <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                            </h5>

                            <div class="dropdown-content dis-none p-t-15 p-b-23">
                                <p class="s-text8">
                                    {{$producto->descripcion}}
                                </p>
                            </div>
                        </div>

                    
                    </div>
                </div>
            @endforeach
        </div>
    <!-- </form> -->
        <!-- Relate Product -->
        <section class="relateproduct bgwhite p-t-45 p-b-138">
            <div class="container">
                <div class="sec-title p-b-60">
                    <h3 class="m-text5 t-center">
                        Productos Relacionados
                    </h3>
                </div>

                <!-- Slide2 -->
                <div class="wrap-slick2">
                    <div class="slick2">
                        @foreach($allproductos as $todoproducto)
                            @foreach($productos as $producto)
                                @if($todoproducto->id_categoria==$producto->id_categoria)
                                    <div class="item-slick2 p-l-15 p-r-15">
                                        <!-- Block2 -->
                                        <div class="block2">
                                            <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                                <img src="{{asset($todoproducto->imagen)}}" alt="IMG-PRODUCT">

                                                <div class="block2-overlay trans-0-4">
                                                    <!-- <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                                    </a> -->

                                                    <div class="block2-btn-addcart w-size1 trans-0-4">
								
                                                        <a href="{{url('producto/'.$producto->id_producto.'/detalle')}}" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" value="{{$producto->id_producto}}">
                                                            Ver Producto
                                                        </a>
                                                    </div>
                                                    <!-- <div class="block2-btn-addcart w-size1 trans-0-4">
												
                                                        <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4 addtoCart" value="{{$producto->id_producto}}">
                                                            Añadir al carrito
                                                        </button>
                                                    </div> -->
                                                </div>
                                            </div>

                                            <div class="block2-txt p-t-20">
                                                <a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
                                                    {{$todoproducto->nombre}}
                                                </a>

                                                <span class="block2-price m-text6 p-r-5">
                                                    ${{$todoproducto->precio_venta}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>

            </div>
        </section>
    
    
    <div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>


    <div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>
                <h4>Crear</h4>
            </div>
            <div class="modal-body">
            <div class="form-group">

            <label for="ccnum">Number</label>

            <input type="text" name="ccnum" id="ccnum" class="form-control">

            </div>

            <div class="form-group">

            <label for="expiry">Expiry</label>

            <input type="text" name="expiry" id="expiry" class="form-control">

            </div>

            <div class="form-group">

            <label for="cvc">CVC</label>

            <input type="text" name="cvc" id="cvc" class="form-control">

            </div>

            <div class="form-group">

            <label for="numeric">Numeric</label>

            <input type="text" name="numeric" id="numeric" class="form-control">

            </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Guardar">
            </div>
        </div>
    </div>
</div>



    <script type="text/javascript">
        
     var pais="";
     
        function opcionesTalla() 
        {
            var contenido="";
            $('.error').hide();
            pais= document.getElementById("tallapais").value;
           
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

        }

        $('.añadircarrito').on('click',function(){
            tallapais= $("#tallapais").val();
            // console.log("la talla del pais: "+tallapais);
            
                // var size=$('.talla_size').change(function(event){
                //    alert(this.value);
                // });
                
                // alert(size);
                var nombre=$('.w-size14').parent().find('.block2-name').val();
                var id=$(this).find('.addtoCart').val();
                var cantidad=$('#cantidad').val();
                var talla=$('#talla').val();
                var tipo=$('#tallapais').val();
                var datos  = new FormData();
                    datos.append("idproduct",id);
                    datos.append("cantidad",cantidad);
                    datos.append("size",talla);
                    datos.append("tallapais",tipo);
                if(talla==''||tipo==''){
                    $('#Errores').html("Las Tallas Son Requeridas");
                }else{                   
                    // console.log(datos);
                   
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url:"/producto/agregar-producto-carrito",
                            method:"POST",
                            data: datos,
                            cache:false,
                            contentType:false,
                            processData:false,
                            dataType:"json",
                            success:function(respuesta)
                            {
                                if(respuesta===3){
                                    swal('Error', "¡Ha superado la cantidad existente del producto!", "error").then((value) => {
                                    clearTimeout(3000);
                                    // window.location.reload();
                                    });
                                }else if(respuesta===1){                                   
                                    swal(nombre, "¡Se ha agregado al carrito!", "success").then((value) => {
                                        clearTimeout(3000);
                                        window.location.reload();
                                    });
                                
                                }else{
                                    
                                    swal('Lo sentimos', "¡inicie sesion para agregar productos al carrito!", "error");
                                }
                            }
                        })
                        // swal(nameProduct, "¡Se ha agregado al carrito!", "success");
                        

                     
                }
                
            // }else{
            //     $(this).on('click', function(){
            //         swal('Lo sentimos', "¡elija una talla para añadir al carrito!", "error");
			//     });
                
            // }
            
		});

        $('.btn-num-product-up').on('click',function(){
            var cantidad=$('#cantidad').val();
            cantidad++;
            var id=$('#idproduct').val();
            var datos  = new FormData();
            datos.append("cantidad",cantidad);
            datos.append("id",id);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"/ajax/producto/cantidad-exitencia",
                method:"POST",
                data: datos,
                cache:false,
                contentType:false,
                processData:false,
                dataType:"json",
                success:function(respuesta)
                {
                    
                    if(respuesta==0){                                   
                    swal('Error', "¡Ha superado la cantidad existente del producto!", "error").then((value) => {
                        clearTimeout(3000);
                        // window.location.reload();
                    });
                    
                    }
                }
            })
        });



    </script>

@endsection



   