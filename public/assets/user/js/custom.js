setTimeout(function() {
    $('#flash_message').hide(2000);
}, 2000);

$('#delete_modal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var modal = $(this);
    modal.find('.modal-footer #select_id').val(id);
});