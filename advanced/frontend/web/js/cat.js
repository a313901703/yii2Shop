$(function(){
    $('.cat').on('click', function(event) {
        var id = $(this).data('value');
        var els = $("tr[data-pid='"+id+"']");
        if (!els || $(this).data('empty') ) {
            return false;
        }
        $(this).find('i').toggleClass('fa-chevron-right').toggleClass('fa-chevron-down');
        $(els).each(function(i){
            console.log($(this).data('value'))
            $(this).toggle(250);
        })
    });
});