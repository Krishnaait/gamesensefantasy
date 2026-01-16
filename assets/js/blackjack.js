/**
 * Blackjack Game Implementation
 * Beat the dealer with 21
 */

const blackjackCanvas = document.getElementById('blackjackCanvas');
const blackjackCtx = blackjackCanvas.getContext('2d');

let blackjackGameState = {
    balance: parseInt(localStorage.getItem('user_coins')) || 1000,
    betAmount: 10,
    playerCards: [],
    dealerCards: [],
    gamePhase: 'betting', // betting, playing, finished
    playerBust: false,
    dealerBust: false,
    result: '-'
};

const SUITS = ['♠', '♥', '♦', '♣'];
const RANKS = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

function createDeck() {
    const deck = [];
    for (let suit of SUITS) {
        for (let rank of RANKS) {
            deck.push({ rank, suit });
        }
    }
    return deck.sort(() => Math.random() - 0.5);
}

function getCardValue(card) {
    if (card.rank === 'A') return 11;
    if (['J', 'Q', 'K'].includes(card.rank)) return 10;
    return parseInt(card.rank);
}

function getHandValue(cards) {
    let value = 0;
    let aces = 0;
    
    cards.forEach(card => {
        value += getCardValue(card);
        if (card.rank === 'A') aces++;
    });
    
    while (value > 21 && aces > 0) {
        value -= 10;
        aces--;
    }
    
    return value;
}

function drawBlackjackDisplay() {
    // Clear canvas
    blackjackCtx.fillStyle = 'rgba(10, 14, 39, 0.8)';
    blackjackCtx.fillRect(0, 0, blackjackCanvas.width, blackjackCanvas.height);
    
    if (blackjackGameState.gamePhase === 'betting') {
        blackjackCtx.font = 'bold 32px Arial';
        blackjackCtx.fillStyle = '#FFD700';
        blackjackCtx.textAlign = 'center';
        blackjackCtx.textBaseline = 'middle';
        blackjackCtx.fillText('Click "Deal" to start', blackjackCanvas.width / 2, blackjackCanvas.height / 2);
        return;
    }
    
    // Draw dealer section
    blackjackCtx.font = 'bold 18px Arial';
    blackjackCtx.fillStyle = '#FFD700';
    blackjackCtx.textAlign = 'left';
    blackjackCtx.fillText('Dealer', 20, 40);
    
    drawCards(blackjackGameState.dealerCards, 20, 60);
    
    const dealerValue = getHandValue(blackjackGameState.dealerCards);
    blackjackCtx.fillText('Value: ' + dealerValue, 20, 150);
    
    // Draw player section
    blackjackCtx.fillText('You', 20, 200);
    drawCards(blackjackGameState.playerCards, 20, 220);
    
    const playerValue = getHandValue(blackjackGameState.playerCards);
    blackjackCtx.fillStyle = playerValue > 21 ? '#ef4444' : '#10b981';
    blackjackCtx.fillText('Value: ' + playerValue, 20, 310);
    
    // Draw result if finished
    if (blackjackGameState.gamePhase === 'finished') {
        blackjackCtx.font = 'bold 28px Arial';
        blackjackCtx.fillStyle = '#FFD700';
        blackjackCtx.textAlign = 'center';
        blackjackCtx.fillText(blackjackGameState.result, blackjackCanvas.width / 2, blackjackCanvas.height - 30);
    }
}

function drawCards(cards, x, y) {
    const cardWidth = 60;
    const cardHeight = 90;
    
    cards.forEach((card, index) => {
        const cardX = x + index * 70;
        
        blackjackCtx.fillStyle = '#fff';
        blackjackCtx.fillRect(cardX, y, cardWidth, cardHeight);
        
        blackjackCtx.strokeStyle = '#000';
        blackjackCtx.lineWidth = 2;
        blackjackCtx.strokeRect(cardX, y, cardWidth, cardHeight);
        
        blackjackCtx.font = 'bold 16px Arial';
        blackjackCtx.fillStyle = '#000';
        blackjackCtx.textAlign = 'center';
        blackjackCtx.textBaseline = 'middle';
        blackjackCtx.fillText(card.rank, cardX + cardWidth / 2, y + 30);
        blackjackCtx.fillText(card.suit, cardX + cardWidth / 2, y + 60);
    });
}

