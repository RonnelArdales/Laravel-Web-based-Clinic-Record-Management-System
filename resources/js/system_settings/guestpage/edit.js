$('#content').summernote({
    placeholder: 'Hello stand alone ui',
    tabsize: 2,
    lineHeights: ['0.5', '1.0'],
    fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],
    fontNames: ['Arial', 'Arial Black', 'Song Myung', 'Inter', 'Poppins'],
    toolbar: [
        ['height', ['height']],
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear', 'italic']],
        ['forecolor', ['color']], // Use 'forecolor' instead of 'color'
        ['para', ['ul', 'ol', 'paragraph']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        // ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
    ],
    callbacks: {
        onInit: function() {
        // Find the background color button and remove it
        $('.note-color').parent().remove();
        }
    }
});
$(document).ready(function (){
    setTimeout(function() {
        $(".error").fadeOut(800);
    }, 2000);


    $(document).on('click', '.change', function (){
        $('.image').show();
    });

    $(document).on('click', '.remove', function (){
        $('.image_featured').hide();
        $('.image_noicon').show();
        $('#image_status').val("remove");
    });
});