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
            var val = element.name + " " + element.phone + " ";
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
    axios.post($form.attr('action'), $form.serialize()).then(data => {
      const client = data.data.client;
      $('#exampleModal').modal('hide');
      $('input[name="client_id"]').val(client.id);
      $('input[name="client"]').val(client.name + ' ' + client.phone);
      $.notify('Клиент создан!');
    })
  });
});