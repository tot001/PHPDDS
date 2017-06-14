/**
 * Created by TOT on 2017/5/5.
 */

function Reply_ajax(id,member_id) {
    $('#messSub').on('click',function () {
        var content=$("#messReply");
            $.ajax({
                type: 'POST',
                url: "reply.php?action=messReply&id="+id,
                dataType:"json",
                data: {"content":content.val(),"member_id":member_id},
                success: function (msg) {
                    var log=$('.log');
                    if (msg.error == false){
                        log.text(msg.msgs);
                    }else if (msg.success == 200){
                        log.text(msg.msgs);
                        var article_j=$('.article_list_j'),
                            j_html=article_j.html();
                        article_j.html( msg.html + j_html);
                        content.val('');
                    }
                }
            });
    });
    $(".reply").on('click',function (event){
        var $target = $(event.target),
            tarParent=$target.parent(),
            reply_c=$('.reply_c'),
            html="<from method=post class='form-horizontal reply_c' id=post-wrap action=''>"
                +"<div class='form-group col-lg-12 col-sm-12'>"
                +"<div class='col-lg-offset-1 col-lg-9 col-sm-10'>"
                +"<textarea name=replyCont class='form-control content'  cols=30 rows=80></textarea>"
                +"</div>"
                +"<input type=submit disabled='disabled' class='replyBtn btn' value=Pubilsh>"
                +"</div>"
                +"</from>";
        if (reply_c.length > 0) {
            $(reply_c).remove();
        }else {
            $(tarParent).after(html);
            var replyBtn=$('.replyBtn');
            $('.content').on('change',function () {
               if ($(this).val()!="" && $(this).val().length>=3){
                   replyBtn.removeAttr("disabled");
               }else{
                   replyBtn.attr("disabled","disabled");
               }
            });
            replyBtn.on('click',function () {
                var content=$('.content'),
                    replyID=tarParent.attr('data-replyID');
                $.ajax({
                    type:'POST',
                    url: "reply.php?action=reply&id="+id,
                    dataType:"json",
                    data: {"content":content.val(),"member_id":member_id,"reply_id":replyID},
                    success: function (msg) {
                        if (msg.error == false) {
                            content.attr("placeholder",msg.msgs);
                            replyBtn.attr("disabled","disabled");
                        }else if(msg.success == 200){
                            var media_j=$('.queto'+replyID),
                            j_html=media_j.html();
                            media_j.html(j_html + msg.html);
                            content.val('');
                        }
                    }
                })
            });
            event.stopPropagation();
        }
    });
}

function Intercom_toggle() {
    $(".intercom-launcher-open-icon").toggleClass("open-active");
    $(".intercom-launcher-close-icon").toggleClass("close-active");
    $(".intercom-messenger").toggle();
}


// $.ajax({
//     type:'POST',
//     url: "reply.php?action=reply&id="+id,
//     dataType:"json",
//     data: {"content":content.val(),"member_id":member_id,"replyID":num},
//     success: function (msg) {
//         if (msg.error == false) {
//             content.val(msg.msgs);
//         }else if(msg.success == 201){
//
//         }
//
//     }
// })

