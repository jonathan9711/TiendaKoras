<div class="content">
    <h1>Compra de Prueba</h1>
    <h3>US$ 19.99</h3>
    <form action="/pago" method="POST">
        {{ csrf_field() }}
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ config('services.stripe.key') }}"
            data-amount="1990"
            data-name="Compra"
            data-description="Prueba compra"
            data-image="{{asset('vistas/img/plantilla/logo.png')}}"
            data-locale="auto">
        </script>
    </form>
</div>

<form action="/pago" method="POST">
{{csrf_field()}}
  <script
    src="https://checkout.stripe.com/checkout.js"
    class="stripe-button"
    
    email="aaa@"
    data-key="pk_test_51Hj9TgAM7dOeIYK920nHt1q8PquzYxXWJ71eIvfNn58BL6J2YAgaVS41vQBLZ0ylNbWOrYxkzU7iBvaWD7o9GfZS00mum5vx2I"
    data-name="Custom t-shirt"
    data-description="Your custom designed t-shirt"
    data-amount="1990"
    data-currency="mxn">
  </script>
</form>