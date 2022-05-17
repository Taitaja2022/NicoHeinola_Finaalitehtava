var div = document.getElementById("asub");
var refs = div.getElementsByClassName("Ref");
var width = refs[0].getBoundingClientRect().width;
var moved = 0;
var oldMoved = 0
var count = refs.length - 1;
var animationHandler = null;
var done = false;

var delay = 3 * 1000;

function aHandler(){
    if(oldMoved + width <= moved){
        done = true;
    } else {
        moved += 20;
        if (oldMoved + width <= moved) moved = oldMoved + width;
    }
    div.style.left = moved * -1 + "px";

    if(done){
        oldMoved = moved

        if (oldMoved >= (width * count) / 2){
            oldMoved = 0;
            moved = 0
        }

        clearInterval(animationHandler);
        animator = setInterval(() => animate(), delay)
    }
}

function animate(){
    console.log("Animated")

    done = false;
    animationHandler = setInterval(() => aHandler(), 1)

    clearInterval(animator);
}

var animator = setInterval(() => animate(), delay)