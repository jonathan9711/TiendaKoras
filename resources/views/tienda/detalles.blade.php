@extends('plantilla.plantilla')

@section('contenido')
    <!-- Product Detail -->
    <form action="" method="" name="datos">
        <div class="container bgwhite p-t-35 p-b-80">
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
                            {{$producto->nombre}}
                        </h4>

                        <span class="m-text17">
                            
                        </span>

                        <!--  -->
                        <div class="p-t-33 p-b-60">

                            <div class="flex-m flex-w p-b-10">
                                <div class="s-text15 w-size15 t-center">
                                    Opciones para tallas
                                </div>

                                <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                    <select class="selection-2" id="tallapais" name="tallapais" onChange="opcionesTalla()">
                                        <option value="">Elija una Opción</option>
                                         @foreach($categoriaProducto as $categoria)
                                            
                                            @if($categoria->categoria=="Botas para caballero" ||$categoria->categoria=="Botas para Caballero" || $categoria->categoria=="Botas para Damas" ||$categoria->categoria=="Botas para damas"
                                            || $categoria->categoria=="Botas para Niños" ||$categoria->categoria=="Botas para niños")
                                                <option value="MXN_calzado">MXN</option>
                                                <option value="USA_calzado">USA</option>
                                           
                                            @elseif($categoria->categoria=="Sombreros" || $categoria->categoria=="sombreros" || $categoria->categoria=="Texanas" || $categoria->categoria=="texanas"
                                            || $categoria->categoria=="Gorras" || $categoria->categoria=="gorras")
                                                <option value="MXN_sombrero">MXN Sombreros, Gorras</option>
                                                <option value="USA_sombrero">USA Sombreros, Gorras</option>
                                            @elseif($categoria->categoria!="Sombreros" && $categoria->categoria!="sombreros" && $categoria->categoria!="Texanas" && $categoria->categoria!="texanas"
                                            && $categoria->categoria!="Gorras" && $categoria->categoria!="gorras")
                                                <option value="MXN">MXN</option>
                                                <option value="USA">USA</option>
                                            
                                            @endif
                                        @endforeach 
                                    </select>
                                   
                                </div>
                            </div>
                           <!-- talla generica mexicana -->
                            <div class="flex-m flex-w p-b-10" id="USA"> 
                                @if($producto->id_categoria)
                                    <div class="s-text15 w-size15 t-center">
                                        Talla USA
                                    </div>

                                    <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                        <select class="selection-2" name="size">
                                            <option value="">Elija una Opción</option>
                                            <option value="S">Small S</option>
                                            <option value="M">Medium M</option>
                                            <option value="L">Large L</option>
                                            <option value="XL">XL Large</option>
                                        </select>
                                    </div>
                                @endif 
                            </div>

                            <!-- talla generica americana -->
                            <div class="flex-m flex-w p-b-10" id="MXN" name="MXN"> 
                                @if($producto->id_categoria)
                                    <div class="s-text15 w-size15 t-center">
                                        Talla MXN
                                    </div>

                                    <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                        <select class="selection-2" name="size">
                                            <option value="">Elija una Opción</option>
                                            <option value="S">Chico S</option>
                                            <option value="M">Mediano M</option>
                                            <option value="L">Grande L</option>
                                            <option value="XL">Grande XL</option>
                                        </select>
                                    </div>
                                @endif 
                            </div>

                            <!-- tallas de sombreros mexicana -->
                            @foreach($categoriaProducto as $categoria)
                                @if($categoria->categoria=="Sombreros" || $categoria->categoria=="sombreros" || $categoria->categoria=="Texanas" || $categoria->categoria=="texanas"
                                || $categoria->categoria=="Gorras" || $categoria->categoria=="gorras")
                                    <!-- tallas de sombreros mexicana -->
                                    <div class="flex-m flex-w p-b-10" id="MXN_som"  name="MXN_som"> 
                                    
                                            <div class="s-text15 w-size15 t-center">
                                                Talla MXN
                                            </div>

                                            <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                                <select class="selection-2" name="size">
                                                    <option value="0">Elija una Opción</option>
                                                    <option value="60">60</option>
                                                    <option value="59">59</option>
                                                    <option value="58">58</option>
                                                    <option value="57">57</option>
                                                    <option value="56">56</option>
                                                    <option value="55">55</option>
                                                    <option value="54">54</option>
                                                    <option value="53">53</option>
                                                </select>
                                            </div>
                                    
                                    </div>
                                    <!-- tallas de sombreros americana -->
                                    <div class="flex-m flex-w p-b-10" id="USA_som"  name="USA_som"> 
                                
                                        <div class="s-text15 w-size15 t-center">
                                            Talla USA
                                        </div>

                                        <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                            <select class="selection-2" name="size">
                                                <option value="0">Elija una Opción</option>
                                                <option value="7 1/2">7 1/2</option>
                                                <option value="7 3/8">7 3/8</option>
                                                <option value="7 1/4">7 1/4</option>
                                                <option value="7 1/8">7 1/8</option>
                                                <option value="7">7</option>
                                                <option value="6 7/8">6 7/8</option>
                                                <option value="6 3/4">6 3/4</option>
                                                <option value="6 5/8">6 5/8</option>
                                            </select>
                                        </div>
                                    </div>
                                     <!--colores para sombreros  -->
                                    <div class="flex-m flex-w">
                                        <div class="s-text15 w-size15 t-center">
                                            Color
                                        </div>
                                        

                                        <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                            <select class="selection-2" name="color">
                                                <option value="">Elija una Opción</option>
                                                <option value="Tabaco">Tabaco</option>
                                                <option value="Negro">Negro</option>
                                                <option value="Beige">Beige</option>
                                                <option value="Gris">Gris</option>
                                                <option value="Rojo">Rojo</option>
                                                <option value="Camel">Camel</option>
                                                <option value="Cafe Chocolate">Cafe Chocolate</option>
                                                <option value="Vino">Vino</option>
                                                <option value="Verde Militar">Verde Militar</option>
                                                <option value="Amarillo">Amarillo</option>
                                                <option value="Azul Marino">Azul Marino</option>
                                            </select>
                                        </div>
                                    </div>

                                @endif
                            @endforeach

                            @foreach($categoriaProducto as $categoria)
                                @if($categoria->categoria=="Botas para caballero"|| $categoria->categoria=="Botas para Caballero" || $categoria->categoria=="botas para caballero")
                                    <!-- tallas de calzado hombre mexicana -->
                                    <div class="flex-m flex-w p-b-10" id="MXN_zap"  name="MXN_zap"> 
                                    
                                            <div class="s-text15 w-size15 t-center">
                                                Talla Calzado MXN
                                            </div>

                                            <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                                <select class="selection-2" name="size">
                                                    <option value="0">Elija una Opción</option>
                                                    <option value="30">30</option>
                                                    <option value="29.5">29.5</option>
                                                    <option value="29">29</option>
                                                    <option value="28.5">28.5</option>
                                                    <option value="28">28</option>
                                                    <option value="27.5">27.5</option>
                                                    <option value="27">27</option>
                                                    <option value="26.5">26.5</option>
                                                    <option value="26">26</option>
                                                    <option value="25.5">25.5</option>
                                                    <option value="25">25</option>
                                                </select>
                                            </div>
                                    
                                    </div>
                                    <!-- tallas de sombreros hombre americana -->
                                    <div class="flex-m flex-w p-b-10" id="USA_zap"  name="USA_zap"> 
                                
                                        <div class="s-text15 w-size15 t-center">
                                            Talla Calzado USA
                                        </div>

                                        <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                            <select class="selection-2" name="size">
                                                <option value="0">Elija una Opción</option>
                                                <option value="11">11</option>
                                                <option value="10.5">10.5</option>
                                                <option value="10">10</option>
                                                <option value="9.5">9.5</option>
                                                <option value="9">9</option>
                                                <option value="8.5">8.5</option>
                                                <option value="8">8</option>
                                                <option value="7.5">7.5</option>
                                                <option value="7">7</option>
                                                <option value="6.5">6.5</option>
                                                <option value="6">6</option>
                                            </select>
                                        </div>
                                    </div>
                                   
                                @elseif($categoria->categoria=="Botas para Damas" || $categoria->categoria=="Botas para damas"|| $categoria->categoria=="botas para damas")
                                   <!-- tallas de calzado dama mexicana -->
                                   <div class="flex-m flex-w p-b-10" id="MXN_zap"  name="MXN_zap"> 
                                    
                                        <div class="s-text15 w-size15 t-center">
                                            Talla Calzado MXN
                                        </div>

                                        <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                            <select class="selection-2" name="size">
                                                <option value="0">Elija una Opción</option>                                             
                                                <option value="27">27</option>
                                                <option value="26.5">26.5</option>
                                                <option value="26">26</option>
                                                <option value="25.5">25.5</option>
                                                <option value="25">25</option>
                                                <option value="24.5">24.5</option>
                                                <option value="24">24</option>
                                                <option value="23.5">23.5</option>
                                                <option value="23">23</option>
                                                <option value="22.5">22.5</option>
                                                <option value="22">22</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- tallas de sombreros dama americana -->
                                    <div class="flex-m flex-w p-b-10" id="USA_zap"  name="USA_zap"> 
                                
                                        <div class="s-text15 w-size15 t-center">
                                            Talla Calzado USA
                                        </div>

                                        <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                            <select class="selection-2" name="size">
                                                <option value="0">Elija una Opción</option>
                                                <option value="10">10</option>
                                                <option value="9.5">9.5</option>
                                                <option value="9">9</option>
                                                <option value="8.5">8.5</option>
                                                <option value="8">8</option>
                                                <option value="7.5">7.5</option>
                                                <option value="7">7</option>
                                                <option value="6.5">6.5</option>
                                                <option value="6">6</option>
                                                <option value="5.5">5.5</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                @elseif($categoria->categoria=="Botas para Niños" || $categoria->categoria=="Botas para niños"|| $categoria->categoria=="botas para niños")
                                    <!-- tallas de calzado niños mexicana -->
                                    <div class="flex-m flex-w p-b-10" id="MXN_zap"  name="MXN_zap"> 
                                    
                                        <div class="s-text15 w-size15 t-center">
                                            Talla Calzado MXN
                                        </div>

                                        <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                            <select class="selection-2" name="size">
                                                <option value="0">Elija una Opción</option>
                                                <option value="24">24</option>
                                                <option value="23.5">23.5</option>
                                                <option value="23">23</option>
                                                <option value="22.5">22.5</option>
                                                <option value="22">22</option>                                                                                              
                                                <option value="21.5">21.5</option>
                                                <option value="21">21</option>
                                                <option value="20.5">20.5</option>
                                                <option value="20">20</option>
                                                <option value="19.5">19.5</option>
                                                <option value="19">19</option>
                                                <option value="18.5">18.5</option>
                                                <option value="18">18</option>
                                                <option value="17.5">17.5</option>  
                                                <option value="17">17</option>
                                                <option value="16.5">16.5</option>
                                                <option value="16">16</option>
                                                <option value="15.5">15.5</option>
                                                <option value="15">15</option>
                                                <option value="14.5">14.5</option>
                                                <option value="14">14</option>
                                                <option value="13.5">13.5</option>
                                                <option value="13">13</option>
                                                <option value="12.5">12.5</option>
                                                <option value="12">12</option>                                                
                                                <option value="11.5">11.5</option>
                                                <option value="11">11</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                    
                                    </div>

                                    <!-- tallas de Calzado niños americana -->
                                    <div class="flex-m flex-w p-b-10" id="USA_zap"  name="USA_zap"> 
                                
                                        <div class="s-text15 w-size15 t-center">
                                            Talla Calzado USA
                                        </div>

                                        <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                                            <select class="selection-2" name="size">
                                                <option value="0">Elija una Opción</option>
                                                <option value="4">4</option>
                                                <option value="3.5">3.5</option>
                                                <option value="3">3</option>
                                                <option value="2.5">2.5</option>
                                                <option value="2">2</option>
                                                <option value="1.5">1.5</option>
                                                <option value="1">1</option>
                                                <option value="13.5">13.5</option>
                                                <option value="13">13</option>
                                                <option value="12.5">12.5</option>
                                                <option value="12">12</option>
                                                <option value="11.5">11.5</option>
                                                <option value="10">10</option>
                                                <option value="9.5">9.5</option>
                                                <option value="9">9</option>
                                                <option value="8.5">8.5</option>
                                                <option value="8">8</option>
                                                <option value="7.5">7.5</option>
                                                <option value="7">7</option>
                                                <option value="6.5">6.5</option>
                                                <option value="6">6</option>
                                                <option value="5.5">5.5 (12.5 mxn)</option>
                                                <option value="5.5">5.5 (12 mxn)</option>
                                                <option value="5">5</option>
                                                <option value="4">4</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            <div class="flex-r-m flex-w p-t-10">
                                <div class="w-size16 flex-m flex-w">
                                    <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                                        <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                            <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                        </button>

                                        <input class="size8 m-text18 t-center num-product" type="number" name="num-product" value="1">

                                        <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                            <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>

                                    <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                                        <!-- Button -->
                                        <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                    Añadir al carrito
                                        </button>
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
                                                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                                    </a>

                                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                                        <!-- Button -->
                                                        <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                            Añadir al carrito
                                                        </button>
                                                    </div>
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
    </form>
    
    <div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>


    <script type="text/javascript">
        
     
        function opcionesTalla() 
        {
           
            var pais= document.getElementById("tallapais").value;
            if(pais=="MXN_sombrero")
            {
                $('#USA_som').hide();
                $('#MXN_som').show();
                $('#USA').hide();
                $('#MXN').hide();

            }else if(pais=="USA_sombrero")
            {
                $('#USA_som').show();
                $('#MXN_som').hide();
             

            }else if(pais=="MXN")
            {
                $('#USA').hide();
                $('#MXN').show();

            }else if(pais=="USA")
            {
                $('#USA').show();
                $('#MXN').hide();
              
            }else if(pais=="MXN_calzado")
            {
                $('#USA_zap').hide();
                $('#MXN_zap').show();
            }else if(pais=="USA_calzado")
            {
                $('#USA_zap').show();
                $('#MXN_zap').hide();
            }else if(pais=="")
            {
                $('#USA').hide();
                $('#MXN').hide();
                $('#USA_som').hide();
                $('#MXN_som').hide();
                $('#USA_zap').hide();
                $('#MXN_zap').hide();
            }

        }

    </script>

@endsection