<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeRequesterModal', () => {
        $('#requesterModal').modal('hide');
    });
    window.livewire.on('openRequesterModal', () => {
        $('#requesterModal').modal('show');
    });

</script>