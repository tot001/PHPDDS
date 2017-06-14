var span;
var name = pw = confirm_pw = vocode = false;
window.onload = function () {
    var obj1 = {name: '账号必须填', pw: '密码为空', confirm_pw: '两次密码不一致', vocode: '验证码为空'};
    var obj2 = {name: '账号必须填', pw: '请输入至少6位的密码', confirm_pw: '两次密码不一致'};
    $.each(obj2, function (key2, val2) {
        new LimitDrag("#" + key2, val2)
    });
    $('input[name="submit"]').click(function () {
        $.each(obj1, function (key1, val1) {
            check(key1, val1)
        });
        if (name && pw && confirm_pw && vocode) {
            $("#reg_form").submit()
        } else {
            return false
        }
    })
};

function check(ID, str) {
    var id = "#" + ID;
    if ($(id).val() == "") {
        var span = $(id).parent().next();
        span.removeClass('glyphicon glyphicon-ok');
        span.addClass('glyphicon glyphicon-remove errspan');
        span.text(str);
    } else {
        return ID = true;
    }
}


function DragBlur(id) {
    var _this = this;
    this.oID = $(id);
    this.oID.blur(function () {
        _this.fnBlur(this);
    });
}
DragBlur.prototype.fnBlur = function () {
    var _this = this;
    if ($(this.oID).val() != "") {
        var span = $(this.oID).parent().next();
        span.text("");
        span.addClass('glyphicon glyphicon-ok');
        span.css({
            "color": "#53d287"
        });
    }
};


function LimitDrag(id, str) {
    this.oStr = str;
    DragBlur.call(this, id);
}
for (var i in DragBlur.prototype) {
    LimitDrag.prototype[i] = DragBlur.prototype[i];
}
LimitDrag.prototype.fnBlur = function () {
    var _this = this;
    var _id = this.oID;
    span = $(_id).parent().next();
    if ($(_id).is('#name')) {
        if ($.trim($(_id).val()) == "") {
            span.text(this.oStr);
            Errspan();
            name = false;
        } else {
            name = true;
            span.text("");
            Okspan();
        }
    }
    if ($(_id).is('#pw')) {
        if ($.trim($(_id).val()) == "" || $.trim($(_id).val()).length < 6) {
            span.text(this.oStr);
            Errspan();
            pw = false;
        } else {
            pw = true;
            span.text("");
            Okspan();
        }
    }
    if ($(_id).is('#confirm_pw')) {
        if ($.trim($(_id).val()) == "" || $.trim($(_id).val()) != $.trim($("#pw").val())) {
            span.text(this.oStr);
            Errspan();
            confirm_pw = false;
        } else {
            confirm_pw = true;
            span.text("");
            Okspan();
        }
    }

};

function Errspan() {
    span.removeClass("glyphicon-ok okspan");
    span.addClass('glyphicon glyphicon-remove errspan');
}
function Okspan() {
    span.removeClass("glyphicon-remove errspan");
    span.addClass('glyphicon glyphicon-ok okspan');
}


function register_ajax() {
    $('#name').blur(function () {
        $.ajax({
            type: "POST",
            url: "register_ajax.php?action=user",
            data: "username=" + $(this).val(),
            success: function (msg) {
                var userinfo = $('#userinfo');
                switch (msg) {
                    case 'exist':
                        userinfo.removeClass('glyphicon glyphicon-ok okspan');
                        userinfo.addClass('glyphicon glyphicon-remove errspan');
                        userinfo.text('账号已存在');
                        name = false;
                        break;
                    case 'use':
                        userinfo.removeClass('glyphicon glyphicon-remove errspan');
                        userinfo.addClass('glyphicon glyphicon-ok okspan');
                        userinfo.text('');
                        name = true;
                        break;
                    default:
                        userinfo.text('账号必须填');
                }

            }
        })
    });
    $('#vocode').blur(function () {
        $.ajax({
            type: 'POST',
            url: "register_ajax.php?action=vocode",
            data: "vocode=" + $(this).val(),
            success: function (msg) {
                var codeinfo = $('#codeinfo');
                switch (msg) {
                    case 'err':
                        codeinfo.removeClass('glyphicon glyphicon-ok okspan');
                        codeinfo.addClass('glyphicon glyphicon-remove errspan');
                        codeinfo.text('验证码错误');
                        vocode = false;
                        break;
                    case 'ok':
                        codeinfo.removeClass('glyphicon glyphicon-remove errspan');
                        codeinfo.addClass('glyphicon glyphicon-ok okspan');
                        codeinfo.text('');
                        vocode = true;
                        break;
                    default:
                        codeinfo.text('请输入验证码');
                }
            }
        })
    })
}