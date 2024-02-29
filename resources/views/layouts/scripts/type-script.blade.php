<script>
	document.addEventListener("DOMContentLoaded", () => {
		Livewire.hook('message.processed', (component) => {
			setTimeout(function() {
				$('#alert').fadeOut('fast');
			}, 5000);
		});
	});

	window.livewire.on('closeTypeModal', () => {
		$('#TypeModal').modal('hide');
	});
	window.livewire.on('openTypeModal', () => {
		$('#TypeModal').modal('show');
	});

	window.livewire.on('closeUserInquiryModal', () => {
		$('#userInquiryModal').modal('hide');
	});
	window.livewire.on('openUserInquiryModal', () => {
		$('#userInquiryModal').modal('show');
	});
</script>
