// Toteuta tähän tarvittava koodi
function count(arr){
    var counts = [];
    arr.forEach(element => {
        if(typeof element == "string"){
            counts.push(element.length)
        }
    });
    return counts;
}