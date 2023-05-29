function showErrorServer(data) {
	if (data.status == 401) {
		if (data.responseJSON.message == 'invalid token') {
			
			Swal.fire({
				title: `Login berakhir!`,
				text: 'silahkan login kembali untuk memperbarui login anda',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#6E7881',
				confirmButtonText: 'Iya',
				cancelButtonText: 'tutup',
			}).then((result) => {
				window.location.replace(BASEURL + "index.php/Logout");
			})
		}
		else {
			showToast(data.responseJSON.message,'warning');
		}
	}
	else if (data.status >= 500) {
		showToast('kesalahan pada <b>server</b>','danger');
	}
}
