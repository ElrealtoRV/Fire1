<script>
	document.addEventListener("DOMContentLoaded", () => {
		Livewire.hook('message.processed', (component) => {
			setTimeout(function() {
				$('#alert').fadeOut('fast');
			}, 5000);
		});
	});

	window.livewire.on('closeOfficeModal', () => {
		$('#OfficeModal').modal('hide');
	});
	window.livewire.on('openOfficeModal', () => {
		$('#OfficeModal').modal('show');
	});

</script>