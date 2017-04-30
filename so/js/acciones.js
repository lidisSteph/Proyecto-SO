$(document).ready(function(){
    var parametros = "txt-archivo="+$("#txt-archivo").val()+"&"+"txt-ciclos="+$("#txt-ciclos").val();
            ///alert("Estamos ready, el DOM fue cargado");
            $("#btn-procesar").click(function(){
                // $("#btn-ingresar").button("loading");
                // $("#img-loading").fadeIn(200);
                 //formato similar a cuando se envia la informacion por GET
                //parametro1=valor1&parametro2=valor2&.....parametroN=valorN
                // alert("Informacion que se enviara: " + parametros);
                $.ajax({
                    url:"ajax/procesar.php?accion=0",
                    method:"POST",
                    data: parametros,
                    success:function(respuesta){
                        // if(respuesta){

                        // }else{
                            
                        // }
                        // $("#img-loading").fadeOut(200);
                        // $("#btn-ingresar").button("reset");
                       // $("#resultado").html(respuesta);
                    },
                    error:function(e){
                        alert("Ocurrio un error."+e);
                    }
                }); 
            });

             $("#a-bcp").click(function(){
                // $("#btn-ingresar").button("loading");
                // $("#img-loading").fadeIn(200);
                // var parametros = "txt-archivo="+$("#txt-archivo").val()+"&"+"txt-ciclos="+$("#txt-ciclos").val(); //formato similar a cuando se envia la informacion por GET
                //parametro1=valor1&parametro2=valor2&.....parametroN=valorN
                // alert("Informacion que se enviara: " + parametros);
                $.ajax({
                    url:"ajax/procesar.php?accion=1",
                    method:"POST",
                    data: parametros,
                    success:function(respuesta){
                        // $("#img-loading").fadeOut(200);
                        // $("#btn-ingresar").button("reset");
                        $("#tr-bcp").html(respuesta);
                    },
                    error:function(e){
                        alert("Ocurrio un error."+e);
                    }
                }); 
            }); 

            $("#a-listos").click(function(){
                // $("#btn-ingresar").button("loading");
                // $("#img-loading").fadeIn(200);
                // var parametros = "txt-archivo="+$("#txt-archivo").val()+"&"+"txt-ciclos="+$("#txt-ciclos").val(); //formato similar a cuando se envia la informacion por GET
                //parametro1=valor1&parametro2=valor2&.....parametroN=valorN
                // alert("Informacion que se enviara: " + parametros);
                $.ajax({
                    url:"ajax/procesar.php?accion=2",
                    method:"POST",
                    data: parametros,
                    success:function(respuesta){
                        // $("#img-loading").fadeOut(200);
                        // $("#btn-ingresar").button("reset");
                        $("#tr-listo").html(respuesta);
                    },
                    error:function(e){
                        alert("Ocurrio un error."+e);
                    }
                }); 
            }); 


            $("#btn-ejecutar").click(function(){
                // $("#btn-ingresar").button("loading");
                // $("#img-loading").fadeIn(200);
                // var parametros = "txt-archivo="+$("#txt-archivo").val()+"&"+"txt-ciclos="+$("#txt-ciclos").val(); //formato similar a cuando se envia la informacion por GET
                //parametro1=valor1&parametro2=valor2&.....parametroN=valorN
                // alert("Informacion que se enviara: " + parametros);
                $.ajax({
                    url:"ajax/procesar.php?accion=4",
                    method:"POST",
                    data: parametros,
                    success:function(respuesta){
                        // $("#img-loading").fadeOut(200);
                        // $("#btn-ingresar").button("reset");
                        $("#div-ejecutando").html(respuesta);
                    },
                    error:function(e){
                        alert("Ocurrio un error."+e);
                    }
                }); 
            });     

           
        });