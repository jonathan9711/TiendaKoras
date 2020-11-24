
<table>
	<tbody>
		<tr>
	</th>
		</tr>
	</tbody>
</table>
<div class="row">
	@foreach($productos as $producto)
	<div class="tarjeta col-md-6 col-lg-3 p-b-50" category="{{$producto->id_categoria}}">
		<!-- Block2 -->
		<div class="block2">
			<div class="block2-img wrap-pic-w of-hidden pos-relative">
				<img src="{{asset($producto->imagen)}}" alt="IMG-PRODUCT">

				<div class="block2-overlay trans-0-4">
					

					<div class="block2-btn-addcart w-size1 trans-0-4">
						
						<a href="{{url('producto/'.$producto->id_producto.'/detalle')}}" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" value="{{$producto->id_producto}}">
							Ver Producto
						</a>
					</div>
				</div>
			</div>

			<div class="block2-txt p-t-20">
				<a href="{{url('producto/'.$producto->id_producto.'/detalle')}}" class="block2-name dis-block s-text3 p-b-5">
					{{$producto->nombre}}
				</a>
				<p class="dis-block s-text3 p-b-5">
					{{$producto->descripcion}}
				</p>

				<span class="block2-price m-text6 p-r-5">
					${{$producto->precio_venta}}
				</span>
			</div>
		</div>
	</div>
	@endforeach
	
</div>

	
