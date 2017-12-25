function notificar() {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: "http://inventario.test/notification",
        success: function(data) {
            var contador = 0;
            $('.raulNotification3').html('');
            $.each(data, function(key, val) {
                $('.raulNotification3').append("<li><a href='.'><i class='fa fa-user text-orange'></i> El Artículo <b> " + val['nombre'] + "</b></a></li>");
                contador++;
                toastr.warning("Artículo: " + val['nombre'] + ", se encuentra por debajo del Stock Mínimo", "Stock Mínimo");
            });
            $('.raulNotification').html("" + contador);
            $('.raulNotification2').html("Tienes <b>" + contador + "</b> Notificaciones");
        },
        error: function() {
            console.log('' + data);
            $('.raulNotification').html("0");
            $('.raulNotification2').html("Sin Notificaciones");
            $('.raulNotification3').html('');
        }
    });
    var timer = setTimeout('notificar()', 20000); //20 segundos
}
$(function() {
    notificar();
});