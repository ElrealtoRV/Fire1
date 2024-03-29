<script>
  document.addEventListener("DOMContentLoaded", () => {
    Livewire.hook('message.processed', (component) => {
      setTimeout(function() {
        $('#alert').fadeOut('fast');
      }, 5000);
    });
  });

  window.livewire.on('closeDepartmentModal', () => {
    $('#DepartmentModal').modal('hide');
  });

  window.livewire.on('openDepartmentModal', () => {
    $('#DepartmentModal').modal('show');
  });
</script>