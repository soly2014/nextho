$(function () {
    
    $('.notesContainer').on('click', '.note-edit', function(e){
        e.preventDefault();
        var $wrapper          = $(this).closest('.single-note-wrapper')
        var note_id           = $wrapper.attr('data-note-id');
        var note_content      = $wrapper.find(".single-note").text();
        var activity_type     = $wrapper.attr('data-actionType');
        console.log(activity_type);
        $('#note_text').val(note_content);
        $('#current_note_id').val(note_id);//
        $('#activity_type').val(activity_type);//
        
    });
    
    $('#notes-reset').on('click', function(){
        $('#current_note_id').val(0);
    });
        
});