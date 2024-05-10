//Read message
let msgdiv=document.querySelector(".msg");
setInterval(()=>{fetch("readMsg.php").then(
    r=>{
        return r.text();
    }
).then(
    d=>
        {
            msgdiv.innerHTML=d;
        }
)},500);




//add message
window.onkeydown=(e)=>
    {
        if(e.keyCode=="Enter"){
            update();
        }
    }
function update(){
    let msg=input_msg.value;
    input_msg.value="";

    fetch(`addMsg.php?msg=${msg}`).then(
        r=>{
           if(r.ok){
            return r.text();
        }
    }
    ).then(
        d=>{
            console.log("msg has been sent");
            msgdiv.scrollTop=(msgdiv.scrollHeight-msgdiv.clientHeight);
        }
    )
}