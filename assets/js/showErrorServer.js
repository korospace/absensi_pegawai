function showErrorServer(data) {
	if (data.status == 401) {
		if (data.responseJSON.message == 'invalid token') {
			
			Swal.fire({
				title: `Session expired!`,
				text: 'please login again to update your session',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#6E7881',
				confirmButtonText: 'Oke',
				cancelButtonText: 'close',
			}).then((result) => {
				window.location.replace(BASEURL + "index.php/Logout");
			})
		}
		else {
			showToast(data.responseJSON.message,'warning');
		}
	}
	else if (data.status >= 400) {
		showToast(data.responseJSON.message,'warning');
	}
	else if (data.status >= 500) {
		showToast('kesalahan pada <b>server</b>','danger');
	}
}
