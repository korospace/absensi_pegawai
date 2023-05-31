let containerViewerHtml = `<div id="image-viewer">
		<span class="close">&times;</span>
		<img class="modal-content" id="full-image">
	</div>`;

$(containerViewerHtml).appendTo('body');

function enableImgViewer(imagesClass) {
	$(imagesClass).addClass('img_target_viewer');

	$(imagesClass).click(function(){
		$("#full-image").attr("src", $(this).attr("src"));
		$('#image-viewer').show();
	});

	$("#image-viewer .close").click(function(){
		$('#image-viewer').hide();
	});
}
