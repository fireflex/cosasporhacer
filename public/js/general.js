jQuery(document).ready(function($) {
//Parsley Esp.
Parsley.addMessages('es', {
  defaultMessage: "Este campo parece ser inválido.",
  type: {
    email:        "Este campo debe ser un correo válido.",
    url:          "Este campo debe ser una URL válida.",
    number:       "Este campo debe ser un número válido.",
    integer:      "Este campo debe ser un número válido.",
    digits:       "Este campo debe ser un dígito válido.",
    alphanum:     "Este campo debe ser alfanumérico."
  },
  notblank:       "Este campo no debe estar en blanco.",
  required:       "Este campo es requerido.",
  pattern:        "Este campo es incorrecto.",
  min:            "Este campo no debe ser menor que %s.",
  max:            "Este campo no debe ser mayor que %s.",
  range:          "Este campo debe estar entre %s y %s.",
  minlength:      "Este campo es muy corto. La longitud mínima es de %s caracteres.",
  maxlength:      "Este campo es muy largo. La longitud máxima es de %s caracteres.",
  length:         "La longitud de este campo debe estar entre %s y %s caracteres.",
  mincheck:       "Debe seleccionar al menos %s opciones.",
  maxcheck:       "Debe seleccionar %s opciones o menos.",
  check:          "Debe seleccionar entre %s y %s opciones.",
  equalto:        "Este campo debe ser idéntico."
});

Parsley.setLocale('es');
//Validacion de los forms
$('#login').parsley();
$('#crear-tarea').parsley();

//Configuracion TOKEN AJAX
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


// Formulario login de la APP
$('#login').submit(function(event) {
  event.preventDefault();
  var dataLogin = $('#login').serialize();
  $.ajax({
    url: "/login",
    type: 'POST',
    dataType: 'json',
    data: dataLogin,
  })
  .done(function(response) {
    if (response.type == 'error') {
     $("body").overhang({
      type: "error",
      message: response.message,
      duration: 3,
      upper: true
    });
   } else {
    window.location.replace(response.message);
  }
})
});

// Evento para crear una tarea.
$('#crear-tarea').submit(function(event) {
  event.preventDefault();
  var dataTarea = $(this).serialize();
  $.ajax({
    url: '/mistareas/add',
    type: 'POST',
    dataType: 'json',
    data: dataTarea,
  })
  .done(function(response) {
    if (response.type == 'error') {
     $("body").overhang({
      type: "error",
      message: response.message,
      duration: 3,
      upper: true
    });
   } else {
    $('#lista-tareas').append(response.datos);
    $("body").overhang({
      type: "success",
      message: response.message,
      duration: 3,
      upper: true
    });
  }
})
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
});
// Para marcar una tarea como realizada.
$('.marcar-tarea').on('click', function(event) {
  var check = $(this).is(':checked');
  var valor = $(this).val();
  if (check) {
    $(this).parent().css('text-decoration', 'line-through');
    $.ajax({
      url: '/mistareas/estado',
      type: 'POST',
      dataType: 'json',
      data: {valor: valor, marcado:1},
    })
    .done(function(response) {
      if (response.type == 'error') {
       $("body").overhang({
        type: "error",
        message: response.message,
        duration: 3,
        upper: true
      });
     } else {
      $("body").overhang({
        type: "success",
        message: response.message,
       duration: 3,
        upper: true
      });
    }
  })
  }else{
    $.ajax({
      url: '/mistareas/estado',
      type: 'POST',
      dataType: 'json',
      data: {valor: valor, marcado:0},
    })
    $(this).parent().css('text-decoration', 'none');
  }

} );

//Eliminar una tarea
$('.eliminar').on('click', function(event) {
  event.preventDefault();
  var id = $(this).attr('id');
  $(this).parent().remove();
  $.ajax({
    url: '/mistareas/borrar',
    type: 'POST',
    dataType: 'json',
    data: {id: id},
  })
  .done(function(response) {
    if (response.type == 'error') {
       $("body").overhang({
        type: "error",
        message: response.message,
        duration: 3,
        upper: true
      });
     } else {
      $("body").overhang({
        type: "error",
        message: response.message,
       duration: 3,
        upper: true
      });
    }
  })
  
});

//Filtro de las tareas.
$('#filtro').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "mistareas/filtro",
          data: 'cadena=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });

}); // End Jquery





