jQuery(document).ready(function($){
    var mediaUploader;
    $('#upload_logo_button').click(function(e) {
        e.preventDefault();
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Elegir Logotipo',
            button: {
                text: 'Usar este logotipo'
            }, multiple: false });
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('input[name="custom_theme_logo"]').val(attachment.url);
            $('img').attr('src', attachment.url);
        });
        mediaUploader.open();
    });

	$('#remove_logo_button').click(function(e) {
		e.preventDefault();
		$('#custom_theme_logo').val('');
		$('#logo_preview').hide();
	});
});
