document.addEventListener('DOMContentLoaded',function(){
const canvas=document.getElementById('laserCanvas');
const ctx=canvas.getContext('2d');
let score=0,timeLeft=30,gameActive=false,targets=[],currentBet=0;

document.getElementById('startButton').addEventListener('click',function(){
const bet=parseInt(document.getElementById('betAmount').value)||10;
const credits=getCredits();
if(bet<1||bet>credits){alert('Invalid bet!');return;}
setCredits(credits-bet);
currentBet=bet;
startGame();
});

canvas.addEventListener('click',function(e){
if(!gameActive)return;
const rect=canvas.getBoundingClientRect();
const x=e.clientX-rect.left;
const y=e.clientY-rect.top;
targets.forEach((t,i)=>{
const dist=Math.sqrt((x-t.x)**2+(y-t.y)**2);
if(dist<t.r){
score+=10;
targets.splice(i,1);
}
});
});

function startGame(){
gameActive=true;
score=0;
timeLeft=30;
targets=[];
spawnTargets();
const timer=setInterval(()=>{
if(!gameActive){clearInterval(timer);return;}
timeLeft--;
document.getElementById('score').textContent='Score: '+score+' | Time: '+timeLeft+'s';
if(timeLeft<=0){
gameActive=false;
clearInterval(timer);
const win=Math.floor(currentBet*(score/100));
setCredits(getCredits()+win);
document.getElementById('lastWin').textContent=win;
alert('Game Over! Score: '+score+' Won: '+win);
}
},1000);
gameLoop();
}

function spawnTargets(){
setInterval(()=>{
if(!gameActive||targets.length>=10)return;
targets.push({x:Math.random()*580+10,y:Math.random()*380+10,r:20});
},1000);
}

function gameLoop(){
if(!gameActive)return;
ctx.clearRect(0,0,canvas.width,canvas.height);
targets.forEach(t=>{
ctx.fillStyle='red';
ctx.beginPath();
ctx.arc(t.x,t.y,t.r,0,Math.PI*2);
ctx.fill();
});
requestAnimationFrame(gameLoop);
}

document.querySelectorAll('.quick-bet').forEach(btn=>{
btn.addEventListener('click',function(){
document.getElementById('betAmount').value=this.dataset.amount==='max'?getCredits():this.dataset.amount;
});
});

function getCredits(){return parseInt(localStorage.getItem('credits')||'1000');}
function setCredits(amount){localStorage.setItem('credits',amount);updateUI();}
function updateUI(){document.getElementById('credits').textContent=getCredits();}
updateUI();
});