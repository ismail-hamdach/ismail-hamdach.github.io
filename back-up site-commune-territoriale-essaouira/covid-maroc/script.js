const content   = document.querySelector("#content");
const container = document.querySelector("#container0");

const conf  = document.querySelector("#nb-conf");
const activ = document.querySelector("#nb-activ");
const reco  = document.querySelector("#nb-reco");
const death = document.querySelector("#nb-death");

const today = document.querySelector("#mise-ajour");

const confToday  = document.querySelector("#nb-conf-today");
const activToday = document.querySelector("#nb-activ-today");
const recoToday  = document.querySelector("#nb-reco-today");
const deathToday = document.querySelector("#nb-death-today");

const activPerc = document.querySelector("#perc-activ");
const recoPerc  = document.querySelector("#perc-reco");
const deathPerc = document.querySelector("#perc-death");

let winWidth = window.innerWidth;

if( winWidth < 1140 ){
    if( winWidth < 414 ){
        container.style.width = 300 + "px"
    }
    else{
        container.style.width = (winWidth - 200) + "px"
    }
}

let httpReq = new XMLHttpRequest()
  
httpReq.open("GET",`https://api.covid19api.com/dayone/country/ma`)

httpReq.onreadystatechange = function(){
    if(httpReq.readyState==4 && httpReq.status==200){
        let resp=JSON.parse(httpReq.response)
        let confirmed = resp.map(e=> e.Confirmed)
        let recovered = resp.map(e=> e.Recovered)
        let deaths    = resp.map(e=> e.Deaths)
        let active    = resp.map(e=> e.Active)
        let lbl       = resp.map(e=>`${new Date(e.Date).getDate()}/${new Date(e.Date).getMonth()+1}`)
        let DateLbl   = resp.map(e => `${new Date(e.Date).getDate()}/${new Date(e.Date).getMonth()+1}/${new Date(e.Date).getFullYear()}`)
        creatChart(content,"Maroc",lbl,confirmed,active, recovered,deaths)
        
        today.innerHTML = DateLbl[DateLbl.length-1];  

        conf.innerHTML  = confirmed[confirmed.length-1];
        activ.innerHTML = active[active.length-1];
        reco.innerHTML  = recovered[recovered.length-1];
        death.innerHTML = deaths[deaths.length-1];
        
        confToday.innerHTML  = "+ "+(confirmed[confirmed.length-1]-confirmed[confirmed.length-2]);
        activToday.innerHTML = "+ "+(active[active.length-1]-active[active.length-2]);
        recoToday.innerHTML  = "+ "+(recovered[recovered.length-1]-recovered[recovered.length-2]);
        deathToday.innerHTML = "+ "+(deaths[deaths.length-1]-deaths[deaths.length-2]);  

        activPerc.innerHTML = Math.round((activ.innerHTML/conf.innerHTML)*10000)/100;
        recoPerc.innerHTML  = Math.round((reco.innerHTML/conf.innerHTML)*10000)/100;
        deathPerc.innerHTML = Math.round((death.innerHTML/conf.innerHTML)*10000)/100;
        
    }
}
        
httpReq.send()

    function creatChart(container,title="",lbl=[],confirmed=[],active=[], recovered=[],deaths=[]){
        let myCanvas=document.createElement('canvas');
        myCanvas.setAttribute("id","canvas");
        container.innerHTML="";
        container.appendChild(myCanvas);
        console.log(lbl[198])
        
        let mychart = new Chart(myCanvas.getContext('2d'), {
            type: 'line',
            
            data: {
                labels: lbl,
                datasets:[
                    {
                        label: "Confirmés",
                        data: confirmed,
                        backgroundColor: 'rgba(237,230,130,0.3)',
                        borderColor: '#ede682'
                    },
                    {
                        label: "Géris",
                        data: recovered,
                        backgroundColor: 'rgba(173,228,152,0.3)',
                        borderColor: ' #ade498'
                    },
                    {
                        label: "Décés",
                        data: deaths,
                        backgroundColor: 'rgba(255,75,92,0.3)',
                        borderColor: '#ff4b5c'
                    },
                    {
                        label: "Active",
                        data: active,
                        backgroundColor: 'rgba(254,191,99,0.3)',
                        borderColor: '#febf63'
                    }
                ]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: title
                }
            }
    
        });
    }

