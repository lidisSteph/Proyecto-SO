(function($) {
    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $(document).on('click', 'a.page-scroll', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();


    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    })

    // Initialize and Configure Scroll Reveal Animation
    window.sr = ScrollReveal();
    sr.reveal('.sr-icons', {
        duration: 600,
        scale: 0.3,
        distance: '0px'
    }, 200);
    sr.reveal('.sr-button', {
        duration: 1000,
        delay: 200
    });
    sr.reveal('.sr-contact', {
        duration: 600,
        scale: 0.3,
        distance: '0px'
    }, 300);
    // botón de procesos
    

    // Initialize and Configure Magnific Popup Lightbox Plugin
    $('.popup-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
        }
    });

})(jQuery); // End of use strict


$(document).ready(function(){
            ///alert("Estamos ready, el DOM fue cargado");
            $("#btn-procesar").click(function(){
                // $("#btn-ingresar").button("loading");
                // $("#img-loading").fadeIn(200);
                var parametros = "txt-archivo="+$("#txt-archivo").val()+"&"+"txt-ciclos="+$("#txt-ciclos").val(); //formato similar a cuando se envia la informacion por GET
                //parametro1=valor1&parametro2=valor2&.....parametroN=valorN
                alert("Informacion que se enviara: " + parametros);
                $.ajax({
                    url:"ajax/procesar.php?accion=guardar",
                    method:"POST",
                    data: parametros,
                    success:function(respuesta){
                        // $("#img-loading").fadeOut(200);
                        // $("#btn-ingresar").button("reset");
                        $("#resultado").html(respuesta);
                    },
                    error:function(e){
                        alert("Ocurrio un error."+e);
                    }
                }); 
            }); 

           
        });