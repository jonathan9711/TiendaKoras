<div class="container">
           
           <header>
               <h1>Login and Registration Form</h1>
               
           </header>
           <section>				
               <div id="container_demo" >
                   <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                   <a class="hiddenanchor" id="toregister"></a>
                   <a class="hiddenanchor" id="tologin"></a>
                   <div id="wrapper">
                       <div id="login" class="animate form">
                           <form  action="mysuperscript.php" autocomplete="on"> 
                               <h1>Log in</h1> 
                               <p> 
                                   <label for="username" class="uname" > Your email or username </label>
                                   <input id="username" name="username" required="required" type="text" placeholder="myusername or mymail@mail.com"/>
                               </p>
                               <p> 
                                   <label for="password" class="youpasswd"> Your password </label>
                                   <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                               </p>
                               <p class="keeplogin"> 
                                   <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
                                   <label for="loginkeeping">Keep me logged in</label>
                               </p>
                               <p class="login button"> 
                                  <a href="http://cookingfoodsworld.blogspot.in/" target="_blank" ></a>
                               </p>
                               <p class="change_link">
                                   Not a member yet ?
                                   <a href="#toregister" class="to_register">Join us</a>
                               </p>
                           </form>
                       </div>

                       <div id="register" class="animate form">
                           <form  action="mysuperscript.php" autocomplete="on"> 
                               <h1> Sign up </h1> 
                               <p> 
                                   <label for="usernamesignup" class="uname" >Your username</label>
                                   <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="mysuperusername690" />
                               </p>
                               <p> 
                                   <label for="emailsignup" class="youmail"  > Your email</label>
                                   <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="mysupermail@mail.com"/> 
                               </p>
                               <p> 
                                   <label for="passwordsignup" class="youpasswd" >Your password </label>
                                   <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="eg. X8df!90EO"/>
                               </p>
                               <p> 
                                   <label for="passwordsignup_confirm" class="youpasswd" >Please confirm your password </label>
                                   <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="eg. X8df!90EO"/>
                               </p>
                               <p class="signin button"> 
                                   <input type="submit" value="Sign up"/> 
                               </p>
                               <p class="change_link">  
                                   Already a member ?
                                   <a href="#tologin" class="to_register"> Go and log in </a>
                               </p>
                           </form>
                       </div>
                       
                   </div>
               </div>  
           </section>
       </div>


login normal
       <div class="card">
    <div class="card-body">
        <div class="col-md-4">
            <label for="">Correo</label>
            <input type="email"  name="email" id="email">
            {!! $errors->first('email','<div class="invalid-feedback">:message</div>') !!}

            <label for="">Contraseña</label>
            <input type="password"  name="password" id="password">
            {!! $errors->first('password','<div class="invalid-feedback">:message</div>') !!}

            <input type="submit" value="Registrarse">
        </div>
    </div>
    
</div>




<form action="{{url('/registrarse')}}" method="POST">
{{csrf_field()}}
    <label for="">nombre</label>
    <input type="text"  name="nombre" id="nombre">
    {!! $errors->first('nombre','<div class="invalid-feedback">:message</div>') !!}

    <label for="">apellido</label>
    <input type="text"  name="apellido" id="apellido">
    {!! $errors->first('apellido','<div class="invalid-feedback">:message</div>') !!}

    <label for="">direccion</label>
    <input type="text"  name="direccion">
    {!! $errors->first('direccion','<div class="invalid-feedback">:message</div>') !!}

    <label for="">RFC</label>
    <input type="text"  name="RFC">
    {!! $errors->first('RFC','<div class="invalid-feedback">:message</div>') !!}

    <label for="">ciudad</label>
    <input type="text"  name="ciudad" id="ciudad">
    {!! $errors->first('ciudad','<div class="invalid-feedback">:message</div>') !!}

    <label for="">Correo</label>
    <input type="email"  name="email" id="email">
    {!! $errors->first('email','<div class="invalid-feedback">:message</div>') !!}

    <label for="">Contraseña</label>
    <input type="password"  name="password" id="password">
    {!! $errors->first('password','<div class="invalid-feedback">:message</div>') !!}

    <label for="">Telefono</label>
    <input type="telefono"  name="telefono" id="telefono">
    {!! $errors->first('telefono','<div class="invalid-feedback">:message</div>') !!}


    <label for="">Compras</label>
    <input type="text" name="compras" readonly="readonly" value=0>

    <label for="">Fecha</label>
    <input type="date" name="ultima_compra" >

   

    <input type="submit" value="Registrarse">
</form>