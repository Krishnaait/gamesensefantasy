/**
 * Poker Game Implementation
 * Video poker
 */

const pokerCanvas = document.getElementById('pokerCanvas');
const pokerCtx = pokerCanvas.getContext('2d');

let pokerGameState = {
    balance: parseInt(localStorage.getItem('user_coins')) || 1000,
    betAmount: 10,
    gamesPlayed: 0,
    lastWinnings: 0,
    cards: [],
    held: [false, false, false, false, false],
    gamePhase: 'betting', // betting, dealt, drawn
    lastHand: '-'
};

const SUITS = ['♠', '♥', '♦', '♣'];
const RANKS = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

const HAND_RANKINGS = {
    'Royal Flush': 250,
    'Straight Flush': 50,
    'Four of a Kind': 25,
    'Full House': 9,
    'Flush': 6,
    'Straight': 4,
    'Three of a Kind': 3,
    'Two Pair': 2,
    'Pair': 1,
    'High Card': 0
};

function createDeck() {
    const deck = [];
    for (let suit of SUITS) {
        for (let rank of RANKS) {
            deck.push({ rank, suit });
        }
    }
    return deck.sort(() => Math.random() - 0.5);
}

function drawPokerDisplay() {
    // Clear canvas
    pokerCtx.fillStyle = 'rgba(10, 14, 39, 0.8)';
    pokerCtx.fillRect(0, 0, pokerCanvas.width, pokerCanvas.height);
    
    if (pokerGameState.gamePhase === 'betting') {
        pokerCtx.font = 'bold 32px Arial';
        pokerCtx.fillStyle = '#FFD700';
        pokerCtx.textAlign = 'center';
        pokerCtx.textBaseline = 'middle';
        pokerCtx.fillText('Click "Deal" to start', pokerCanvas.width / 2, pokerCanvas.height / 2);
        return;
    }
    
    // Draw cards
    const cardWidth = 80;
    const cardHeight = 120;
    const cardY = 80;
    const startX = (pokerCanvas.width - (cardWidth * 5 + 40)) / 2;
    
    for (let i = 0; i < 5; i++) {
        const x = startX + i * (cardWidth + 10);
        
        // Card background
        pokerCtx.fillStyle = pokerGameState.held[i] ? '#10b981' : '#fff';
        pokerCtx.fillRect(x, cardY, cardWidth, cardHeight);
        
        // Card border
        pokerCtx.strokeStyle = pokerGameState.held[i] ? '#059669' : '#000';
        pokerCtx.lineWidth = 2;
        pokerCtx.strokeRect(x, cardY, cardWidth, cardHeight);
        
        if (pokerGameState.cards[i]) {
            // Card text
            pokerCtx.font = 'bold 20px Arial';
            pokerCtx.fillStyle = '#000';
            pokerCtx.textAlign = 'center';
            pokerCtx.textBaseline = 'middle';
            pokerCtx.fillText(pokerGameState.cards[i].rank, x + cardWidth / 2, cardY + 30);
            pokerCtx.fillText(pokerGameState.cards[i].suit, x + cardWidth / 2, cardY + 70);
        }
        
        // Hold indicator
        if (pokerGameState.held[i]) {
            pokerCtx.font = 'bold 14px Arial';
            pokerCtx.fillStyle = '#059669';
            pokerCtx.textAlign = 'center';
            pokerCtx.fillText('HOLD', x + cardWidth / 2, cardY + cardHeight + 20);
        }
    }
    
    // Draw instructions
    pokerCtx.font = '14px Arial';
    pokerCtx.fillStyle = '#FFD700';
    pokerCtx.textAlign = 'center';
    pokerCtx.fillText('Click cards to hold them', pokerCanvas.width / 2, pokerCanvas.height - 30);
}

function dealPoker() {
    const betAmount = parseInt(document.getElementById('pokerBetAmount').value);
    
    if (betAmount < 1 || betAmount > 500) {
        alert('Bet amount must be between 1 and 500 coins');
        return;
    }
    
    if (pokerGameState.balance < betAmount) {
        alert('Insufficient balance');
        return;
    }
    
    pokerGameState.betAmount = betAmount;
    pokerGameState.balance -= betAmount;
    pokerGameState.gamesPlayed++;
    pokerGameState.gamePhase = 'dealt';
    pokerGameState.held = [false, false, false, false, false];
    
    const deck = createDeck();
    pokerGameState.cards = deck.slice(0, 5);
    
    document.getElementById('pokerDealBtn').classList.add('hidden');
    document.getElementById('pokerDrawBtn').classList.remove('hidden');
    
    updatePokerUI();
    drawPokerDisplay();
}

