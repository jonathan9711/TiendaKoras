
@if(Session::has('Mensaje'))

<script type="text/javascript">
        $(document).ready(function()
        {
            @if(session()->get('Mensaje'))
                // toastr.success('{{session()->get("Mensaje")}}');
                alert('{{session()->get("Mensaje")}}');
            @endif
        })
        
</script>


@endif

<form action="{{url('/cliente')}}" method="POST">
{{csrf_field()}}
    <label for="">nombre</label>
    <input type="text"  name="nombre">

    <label for="">apellido</label>
    <input type="text"  name="apellido">

    <label for="">direccion</label>
    <input type="text"  name="direccion">

    <label for="">RFC</label>
    <input type="text"  name="RFC">

    <label for="">ciudad</label>
    <input type="text"  name="ciudad">

    <label for="">Correo</label>
    <input type="email"  name="email">

    <label for="">telefono</label>
    <input type="text" name="telefono">

   

    <input type="submit" value="Registrarse">
</form>