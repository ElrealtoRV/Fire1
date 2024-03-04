<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeRegularUserModal', () => {
        $('#RegularUserModal').modal('hide');
    });
    window.livewire.on('openRegularUserModal', () => {
        $('#RegularUserModal').modal('show');
    });

</script>