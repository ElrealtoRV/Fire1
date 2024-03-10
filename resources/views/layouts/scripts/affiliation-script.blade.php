<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeAffiliationModal', () => {
        $('#AffiliationModal').modal('hide');
    });

    window.livewire.on('openAffiliationModal', () => {
        $('#AffiliationModal').modal('show');
    });
</script>