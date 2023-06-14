// var picker = new Lightpick({
//     field: document.getElementById("demo-5"),
//     singleDate: false,
//     numberOfColumns: 3,
//     numberOfMonths: 6,
//     onSelect: function (start, end) {
//         var str = "";
//         str += start ? start.format("Do MMMM YYYY") + " to " : "";
//         str += end ? end.format("Do MMMM YYYY") : "...";
//         document.getElementById("result-5").innerHTML = str;
//     },
// });

function searchToggle(obj, evt) {
    var container = $(obj).closest(".search-wrapper");
    if (!container.hasClass("active")) {
        container.addClass("active");
        evt.preventDefault();
    } else if (
        container.hasClass("active") &&
        $(obj).closest(".input-holder").length == 0
    ) {
        container.removeClass("active");
        // clear input
        container.find(".search-input").val("");
    }
}
