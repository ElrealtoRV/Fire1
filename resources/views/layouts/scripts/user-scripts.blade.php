<script>
	document.addEventListener("DOMContentLoaded", () => {
		Livewire.hook('message.processed', (component) => {
			setTimeout(function() {
				$('#alert').fadeOut('fast');
			}, 5000);
		});
	});

	window.livewire.on('closeUserModal', () => {
		$('#userModal').modal('hide');
	});
	window.livewire.on('openUserModal', () => {
		$('#userModal').modal('show');
	});

	window.livewire.on('closeUserInfoModal', () => {
		$('#userInfoModal').modal('hide');
	});
	window.livewire.on('openUserInfoModal', () => {
		$('#userInfoModal').modal('show');
	});
</script>
