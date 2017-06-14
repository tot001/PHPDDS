function Alert_sort(color,url,title,string) {
    $("#Alert_sort").addClass("alert-"+ color).fadeIn();
    $("#sort_url").attr("href",url);
    $("#sort_st").html(title);
    $("#sort_sps").html(string);
    $("#Alert_sort").fadeOut(3000);
}