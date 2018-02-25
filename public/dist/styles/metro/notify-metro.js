$.notify.addStyle("metro", {
    html:
        "<div>" +
            "<div class='image' data-notify-html='image'/>" +
            "<div class='text-wrapper'>" +
                "<div class='title' data-notify-html='title'/>" +
                "<div class='text' data-notify-html='text'/>" +
            "</div>" +
        "</div>",
    classes: {
        error: {
            "color": "#a94442 !important",
            "background-color": "#f2dede",
            "border": "1px solid #ebccd1"
        },
        success: {
            "color": "#3c763d !important",
            "background-color": "#dff0d8",
            "border": "1px solid #d6e9c6"
        },
        info: {
            "color": "#31708f !important",
            "background-color": "#d9edf7",
            "border": "1px solid #bce8f1"
        },
        warning: {
            "color": "#8a6d3b !important",
            "background-color": "#fcf8e3",
            "border": "1px solid #faebcc"
        },
        black: {
            "color": "#fafafa !important",
            "background-color": "#333",
            "border": "1px solid #000"
        },
        white: {
            "background-color": "#f1f1f1",
            "border": "1px solid #ddd"
        }
    }
});