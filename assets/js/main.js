$(document).ready(function () {
    $(".form").submit(function (e) {
        e.preventDefault();
        $form = $(this);
        $alert = $(this).find(".alert");
        $.ajax({
            type: "POST",
            url: $form.attr("action"),
            data: $form.serialize(),
            dataType: "JSON",
            beforeSend: function (a) {
                // Show the loader
                $("#loading").show();
            },
            success: function (response) {
                $alert.children("span").html(response.message);
                if (response.status) {
                    $alert
                        .addClass("alert-success")
                        .removeClass("alert-danger hidden");
                } else {
                    $alert
                        .addClass("alert-danger")
                        .removeClass("alert-success hidden");
                }
                setTimeout(function () {
                    $alert.removeClass("visualhidden");
                }, 500);
            },
            error: function (xhr, ajaxOptions, error) {
                $alert.children("span").html(error);
                $alert
                    .addClass("alert-danger")
                    .removeClass("alert-success hidden");
                setTimeout(function () {
                    $alert.removeClass("visualhidden");
                }, 500);
            },
            complete: function (a) {
                // Clear the form after submission
                $form[0].reset();
                // Hide the loader
                $("#loading").hide();
            },
        });
    });

    $(window).load(function () {
        setBoxHeight();
    });

    $(window).resize(function () {
        setBoxHeight();
    });
});

// Set the height of process box
function setBoxHeight() {
    let imageHeight = $("#process-one").innerHeight();
    $(".process-box").css("height", imageHeight);
}
