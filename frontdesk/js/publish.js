window.onload = function ()  {
    var obj={1:'input[type=text]',2:'textarea'};

    $.each(obj,function(key,val){
        $(".form-group "+val).blur(function () {
            $(this).each(function(index,domEle){
                if ($(this).val()=="" || $(this).val()==null){
                    $(domEle).addClass('has_error');
                }else{
                    $(domEle).removeClass('has_error');
                }
            });
        });
    });


    $("input[name='submit']").click(function () {
        if (!$('#title').val() || !$('#content').val() || isNaN($('#module_id').val())){
            return false;
        }else{
            return true;
        }
    });

};