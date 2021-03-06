function s_slug(text){
    $("#slug").val(text
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        );
}

$(function(){
    $(document).ready(function() {
    $('#dataTable').DataTable();
} );
});