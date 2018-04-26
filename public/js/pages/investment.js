$(document).on("ready", function() {
    $(".downlines").hide();
    $("#downline").on("click", function() {
        $(".investments").hide();
        $(".downlines").show();
    });

    $("#investment").on("click", function() {
        $(".downlines").hide();
        $(".investments").show();
    });
});