var child = document.getElementsByClassName("child-load")[0],
    clkBut = document.getElementsByClassName("clk-load")[0],
    progSpan = document.getElementsByClassName("prog-load")[0];
//*************************

var q = (function () {
    var width = 0;

    return function () {
        var x = setInterval(function () {
            if (width === 99) {
                clearInterval(x);
            } else {
                width++;
                child.style.width = width + "%";
                progSpan.innerHTML = width + "%";
            }
        }, 100);
    }
})();
clkBut.onclick = q;