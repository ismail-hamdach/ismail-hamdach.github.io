let h = window.innerHeight;
let body = document.querySelector("body");
body.style.height = h+"px";





let chara = document.querySelector(".charactere");
let block = document.querySelector(".block");
let score = document.querySelector(".score-nbr");

let gameOver = document.querySelector(".game-over");


body.addEventListener("click", function(){jump()})



function jump(){
    if( chara.classList != "animate"){
        chara.classList.add("animate");
    }
    setTimeout(function (){
        chara.classList.remove("animate");
    },500);
}

let checkDead = setInterval(function() {
 
    let charactereTop = parseInt(window.getComputedStyle(chara).getPropertyValue("top"));
    let blockLeft = parseInt(window.getComputedStyle(block).getPropertyValue("left"));
 
    if(blockLeft<40 && blockLeft>20 && charactereTop>=130){
        block.style.animation = "none"
        block.style.display = "none"
        chara.style.display = "none"
        
        body.classList.toggle("darkmode");
        gameOver.style.display = "block"
        document.querySelector("#score-nbr").innerHTML = score.innerHTML;
        body.addEventListener("click", function(){start()})
        score.innerHTML = 0;
    }else{
        if(blockLeft<40 && blockLeft>20 && charactereTop<=130)
         score.innerHTML = parseInt(score.innerHTML) + 1;
    }

}, 10);


function start(){
        body.addEventListener("click", function(){jump()})
        gameOver.style.display = "none"
        body.classList.remove("darkmode");
        block.style.animation = "block infinite linear 2s"
        block.style.display = "flex"
        chara.style.display = "flex"
        
}