jQuery(document).ready(function ($) {
    $('.meta-box-sortables').sortable({
        opacity: 0.6,
        revert: true,
        cursor: 'move',
        handle: '.hndle',
        stop: fpManageSortable
    });


    fpManageSortable();
});

function fpManageSortable() {

    $ = jQuery;

    var sortableArray = Array();

    $.each(jQuery('.meta-box-sortables').children(".fp_setting_sortable"), function () {

        sortableArray.push($(this).attr('id'));
    });

    
    $("#fp_sortable_list_json").val(JSON.stringify(sortableArray));
}