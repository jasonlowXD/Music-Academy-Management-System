$(function () {
    "use strict";
    $(function () {
        $(".preloader").fadeOut();
    });
    jQuery(document).on('click', '.mega-dropdown', function (e) {
        e.stopPropagation()
    });
    // ============================================================== 
    // This is for the top header part and sidebar part
    // ==============================================================  
    var set = function () {
        var width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width;
        var topOffset = 55;
        if (width < 1170) {
            $("body").addClass("mini-sidebar");
            $('.navbar-brand span').hide();
            $(".sidebartoggler i").addClass("ti-menu");
        }
        else {
            $("body").removeClass("mini-sidebar");
            $('.navbar-brand span').show();
        }
        var height = ((window.innerHeight > 0) ? window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $(".page-wrapper").css("min-height", (height) + "px");
        }
    };
    $(window).ready(set);
    $(window).on("resize", set);
    // ============================================================== 
    // Theme options
    // ==============================================================     
    $(".sidebartoggler").on('click', function () {
        if ($("body").hasClass("mini-sidebar")) {
            $("body").trigger("resize");
            $("body").removeClass("mini-sidebar");
            $('.navbar-brand span').show();
        }
        else {
            $("body").trigger("resize");
            $("body").addClass("mini-sidebar");
            $('.navbar-brand span').hide();
        }
    });
    // this is for close icon when navigation open in mobile view
    $(".nav-toggler").click(function () {
        $("body").toggleClass("show-sidebar");
        $(".nav-toggler i").toggleClass("ti-menu");
        $(".nav-toggler i").addClass("ti-close");
    });
    $(".search-box a, .search-box .app-search .srh-btn").on('click', function () {
        $(".app-search").toggle(200);
    });
    // ============================================================== 
    // Right sidebar options
    // ============================================================== 
    $(".right-side-toggle").click(function () {
        $(".right-sidebar").slideDown(50);
        $(".right-sidebar").toggleClass("shw-rside");
    });
    // ============================================================== 
    // This is for the floating labels
    // ============================================================== 
    $('.floating-labels .form-control').on('focus blur', function (e) {
        $(this).parents('.form-group').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
    }).trigger('blur');

    // ============================================================== 
    //tooltip
    // ============================================================== 
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    // ============================================================== 
    //Popover
    // ============================================================== 
    $(function () {
        $('[data-toggle="popover"]').popover()
    })

    // ============================================================== 
    // Perfact scrollbar
    // ============================================================== 
    $('.scroll-sidebar, .right-side-panel, .message-center, .right-sidebar').perfectScrollbar();
    // ============================================================== 
    // Resize all elements
    // ============================================================== 
    $("body").trigger("resize");
    // ============================================================== 
    // To do list
    // ============================================================== 
    $(".list-task li label").click(function () {
        $(this).toggleClass("task-done");
    });
    // ============================================================== 
    // Collapsable cards
    // ==============================================================
    $('a[data-action="collapse"]').on('click', function (e) {
        e.preventDefault();
        $(this).closest('.card').find('[data-action="collapse"] i').toggleClass('ti-minus ti-plus');
        $(this).closest('.card').children('.card-body').collapse('toggle');
    });
    // Toggle fullscreen
    $('a[data-action="expand"]').on('click', function (e) {
        e.preventDefault();
        $(this).closest('.card').find('[data-action="expand"] i').toggleClass('mdi-arrow-expand mdi-arrow-compress');
        $(this).closest('.card').toggleClass('card-fullscreen');
    });
    // Close Card
    $('a[data-action="close"]').on('click', function () {
        $(this).closest('.card').removeClass().slideUp('fast');
    });
});

// EMAIL 
function emailRemoveClass() {
    $("#emailDiv").removeClass("has-danger");
    $("#emailInput").removeClass("form-control-danger");
    $("#emailFeedback").removeClass("form-control-feedback");
    $("#emailFeedback").html("");
}

function emailAddClass(message) {
    $("#emailDiv").addClass("has-danger");
    $("#emailInput").addClass("form-control-danger");
    $("#emailFeedback").addClass("form-control-feedback");
    $("#emailFeedback").html(message);
}

// PHONE NUMBER 
function phoneRemoveClass() {
    $("#phoneDiv").removeClass("has-danger");
    $("#phoneInput").removeClass("form-control-danger");
    $("#phoneFeedback").removeClass("form-control-feedback");
    $("#phoneFeedback").html("");
}

