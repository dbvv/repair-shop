$(document).ready(() => {
  $('.clientSelect').autocomplete({
    minLength: 2,
    source: function(request, response) {
      $.ajax({
        url: window.conf.routes.client.index,
        data: {
          term: request.term
        },
        success: function(data) {
          var result = [];
          data.clients.forEach(function(element, index) {
            var val = element.name + " " + (element.phone ? element.phone : '') + " " + (element.address ? element.address : '');
            result.push({
              id: element.id,
              value: val,
              label: val,
            })
          });
          response(result)
        },
      })
    },
    select: function(event, ui) {
      $('input[name="client_id"]').val(ui.item.id)
    }
  });
  $('#clientCreateModalForm').on('submit', function(e) {
    e.preventDefault();
  });

  $('#saveClientModal').on('click', function() {
    let $form = $('#clientCreateModalForm');
    $.ajax({
      url: $form.attr('action'),
      type: 'POST',
      data: $form.serialize(),
      success: function(data) {
        const client = data.client;
        console.log('client', client)
        $('#exampleModal').modal('hide');
        $('input[name="client_id"]').val(client.id);
        $('input[name="client"]').val(client.name + ' ' + (client.phone ? client.phone : '') + ' ' + (client.address ? client.address : ''));
        $.notify('Клиент создан!');
      }
    })
  });
});