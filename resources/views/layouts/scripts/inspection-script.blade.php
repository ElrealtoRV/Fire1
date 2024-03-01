<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeInspectionModal', () => {
        $('#InspectionModal').modal('hide');
    });
    window.livewire.on('openInspectionModal', () => {
        $('#InspectionModal').modal('show');
    });

</script>