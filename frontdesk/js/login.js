$("input[name='mesubmit']").click(function () {
    var mename = $("#mename").val();
    var mepw = $("#mepw").val();
    var mevocode = $("#mevocode").val();
    var time;
    if ($("#metime").is(":checked")) {
        time = parseInt($("#metime").val())
    } else {
        var metime1 = $("#metime1");
        metime1.attr("checked", "checked");
        time = metime1.val()
    }
    $.ajax({
        type: "POST",
        url: "login.php?action=login",
        dataType: "json",
        data: {"mename": mename, "mepw": mepw, "metime": time, "mevocode": mevocode},
        success: function (data) {
            var logAlert = $("#logAlert");
            if (data.success == 0) {
                logAlert.show();
                logAlert.text(data.msg)
            } else {
                if (data.success == 1) {
                    $("#log_form").submit()
                }
            }
        }
    });
    return false
});
$("#logout").click(function () {
    $.post("login.php?action=logout", function (msg) {
        if (msg == 1) {
            $.cookie("memberName", null);
            $.cookie("memberPw", null);
            window.location.href = "http://localhost/DDS/frontdesk/index.php";
        } else {
            return false
        }
    })
});