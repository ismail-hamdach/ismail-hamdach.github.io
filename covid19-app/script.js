


const content=document.getElementById("content");
var list = document.getElementById('side')


function divClecked(e){
    console.log(e.target.innerHTML)
}

let httpReq = new XMLHttpRequest()
httpReq.open("GET" , "https://api.covid19api.com/countries", true)
httpReq.onreadystatechange=function(){
    if(httpReq.readyState == 4 && httpReq.status == 200 ){
        let resp = JSON.parse(httpReq.response)
        
        resp.forEach(e => {
            let d=document.createElement("div")
            d.setAttribute("class","items")
            d.setAttribute("id",e.ISO2)
            d.innerHTML = e.Country
            d.addEventListener("click",divClecked)
            list.appendChild(d)
        });
    }
    
}

httpReq.send()






function divClecked(e){
    let slug=e.target.getAttribute("id")
    httpReq.open("GET",`https://api.covid19api.com/dayone/country/${slug}`)
    httpReq.onreadystatechange=function(){
        if(httpReq.readyState==4 && httpReq.status==200){
            let resp=JSON.parse(httpReq.response)
            let confirmed=resp.map(e=> e.Confirmed)
            let recovered=resp.map(e=> e.Recovered)
            let deaths=resp.map(e=> e.Deaths)
            let active=resp.map(e=> e.Active)
            let lbl=resp.map(e=>`${new Date(e.Date).getDate()}/${new Date(e.Date).getMonth()+1}`)
            let country = resp.map( e => e.Country)
            console.log(e.target.textContent)
            creatChart(content,e.target.textContent,lbl,confirmed,active, recovered,deaths)
            
        }
    }
    httpReq.send()
}





function creatChart(container,title="",lbl=[],confirmed=[],active=[], recovered=[],deaths=[]){
    let myCanvas=document.createElement('canvas');
    myCanvas.setAttribute("id","canvas");
    container.innerHTML="";
    container.appendChild(myCanvas);
    
    let mychart = new Chart(myCanvas.getContext('2d'), {
        type: 'line',
        
        data: {
            labels: lbl,
            datasets:[
                {
                    label: "Confirmés",
                    data: confirmed,
                    backgroundColor: 'rgba(146,168,209,0.3)',
                    borderColor: '#034f84'
                },
                {
                    label: "Géris",
                    data: recovered,
                    backgroundColor: 'rgba(181,231,160,0.3)',
                    borderColor: ' #82b74b'
                },
                {
                    label: "Décés",
                    data: deaths,
                    backgroundColor: 'rgba(201,76,76,0.3)',
                    borderColor: '#c94c4c'
                },
                {
                    label: "Active",
                    data: active,
                    backgroundColor: 'rgba(255,204,92,0.3)',
                    borderColor: '#ffcc5c'
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
