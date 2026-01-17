document.addEventListener('DOMContentLoaded',function(){
const canvas=document.getElementById('gameCanvas');
const ctx=canvas.getContext('2d');
let multiplier=1.0,gameActive=false,betPlaced=false,currentBet=0;
const betBtn=document.getElementById('betButton');
const cashoutBtn=document.getElementById('cashoutButton');

betBtn.addEventListener('click',function(){
const bet=parseInt(document.getElementById('betAmount').value)||10;
const credits=getCredits();
if(bet<1||bet>credits){alert('Invalid bet!');return;}
setCredits(credits-bet);
currentBet=bet;
betPlaced=true;
betBtn.style.display='none';
cashoutBtn.style.display='block';
startGame();
});

cashoutBtn.addEventListener('click',function(){
if(!betPlaced)return;
const win=Math.floor(currentBet*multiplier);
setCredits(getCredits()+win);
document.getElementById('lastWin').textContent=win;
alert('Cashed out at '+multiplier.toFixed(2)+'x! Won: '+win);
resetGame();
});

function startGame(){
gameActive=true;
multiplier=1.0;
const crashPoint=1+(Math.random()*10);
const interval=setInterval(()=>{
if(!gameActive){clearInterval(interval);return;}
multiplier+=0.01;
document.getElementById('multiplier').textContent=multiplier.toFixed(2)+'x';
drawGraph();
if(multiplier>=crashPoint){
gameActive=false;
clearInterval(interval);
alert('CRASHED at '+multiplier.toFixed(2)+'x!');
if(betPlaced){document.getElementById('lastWin').textContent=0;}
resetGame();
}
},50);
}

function drawGraph(){
ctx.clearRect(0,0,canvas.width,canvas.height);
ctx.strokeStyle='gold';
ctx.lineWidth=3;
ctx.beginPath();
ctx.moveTo(0,canvas.height);
ctx.lineTo((multiplier-1)*50,canvas.height-(multiplier-1)*30);
ctx.stroke();
}

function resetGame(){
betPlaced=false;
gameActive=false;
betBtn.style.display='block';
cashoutBtn.style.display='none';
updateUI();
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