function dealBlackjack() {
    const betAmount = parseInt(document.getElementById('blackjackBetAmount').value);
    
    if (betAmount < 1 || betAmount > 500) {
        alert('Bet amount must be between 1 and 500 coins');
        return;
    }
    
    if (blackjackGameState.balance < betAmount) {
        alert('Insufficient balance');
        return;
    }
    
    blackjackGameState.betAmount = betAmount;
    blackjackGameState.balance -= betAmount;
    blackjackGameState.gamePhase = 'playing';
    blackjackGameState.playerBust = false;
    blackjackGameState.dealerBust = false;
    blackjackGameState.result = '-';
    
    const deck = createDeck();
    blackjackGameState.playerCards = [deck[0], deck[1]];
    blackjackGameState.dealerCards = [deck[2], deck[3]];
    
    document.getElementById('blackjackDealBtn').classList.add('hidden');
    document.getElementById('blackjackHitBtn').classList.remove('hidden');
    document.getElementById('blackjackStandBtn').classList.remove('hidden');
    
    updateBlackjackUI();
    drawBlackjackDisplay();
}

function hitBlackjack() {
    const deck = createDeck();
    blackjackGameState.playerCards.push(deck[Math.floor(Math.random() * deck.length)]);
    
    const playerValue = getHandValue(blackjackGameState.playerCards);
    if (playerValue > 21) {
        blackjackGameState.playerBust = true;
        endBlackjack();
    } else {
        updateBlackjackUI();
        drawBlackjackDisplay();
    }
}

function standBlackjack() {
    // Dealer plays
    const deck = createDeck();
    while (getHandValue(blackjackGameState.dealerCards) < 17) {
        blackjackGameState.dealerCards.push(deck[Math.floor(Math.random() * deck.length)]);
    }
    
    const dealerValue = getHandValue(blackjackGameState.dealerCards);
    if (dealerValue > 21) {
        blackjackGameState.dealerBust = true;
    }
    
    endBlackjack();
}

function endBlackjack() {
    blackjackGameState.gamePhase = 'finished';
    
    const playerValue = getHandValue(blackjackGameState.playerCards);
    const dealerValue = getHandValue(blackjackGameState.dealerCards);
    
    let winnings = 0;
    
    if (blackjackGameState.playerBust) {
        blackjackGameState.result = 'You Bust! You Lose!';
    } else if (blackjackGameState.dealerBust) {
        blackjackGameState.result = 'Dealer Bust! You Win!';
        winnings = blackjackGameState.betAmount * 2;
    } else if (playerValue > dealerValue) {
        blackjackGameState.result = 'You Win!';
        winnings = blackjackGameState.betAmount * 2;
    } else if (playerValue < dealerValue) {
        blackjackGameState.result = 'Dealer Wins!';
    } else {
        blackjackGameState.result = 'Push (Tie)!';
        winnings = blackjackGameState.betAmount;
    }
    
    blackjackGameState.balance += winnings;
    
    document.getElementById('blackjackDealBtn').classList.remove('hidden');
    document.getElementById('blackjackHitBtn').classList.add('hidden');
    document.getElementById('blackjackStandBtn').classList.add('hidden');
    
    updateBlackjackUI();
    drawBlackjackDisplay();
}

function updateBlackjackUI() {
    document.getElementById('playerHand').textContent = getHandValue(blackjackGameState.playerCards);
    document.getElementById('dealerHand').textContent = getHandValue(blackjackGameState.dealerCards);
    document.getElementById('blackjackResultDisplay').textContent = blackjackGameState.result;
    updateBlackjackBalance();
}

function updateBlackjackBalance() {
    document.getElementById('blackjackBalanceDisplay').textContent = blackjackGameState.balance + ' Coins';
    localStorage.setItem('user_coins', blackjackGameState.balance);
    
    const coinDisplay = document.getElementById('coinBalance');
    if (coinDisplay) {
        coinDisplay.innerText = new Intl.NumberFormat().format(blackjackGameState.balance) + ' Coins';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    blackjackGameState.balance = parseInt(localStorage.getItem('user_coins')) || 1000;
    updateBlackjackBalance();
    drawBlackjackDisplay();
});