function drawPoker() {
    const deck = createDeck();
    let deckIndex = 0;
    
    for (let i = 0; i < 5; i++) {
        if (!pokerGameState.held[i]) {
            pokerGameState.cards[i] = deck[deckIndex++];
        }
    }
    
    pokerGameState.gamePhase = 'drawn';
    
    // Evaluate hand
    const handName = evaluatePokerHand(pokerGameState.cards);
    const payout = HAND_RANKINGS[handName] || 0;
    const winnings = pokerGameState.betAmount * payout;
    
    pokerGameState.lastHand = handName;
    pokerGameState.lastWinnings = winnings;
    pokerGameState.balance += winnings;
    
    document.getElementById('pokerDrawBtn').classList.add('hidden');
    document.getElementById('pokerDealBtn').classList.remove('hidden');
    
    updatePokerUI();
    drawPokerDisplay();
    
    alert(`Hand: ${handName}\nWinnings: ${winnings} coins!`);
}

function evaluatePokerHand(cards) {
    // Simplified poker hand evaluation
    const ranks = cards.map(c => RANKS.indexOf(c.rank));
    const suits = cards.map(c => c.suit);
    
    const rankCounts = {};
    ranks.forEach(r => rankCounts[r] = (rankCounts[r] || 0) + 1);
    
    const counts = Object.values(rankCounts).sort((a, b) => b - a);
    const isFlush = suits.every(s => s === suits[0]);
    const isStraight = ranks.sort((a, b) => a - b).every((r, i, arr) => i === 0 || r === arr[i-1] + 1);
    
    if (isFlush && isStraight && ranks.includes(12)) return 'Royal Flush';
    if (isFlush && isStraight) return 'Straight Flush';
    if (counts[0] === 4) return 'Four of a Kind';
    if (counts[0] === 3 && counts[1] === 2) return 'Full House';
    if (isFlush) return 'Flush';
    if (isStraight) return 'Straight';
    if (counts[0] === 3) return 'Three of a Kind';
    if (counts[0] === 2 && counts[1] === 2) return 'Two Pair';
    if (counts[0] === 2) return 'Pair';
    return 'High Card';
}

function resetPoker() {
    pokerGameState.gamePhase = 'betting';
    pokerGameState.cards = [];
    pokerGameState.held = [false, false, false, false, false];
    pokerGameState.lastHand = '-';
    pokerGameState.lastWinnings = 0;
    
    document.getElementById('pokerDealBtn').classList.remove('hidden');
    document.getElementById('pokerDrawBtn').classList.add('hidden');
    
    updatePokerUI();
    drawPokerDisplay();
}

function updatePokerUI() {
    document.getElementById('gamesPlayed').textContent = pokerGameState.gamesPlayed;
    document.getElementById('pokerHand').textContent = pokerGameState.lastHand;
    document.getElementById('pokerWinningsDisplay').textContent = pokerGameState.lastWinnings + ' Coins';
    updatePokerBalance();
}

function updatePokerBalance() {
    document.getElementById('pokerBalanceDisplay').textContent = pokerGameState.balance + ' Coins';
    localStorage.setItem('user_coins', pokerGameState.balance);
    
    const coinDisplay = document.getElementById('coinBalance');
    if (coinDisplay) {
        coinDisplay.innerText = new Intl.NumberFormat().format(pokerGameState.balance) + ' Coins';
    }
}

pokerCanvas.addEventListener('click', (e) => {
    if (pokerGameState.gamePhase !== 'dealt') return;
    
    const rect = pokerCanvas.getBoundingClientRect();
    const scaleX = pokerCanvas.width / rect.width;
    const scaleY = pokerCanvas.height / rect.height;
    const x = (e.clientX - rect.left) * scaleX;
    const y = (e.clientY - rect.top) * scaleY;
    
    const cardWidth = 80;
    const cardHeight = 120;
    const cardY = 80;
    const startX = (pokerCanvas.width - (cardWidth * 5 + 40)) / 2;
    
    for (let i = 0; i < 5; i++) {
        const cardX = startX + i * (cardWidth + 10);
        if (x >= cardX && x <= cardX + cardWidth && y >= cardY && y <= cardY + cardHeight) {
            pokerGameState.held[i] = !pokerGameState.held[i];
            drawPokerDisplay();
            break;
        }
    }
});

document.addEventListener('DOMContentLoaded', () => {
    pokerGameState.balance = parseInt(localStorage.getItem('user_coins')) || 1000;
    updatePokerBalance();
    drawPokerDisplay();
});
