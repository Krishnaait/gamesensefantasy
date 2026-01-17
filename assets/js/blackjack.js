document.addEventListener('DOMContentLoaded',function(){
const suits=['♠','♥','♦','♣'];
const ranks=['A','2','3','4','5','6','7','8','9','10','J','Q','K'];
let deck=[],playerHand=[],dealerHand=[],currentBet=0,gameActive=false;

document.getElementById('dealButton').addEventListener('click',function(){
const bet=parseInt(document.getElementById('betAmount').value)||10;
const credits=getCredits();
if(bet<1||bet>credits){alert('Invalid bet!');return;}
setCredits(credits-bet);
currentBet=bet;
startGame();
});

document.getElementById('hitButton').addEventListener('click',()=>{
playerHand.push(deck.pop());
displayHands();
if(getScore(playerHand)>21){endGame('BUST! Dealer wins');}
});

document.getElementById('standButton').addEventListener('click',()=>{
while(getScore(dealerHand)<17){dealerHand.push(deck.pop());}
displayHands(true);
const pScore=getScore(playerHand);
const dScore=getScore(dealerHand);
if(dScore>21||pScore>dScore){endGame('You WIN!',true);}
else if(pScore<dScore){endGame('Dealer wins');}
else{endGame('PUSH!',true);}
});

function startGame(){
createDeck();
playerHand=[deck.pop(),deck.pop()];
dealerHand=[deck.pop(),deck.pop()];
gameActive=true;
displayHands();
document.getElementById('dealButton').style.display='none';
document.getElementById('hitButton').style.display='block';
document.getElementById('standButton').style.display='block';
document.getElementById('gameResult').textContent='';
}

function createDeck(){
deck=[];
suits.forEach(s=>ranks.forEach(r=>deck.push(r+s)));
deck.sort(()=>Math.random()-0.5);
}

function getScore(hand){
let score=0,aces=0;
hand.forEach(card=>{
const rank=card.slice(0,-1);
if(rank==='A'){aces++;score+=11;}
else if(['J','Q','K'].includes(rank))score+=10;
else score+=parseInt(rank);
});
while(score>21&&aces>0){score-=10;aces--;}
return score;
}

function displayHands(showDealer=false){
const playerDiv=document.getElementById('playerHand');
const dealerDiv=document.getElementById('dealerHand');
playerDiv.innerHTML='';
dealerDiv.innerHTML='';
playerHand.forEach(card=>playerDiv.appendChild(createCard(card)));
dealerHand.forEach((card,i)=>dealerDiv.appendChild(createCard(showDealer||i>0?card:'??')));
document.getElementById('playerScore').textContent=getScore(playerHand);
document.getElementById('dealerScore').textContent=showDealer?getScore(dealerHand):'?';
}

function createCard(card){
const div=document.createElement('div');
div.style.cssText='width:60px;height:90px;background:white;border:2px solid #333;border-radius:5px;display:flex;align-items:center;justify-content:center;font-size:20px';
div.textContent=card;
return div;
}

function endGame(msg,won=false){
gameActive=false;
document.getElementById('gameResult').textContent=msg;
if(won){
const win=currentBet*2;
setCredits(getCredits()+win);
document.getElementById('lastWin').textContent=win;
}else{
document.getElementById('lastWin').textContent=0;
}
document.getElementById('hitButton').style.display='none';
document.getElementById('standButton').style.display='none';
document.getElementById('dealButton').style.display='block';
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