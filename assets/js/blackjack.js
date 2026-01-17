document.addEventListener('DOMContentLoaded', function() {
    const suits = ['♠', '♥', '♦', '♣'];
    const ranks = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
    let deck = [];
    let playerHand = [];
    let dealerHand = [];
    let currentBet = 0;
    let gameActive = false;
    
    document.getElementById('dealButton').addEventListener('click', function() {
        const bet = parseInt(document.getElementById('betAmount').value) || 10;
        const credits = getCredits();
        
        if (bet < 1 || bet > credits) {
            alert('Invalid bet amount!');
            return;
        }
        
        setCredits(credits - bet);
        currentBet = bet;
        startGame();
    });
    
    document.getElementById('hitButton').addEventListener('click', () => {
        playerHand.push(deck.pop());
        displayHands();
        
        if (getScore(playerHand) > 21) {
            endGame('BUST! Dealer wins');
        }
    });
    
    document.getElementById('standButton').addEventListener('click', () => {
        // Dealer draws until 17 or higher
        while (getScore(dealerHand) < 17) {
            dealerHand.push(deck.pop());
        }
        
        displayHands(true);
        
        const pScore = getScore(playerHand);
        const dScore = getScore(dealerHand);
        
        if (dScore > 21 || pScore > dScore) {
            endGame('You WIN!', true);
        } else if (pScore < dScore) {
            endGame('Dealer wins');
        } else {
            endGame('PUSH! (Tie)', true);
        }
    });
    
    function startGame() {
        createDeck();
        playerHand = [deck.pop(), deck.pop()];
        dealerHand = [deck.pop(), deck.pop()];
        gameActive = true;
        displayHands();
        
        document.getElementById('dealButton').style.display = 'none';
        document.getElementById('hitButton').style.display = 'block';
        document.getElementById('standButton').style.display = 'block';
        document.getElementById('gameResult').textContent = '';
    }
    
    function createDeck() {
        deck = [];
        suits.forEach(s => ranks.forEach(r => deck.push(r + s)));
        // Shuffle deck
        deck.sort(() => Math.random() - 0.5);
    }
    
    function getScore(hand) {
        let score = 0;
        let aces = 0;
        
        hand.forEach(card => {
            const rank = card.slice(0, -1);
            if (rank === 'A') {
                aces++;
                score += 11;
            } else if (['J', 'Q', 'K'].includes(rank)) {
                score += 10;
            } else {
                score += parseInt(rank);
            }
        });
        
        // Adjust for aces
        while (score > 21 && aces > 0) {
            score -= 10;
            aces--;
        }
        
        return score;
    }
    
    function displayHands(showDealer = false) {
        const playerDiv = document.getElementById('playerHand');
        const dealerDiv = document.getElementById('dealerHand');
        
        playerDiv.innerHTML = '';
        dealerDiv.innerHTML = '';
        
        // Display player hand
        playerHand.forEach(card => {
            playerDiv.appendChild(createCard(card));
        });
        
        // Display dealer hand (hide first card unless showDealer is true)
        dealerHand.forEach((card, i) => {
            if (showDealer || i > 0) {
                dealerDiv.appendChild(createCard(card));
            } else {
                dealerDiv.appendChild(createCard('??'));
            }
        });
        
        document.getElementById('playerScore').textContent = getScore(playerHand);
        document.getElementById('dealerScore').textContent = showDealer ? getScore(dealerHand) : '?';
    }
    
    function createCard(card) {
        const div = document.createElement('div');
        
        // Determine if card is red (hearts/diamonds) or black (spades/clubs)
        const suit = card.slice(-1);
        const isRed = suit === '♥' || suit === '♦';
        const color = isRed ? '#dc143c' : '#000';
        
        // Card styling
        div.style.cssText = `
            width: 70px;
            height: 100px;
            background: white;
            border: 2px solid #333;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: bold;
            color: ${color};
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            margin: 5px;
        `;
        
        if (card === '??') {
            div.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
            div.style.color = 'white';
            div.textContent = '?';
        } else {
            // Split rank and suit for better display
            const rank = card.slice(0, -1);
            div.innerHTML = `
                <div style="font-size: 18px; margin-top: 5px;">${rank}</div>
                <div style="font-size: 32px;">${suit}</div>
                <div style="font-size: 18px; margin-bottom: 5px;">${rank}</div>
            `;
        }
        
        return div;
    }
    
    function endGame(msg, won = false) {
        gameActive = false;
        document.getElementById('gameResult').textContent = msg;
        
        if (won) {
            const win = currentBet * 2;
            setCredits(getCredits() + win);
            document.getElementById('lastWin').textContent = win;
        } else {
            document.getElementById('lastWin').textContent = 0;
        }
        
        document.getElementById('hitButton').style.display = 'none';
        document.getElementById('standButton').style.display = 'none';
        document.getElementById('dealButton').style.display = 'block';
        
        updateUI();
    }
    
    // Quick bet buttons
    document.querySelectorAll('.quick-bet').forEach(btn => {
        btn.addEventListener('click', function() {
            const amount = this.dataset.amount === 'max' ? getCredits() : this.dataset.amount;
            document.getElementById('betAmount').value = amount;
        });
    });
    
    // Credits management
    function getCredits() {
        return parseInt(localStorage.getItem('credits') || '1000');
    }
    
    function setCredits(amount) {
        localStorage.setItem('credits', amount);
        updateUI();
    }
    
    function updateUI() {
        document.getElementById('credits').textContent = getCredits();
    }
    
    // Initialize
    updateUI();
});
