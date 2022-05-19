// Toteuta tähän tarvittava koodi
let cart = [];
let elements = [];

function addCart(){
    cart.forEach(t => {
        let e = document.createElement("p");
        e.textContent = t;
        elements.push(e);
        document.body.appendChild(e);
    })
}

function removeCart(){
    elements.forEach(e => {
        document.body.removeChild(e);
    })
    elements = [];
}

function add(){
    let t = document.getElementById("item").value;
    cart.push(t);
    cart.sort();
    removeCart();
    addCart();
    console.log(cart)
}