var div = document.getElementById("asub"); // Animated div which is moved
var refs = div.getElementsByClassName("Ref"); // List of references (used for getting width)
var width = refs[0].getBoundingClientRect().width; // With this the program knows how much it has to move references until a new one is on screen
var moved = 0;
var oldMoved = 0
var count = refs.length - 1;
var animationHandler = null;
var done = false;

var delay = 3 * 1000;

// Moves references until a new on is shown
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

// Runs every 3 seconds and starts moving references
function animate(){
    if (width != refs[0].getBoundingClientRect().width) {
        width = refs[0].getBoundingClientRect().width
        moved = 0;
        oldMoved = 0;
    };

    done = false;
    animationHandler = setInterval(() => aHandler(), 1)

    clearInterval(animator);
}

var animator = setInterval(() => animate(), delay)