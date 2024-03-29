<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeCasModal', () => {
        $('#CasModal').modal('hide');
    });

    window.livewire.on('openCasModal', () => {
        $('#CasModal').modal('show');
    });
</script>