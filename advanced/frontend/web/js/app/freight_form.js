$(function(){
    $('.province-item').on('click',function(){
        var provinceId = $(this).data('id');
        $('.province-item').removeClass('active');
        $(this).addClass('active');
        $('.city-box').addClass('hidden');
        $('#city-box-'+provinceId).removeClass('hidden');
    })

    //选择地域
    $('#save-btn').click(function(){
        var region = '';
        var locations = '';
        $("#cities input[name='region']:checkbox:checked").each(function(){ 
            region += $(this).val() + ','; 
            locations += $(this).data('name') + ' /';
        })
        if (!locations || !region) {
            swal("warning!", "请至少选择一个城市!", "warning");
            return false;
        }
        locations = locations ? locations.substring(0, locations.length - 1) : '';
        $('#locations').html(locations);
        $('#freighttemp-region_name').val(locations);
        $('#freighttemp-region').val(region);
        $('#myModal').modal('toggle')
    })
    $('.region-all').click(function(){
        var id = $(this).data('id');
        $("#city-box-"+id+" input[name='region']").prop("checked",$(this).is(':checked'));
    })

    //包邮
    $('input[name=FreightTemp\\[whether_post\\]]').change(function(){
        if ($(this).val() == 1)
            $('.whether_post_box').addClass('hidden');
        else
            $('.whether_post_box').removeClass('hidden');
    })
    //单位选择
    $('input[name=FreightTemp\\[charge_rule\\]]').change(function(){
        if ($(this).val() == 1)
            $('.charge_rule_units').html('件');
        else
            $('.charge_rule_units').html('KG');
    })
    $('input[name=FreightTemp\\[free_post\\]]').change(function(){
        if ($(this).val() == 1){
            $('.free_post_units').html('件');
            $('#free_post_box').removeClass('hidden')
        }
        else if($(this).val() == 2){
            $('.free_post_units').html('元');
            $('#free_post_box').removeClass('hidden')
        }
        else{
            $('#free_post_box').addClass('hidden');
        }
        
    })

});