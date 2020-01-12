setTimeout(function() {
    $('#flash_message').hide(2000);
}, 2000);

$('#delete_modal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var modal = $(this);

    modal.find('.modal-footer #select_id').val(id);
});
$('#user_edit_modal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var name = button.data('name');
    var email = button.data('email');
    var type = button.data('type');
    var modal = $(this);

    modal.find('.modal-body #edit_id').val(id);
    modal.find('.modal-body #user_name').val(name);
    modal.find('.modal-body #user_email').val(email);
    modal.find('.modal-body #user_type').val(type);
});
$('#edit_modal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var title = button.data('title');
    var body = button.data('body');
    var modal = $(this);

    modal.find('.modal-body #edit_id').val(id);
    modal.find('.modal-body #title').val(title);
    modal.find('.modal-body #body').val(body);
});