<script>
	document.addEventListener("DOMContentLoaded", () => {
		Livewire.hook('message.processed', (component) => {
			setTimeout(function() {
				$('#alert').fadeOut('fast');
			}, 5000);
		});
	});

	window.livewire.on('closeRecordModal', () => {
		$('#RecordModal').modal('hide');
	});
	window.livewire.on('openRecordModal', () => {
		$('#RecordModal').modal('show');
	});
</script>
