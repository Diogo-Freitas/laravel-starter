$(function() {
    // INICIA TOOLTIPS
    $('[data-toggle="tooltip"]').tooltip();

    // OCULTAR MENSAGEM DE ALERTA DEPOIS DE 10s
    $(".alert").delay(10000).slideUp(200, function () {
        $(this).alert('close');
    });
    // CRIA UM SPINNER PARA O BOTÃO QUANDO O FORMULÁRIO ESTIVER SENDO ENVIADO
     $(document).on('submit', 'form', function () {
         var spinner = $(this).find("button[data-spinner]");
         spinner.html('<i class="spinner-border spinner-border-sm mb-1" role="status" aria-hidden="true"></i> ' + spinner.attr('data-spinner')).prop("disabled", true);
    });
    // CRIA UM SPINNER PARA O LINK QUANDO FOR CLICADO
    $( "a[data-spinner]" ).on( "click", function() {
         $(this).html('<i class="spinner-border spinner-border-sm mb-1" role="status" aria-hidden="true"></i> ' +  $(this).attr('data-spinner')).attr( "aria-disabled", "true" ).addClass("disabled");
    });
});