function phoneAddClass(message) {
    $("#phoneDiv").addClass("has-danger");
    $("#phoneInput").addClass("form-control-danger");
    $("#phoneFeedback").addClass("form-control-feedback");
    $("#phoneFeedback").html(message);
}

// OLD PASSWORD
function oldPassRemoveClass() {
    $("#oldPassDiv").removeClass("has-danger");
    $("#oldPassInput").removeClass("form-control-danger");
    $("#oldPassFeedback").removeClass("form-control-feedback");
    $("#oldPassFeedback").html('');
}

function oldPassAddClass(message) {
    $("#oldPassDiv").addClass("has-danger");
    $("#oldPassInput").addClass("form-control-danger");
    $("#oldPassFeedback").addClass("form-control-feedback");
    $("#oldPassFeedback").html(message);
}

// NEW PASSWORD 
function newPassRemoveClass() {
    $("#newPassDiv").removeClass("has-danger");
    $("#newPassInput").removeClass("form-control-danger");
    $("#newPassFeedback").removeClass("form-control-feedback");
    $("#newPassFeedback").html('');
}

function newPassAddClass(message) {
    $("#newPassDiv").addClass("has-danger");
    $("#newPassInput").addClass("form-control-danger");
    $("#newPassFeedback").addClass("form-control-feedback");
    $("#newPassFeedback").html(message);
}

// COURSE NAME 
function courseNameRemoveClass() {
    $("#courseNameDiv").removeClass("has-danger");
    $("#courseNameInput").removeClass("form-control-danger");
    $("#courseNameFeedback").removeClass("form-control-feedback");
    $("#courseNameFeedback").html('');
}

function courseNameAddClass(message) {
    $("#courseNameDiv").addClass("has-danger");
    $("#courseNameInput").addClass("form-control-danger");
    $("#courseNameFeedback").addClass("form-control-feedback");
    $("#courseNameFeedback").html(message);
}

// RESOURCE FILE 
function resourceFileRemoveClass() {
    $("#resourceFileDiv").removeClass("has-danger");
    $("#resourceFileInput").removeClass("form-control-danger");
    $("#resourceFileFeedback").removeClass("form-control-feedback");
    $("#resourceFileFeedback").html('');
}

function resourceFileAddClass(message) {
    $("#resourceFileDiv").addClass("has-danger");
    $("#resourceFileInput").addClass("form-control-danger");
    $("#resourceFileFeedback").addClass("form-control-feedback");
    $("#resourceFileFeedback").html(message);
}

// EDIT RESOURCE FILE 
function editResourceFileRemoveClass() {
    $("#editResourceFileDiv").removeClass("has-danger");
    $("#editResourceFileInput").removeClass("form-control-danger");
    $("#editResourceFileFeedback").removeClass("form-control-feedback");
    $("#editResourceFileFeedback").html('');
}

function editResourceFileAddClass(message) {
    $("#editResourceFileDiv").addClass("has-danger");
    $("#editResourceFileInput").addClass("form-control-danger");
    $("#editResourceFileFeedback").addClass("form-control-feedback");
    $("#editResourceFileFeedback").html(message);
}

// PROGRESS FILE 
function progressFileRemoveClass() {
    $("#progressFileDiv").removeClass("has-danger");
    $("#progressFileInput").removeClass("form-control-danger");
    $("#progressFileFeedback").removeClass("form-control-feedback");
    $("#progressFileFeedback").html('');
}

function progressFileAddClass(message) {
    $("#progressFileDiv").addClass("has-danger");
    $("#progressFileInput").addClass("form-control-danger");
    $("#progressFileFeedback").addClass("form-control-feedback");
    $("#progressFileFeedback").html(message);
}

// EDIT PROGRESS FILE 
function editProgressFileRemoveClass() {
    $("#editProgressFileDiv").removeClass("has-danger");
    $("#editProgressFileInput").removeClass("form-control-danger");
    $("#editProgressFileFeedback").removeClass("form-control-feedback");
    $("#editProgressFileFeedback").html('');
}

function editProgressFileAddClass(message) {
    $("#editProgressFileDiv").addClass("has-danger");
    $("#editProgressFileInput").addClass("form-control-danger");
    $("#editProgressFileFeedback").addClass("form-control-feedback");
    $("#editProgressFileFeedback").html(message);
}