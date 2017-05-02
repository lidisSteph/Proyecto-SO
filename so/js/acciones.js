$(document).ready(function(){
   
var a=0;
     
            $("#btn-procesar").click(function(){
                 var parametros = "txt-archivo="+$("#txt-archivo").val()+"&"+"txt-ciclos="+$("#txt-ciclos").val();
                alert(parametros);
         
                $.ajax({
                    url:"ajax/procesar.php?accion=0",
                    method:"POST",
                    data: parametros,
                    success:function(respuesta){
                       
                    },
                    error:function(e){
                        alert("Ocurrio un error."+e);
                    }
                }); 
            });
            $("#a-comencemos").click(function(){
                 var parametros = "txt-archivo="+$("#txt-archivo").val()+"&"+"txt-ciclos="+$("#txt-ciclos").val();
         
                $.ajax({
                    url:"ajax/procesar.php?accion=3",
                    method:"POST",
                   // data: parametros,
                    success:function(respuesta){
                        alert(respuesta);
                         $("#btn-ejecutar").prop("disabled", false);
                       
                    },
                    error:function(e){
                        alert("Ocurrio un error."+e);
                    }
                }); 
            });

             $("#a-bcp").click(function(){
                 var parametros = "txt-archivo="+$("#txt-archivo").val()+"&"+"txt-ciclos="+$("#txt-ciclos").val();
                
                $.ajax({
                    url:"ajax/procesar.php?accion=1",
                    method:"POST",
                    data: parametros,
                    success:function(respuesta){
                        $("#tr-bcp").html(respuesta);
                    },
                    error:function(e){
                        alert("Ocurrio un error."+e);
                    }
                }); 
            }); 

            $("#a-listos").click(function(){
         var parametros = "txt-archivo="+$("#txt-archivo").val()+"&"+"txt-ciclos="+$("#txt-ciclos").val();
                $.ajax({
                    url:"ajax/procesar.php?accion=2",
                    method:"POST",
                    data: parametros,
                    success:function(respuesta){
                        $("#tr-listo").html(respuesta);
                    },
                    error:function(e){
                        alert("Ocurrio un error."+e);
                    }
                }); 
            });

            $("#a-bloqueado").click(function(){
                 var parametros = "txt-archivo="+$("#txt-archivo").val()+"&"+"txt-ciclos="+$("#txt-ciclos").val();
               
                $.ajax({
                    url:"ajax/procesar.php?accion=5",
                    method:"POST",
                    data: parametros,
                    success:function(respuesta){
                     
                        $("#div-bloqueado").html(respuesta);
                    },
                    error:function(e){
                        alert("Ocurrio un error."+e);
                    }
                }); 
            }); 

                $("#a-salida").click(function(){
                     var parametros = "txt-archivo="+$("#txt-archivo").val()+"&"+"txt-ciclos="+$("#txt-ciclos").val();
               
                $.ajax({
                    url:"ajax/procesar.php?accion=6",
                    method:"POST",
                    data: parametros,
                    success:function(respuesta){
                     
                        $("#div-salida").html(respuesta);
                    },
                    error:function(e){
                        alert("Ocurrio un error."+e);
                    }
                }); 
            }); 
 


            $("#btn-ejecutar").click(function(){
                 var parametros = "txt-archivo="+$("#txt-archivo").val()+"&"+"txt-ciclos="+$("#txt-ciclos").val();
               
                $.ajax({
                    url:"ajax/procesar.php?accion=4",
                    method:"POST",
                    data: parametros,
                    success:function(respuesta){
                        
                        $("#div-ejecutando").html(respuesta);
                        // $("#btn-ejecutar").prop("disabled", true);
                    },
                    error:function(e){
                        alert("Ocurrio un error."+e);
                    }
                }); 
            });     

           
        });