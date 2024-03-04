<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeStatusModal', () => {
        $('#StatusModal').modal('hide');
    });

    window.livewire.on('openStatusModal', () => {
        $('#StatusModal').modal('show');
    });
</script>