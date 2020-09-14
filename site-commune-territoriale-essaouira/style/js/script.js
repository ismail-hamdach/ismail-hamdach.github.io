let h = window.innerHeight;
let container = document.querySelector(".container1");
container.style.height = h + "px";

let image = document.querySelector(".image");
image.style.height = h + "px";

window.addEventListener("load", stop)

function stop(){
    container.classList.add("stop");
}