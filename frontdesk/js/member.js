$(function () {
    var h_sign=$('.h-sign');
    $('#h-sign').val(h_sign.attr('title'));
    $('.close').on('click',function () {
       $('.prompt').hide();
    });
    Andstep('cm');
});
function Mem_Ajax(id) {
    $('#h-sign').focus(function () {
        var $val=$(this).val();
        $(this).change(function () {
            var value=$(this).val();
            if($val != value){
                $.ajax({
                    async: false,
                    type:'POST',
                    url:"Ajax.php?action=member&id="+id,
                    dataType: "json",
                    data:{
                        val:value
                    },
                    cache:false,
                    success:function () {}
                })
            }

        })
    });

}
function Andstep(Classname) {
    var OClassname = document.getElementsByClassName(Classname);
    for (var i = 0; i <= OClassname.length; i++) {
        $(OClassname [i]).click(function () {
            var url=$(this).attr('data-url');
            $('.modal-content').load(url);
            $(this).unbind('click');
        });
    }
}