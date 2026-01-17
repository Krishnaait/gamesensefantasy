document.addEventListener('DOMContentLoaded',function(){
const suits=['♠','♥','♦','♣'];
const ranks=['2','3','4','5','6','7','8','9','10','J','Q','K','A'];
let deck=[],hand=[],held=[false,false,false,false,false],currentBet=0;

document.getElementById('dealButton').addEventListener('click',function(){
const bet=parseInt(document.getElementById('betAmount').value)||10;
const credits=getCredits();
if(bet<1||bet>credits){alert('Invalid bet!');return;}
setCredits(credits-bet);
currentBet=bet;
dealHand();
this.style.display='none';
document.getElementById('drawButton').style.display='block';
});

document.getElementById('drawButton').addEventListener('click',function(){
drawCards();
evaluateHand();
this.style.display='none';
document.getElementById('dealButton').style.display='block';
});

function createDeck(){
deck=[];
suits.forEach(s=>ranks.forEach(r=>deck.push(r+s)));
deck.sort(()=>Math.random()-0.5);
}

function dealHand(){
createDeck();
hand=deck.splice(0,5);
held=[false,false,false,false,false];
displayHand();
}

function displayHand(){
const handDiv=document.getElementById('pokerHand');
handDiv.innerHTML='';
hand.forEach((card,i)=>{
const cardDiv=document.createElement('div');
cardDiv.style.cssText='width:80px;height:120px;background:white;border:3px solid '+(held[i]?'gold':'#ccc')+';border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:24px;cursor:pointer';
cardDiv.textContent=card;
cardDiv.onclick=()=>{held[i]=!held[i];displayHand();};
handDiv.appendChild(cardDiv);
});
}

function drawCards(){
hand.forEach((card,i)=>{
if(!held[i])hand[i]=deck.pop();
});
displayHand();
}

function evaluateHand(){
const rankCount={};
hand.forEach(c=>rankCount[c[0]]=(rankCount[c[0]]||0)+1);
const counts=Object.values(rankCount).sort((a,b)=>b-a);
let multiplier=0;
if(counts[0]===4)multiplier=25;
else if(counts[0]===3&&counts[1]===2)multiplier=9;
else if(counts[0]===3)multiplier=3;
else if(counts[0]===2&&counts[1]===2)multiplier=2;
else if(counts[0]===2)multiplier=1;
const win=currentBet*multiplier;
if(win>0){
setCredits(getCredits()+win);
document.getElementById('lastWin').textContent=win;
document.getElementById('handResult').textContent='WIN! '+multiplier+'x = '+win+' credits';
}else{
document.getElementById('lastWin').textContent=0;
document.getElementById('handResult').textContent='No win. Try again!';
}
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