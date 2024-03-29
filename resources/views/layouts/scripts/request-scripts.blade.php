<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeRequestModal', () => {
        $('#RequestModal').modal('hide');
    });
    window.livewire.on('openRequestModal', () => {
        $('#RequestModal').modal('show');
    });

</script>