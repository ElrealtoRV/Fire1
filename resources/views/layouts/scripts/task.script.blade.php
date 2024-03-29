<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.processed', (component) => {
            setTimeout(function() {
                $('#alert').fadeOut('fast');
            }, 5000);
        });
    });

    window.livewire.on('closeTaskModal', () => {
        $('#AddTask').modal('hide');
    });

    window.livewire.on('openTaskModal', () => {
        $('AddTask').modal('show');
    });
</script>