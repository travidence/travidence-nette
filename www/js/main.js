var element;

$().ready(function(){
    element = document.getElementsByClassName("greyzone")[0];

    $("#addMore").click(function () {
        var elements = $(".greyzone");
        var last = elements[elements.length - 1];
        last.insertAfter(element);
        console.log(element);
    })
} );


