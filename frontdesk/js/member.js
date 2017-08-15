$(function () {
    var h_sign=$('.h-sign');
    $('#h-sign').val(h_sign.attr('title'));
    $('.close').on('click',function () {
       $('.prompt').hide();
    });
    Andstep('cm');

});
function Mem_Ajax(id) {
    var $val;
    $('#h-sign').focus(function () {
        $val=$(this).val();
    });
    $('#h-sign').blur(function () {
        var value=$(this).val();
        if($val != value){
            $.ajax({
                type:'POST',
                url:"Ajax.php?action=member&id="+id,
                dataType: "json",
                timeout:3000,
                data:{
                    val:value
                },
                cache:false,
                success:function () {}
            })
        }

    })

}
function Andstep(Classname) {
    $('.'+Classname).each(function (index,element) {
        $(element).click(function () {
            var url=$(this).attr('data-url');
            $('.modal-content').load(url);
            $(this).unbind('click');
        })
    })
}