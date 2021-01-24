// const btnCircle=document.querySelector(".btn-circle");
// const circleMenu=document.querySelector(".circle-menu");
const span=document.querySelectorAll("span");
// btnCircle.addEventListener("click",()=>{
//     btnCircle.classList.toggle("menu-anim");
//     circleMenu.classList.toggle("circle-anim");
// })
let trajet=100;
for(i=0;i<span.length;i++){
    trajet=trajet+50;
    console.log(trajet);
            gsap.to(span[i],{
               opacity:0,
               x:Math.floor(Math.random()*800+trajet-70),
                y:Math.floor(Math.random()*800-70),
                z:Math.floor(Math.random()*800+trajet-70),
                rotation:Math.floor(Math.random()*10000-70),duration:4})
               
       }
    
      
    
     