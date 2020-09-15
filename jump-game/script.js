let h = window.innerHeight;
let body = document.querySelector("body");
body.style.height = h+"px";

let chara = document.querySelector(".charactere");
let block = document.querySelector(".block");
let score = document.querySelector(".score-nbr");
let gameOver = document.querySelector(".game-over");
let s = 2;
let i = 10;
let d;



function jump(){
    if( chara.classList != "animate"){
        chara.classList.add("animate");
    }
    setTimeout(function (){
        chara.classList.remove("animate");
    },500);
}

function start(){
        body.removeAttribute("onclick");
        body.setAttribute("onclick", "jump()");
        gameOver.style.display = "none";
        body.classList.remove("darkmode");
        block.style.display = "flex";
        chara.style.display = "flex"    ;
        block.style.animation = "block infinite linear 2s"   ; 
}

setInterval(function() { 
    let charactereTop = parseInt(window.getComputedStyle(chara).getPropertyValue("top"));
    let blockLeft = parseInt(window.getComputedStyle(block).getPropertyValue("left"));
    
    if(blockLeft<40 && blockLeft>20 && charactereTop>=130){

        body.removeAttribute("onclick");
        block.style.animation = "none";
        block.style.display = "none";
        chara.style.display = "none";
        body.classList.toggle("darkmode");
        gameOver.style.display = "block";
        document.querySelector("#score-nbr").innerHTML = score.innerHTML;
        body.setAttribute("onclick", "start()");
        score.innerHTML = 0;
        s = 2;
        i = 10;
        d = 1;

    }else{

        if(blockLeft< 40 && blockLeft>20 && charactereTop<=130)
         setTimeout(function(){score.innerHTML = parseInt(score.innerHTML) + 1;},100);
         if( score.innerHTML / i >= 1){
             d *= 2;
             s -= d;
             i *= 2;
             setTimeout(function(){block.style.animation = "block infinite linear "+s+"s";}, 20)
         }
    }
}, 50);

body.setAttribute("onclick", "start()");