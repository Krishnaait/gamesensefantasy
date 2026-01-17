document.addEventListener('DOMContentLoaded', function() {
    const suits = ['♠', '♥', '♦', '♣'];
    const ranks = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
    let deck = [];
    let hand = [];
    let held = [false, false, false, false, false];
    let currentBet = 0;
    
    document.getElementById('dealButton').addEventListener('click', function() {
        const bet = parseInt(document.getElementById('betAmount').value) || 10;
        const credits = getCredits();
        
        if (bet < 1 || bet > credits) {
            alert('Invalid bet amount!');
            return;
        }
        
        setCredits(credits - bet);
        currentBet = bet;
        dealHand();
        
        this.style.display = 'none';
        document.getElementById('drawButton').style.display = 'block';
        document.getElementById('handResult').textContent = 'Click cards to HOLD, then click DRAW';
    });
    
    document.getElementById('drawButton').addEventListener('click', function() {
        drawCards();
        evaluateHand();
        
        this.style.display = 'none';
        document.getElementById('dealButton').style.display = 'block';
    });
    
    function createDeck() {
        deck = [];
        suits.forEach(s => ranks.forEach(r => deck.push(r + s)));
        // Shuffle deck
        deck.sort(() => Math.random() - 0.5);
    }
    
    function dealHand() {
        createDeck();
        hand = deck.splice(0, 5);
        held = [false, false, false, false, false];
        displayHand();
    }
    
    function displayHand() {
        const handDiv = document.getElementById('pokerHand');
        handDiv.innerHTML = '';
        
        hand.forEach((card, i) => {
            const cardDiv = createCard(card, held[i]);
            cardDiv.onclick = () => {
                held[i] = !held[i];
                displayHand();
            };
            handDiv.appendChild(cardDiv);
        });
    }
    
    function createCard(card, isHeld = false) {
        const div = document.createElement('div');
        
        // Determine if card is red (hearts/diamonds) or black (spades/clubs)
        const suit = card.slice(-1);
        const rank = card.slice(0, -1);
        const isRed = suit === '♥' || suit === '♦';
        const color = isRed ? '#dc143c' : '#000';
        
        // Card styling
        div.style.cssText = `
            width: 90px;
            height: 130px;
            background: white;
            border: 4px solid ${isHeld ? '#FFD700' : '#333'};
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: ${color};
            box-shadow: 0 3px 8px rgba(0,0,0,0.3);
            margin: 5px;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        `;
        
        // Add HELD indicator
        if (isHeld) {
            div.innerHTML = `
                <div style="position: absolute; top: 5px; background: #FFD700; color: #000; padding: 2px 6px; border-radius: 3px; font-size: 10px; font-weight: bold;">HELD</div>
                <div style="font-size: 22px; margin-top: 20px;">${rank}</div>
                <div style="font-size: 40px;">${suit}</div>
                <div style="font-size: 22px; margin-bottom: 10px;">${rank}</div>
            `;
        } else {
            div.innerHTML = `
                <div style="font-size: 22px; margin-top: 10px;">${rank}</div>
                <div style="font-size: 40px;">${suit}</div>
                <div style="font-size: 22px; margin-bottom: 10px;">${rank}</div>
            `;
        }
        
        // Hover effect
        div.onmouseenter = () => {
            div.style.transform = 'translateY(-5px)';
            div.style.boxShadow = '0 5px 15px rgba(0,0,0,0.4)';
        };
        
        div.onmouseleave = () => {
            div.style.transform = 'translateY(0)';
            div.style.boxShadow = '0 3px 8px rgba(0,0,0,0.3)';
        };
        
        return div;
    }
    
    function drawCards() {
        hand.forEach((card, i) => {
            if (!held[i]) {
                hand[i] = deck.pop();
            }
        });
        displayHand();
    }
    
    function evaluateHand() {
        // Count ranks
        const rankCount = {};
        hand.forEach(c => {
            const rank = c.slice(0, -1);
            rankCount[rank] = (rankCount[rank] || 0) + 1;
        });
        
        const counts = Object.values(rankCount).sort((a, b) => b - a);
        
        // Check for flush (all same suit)
        const suitCount = {};
        hand.forEach(c => {
            const suit = c.slice(-1);
            suitCount[suit] = (suitCount[suit] || 0) + 1;
        });
        const isFlush = Object.values(suitCount).some(count => count === 5);
        
        // Determine hand type and multiplier
        let multiplier = 0;
        let handName = '';
        
        if (counts[0] === 4) {
            multiplier = 25;
            handName = 'Four of a Kind';
        } else if (counts[0] === 3 && counts[1] === 2) {
            multiplier = 9;
            handName = 'Full House';
        } else if (isFlush) {
            multiplier = 6;
            handName = 'Flush';
        } else if (counts[0] === 3) {
            multiplier = 3;
            handName = 'Three of a Kind';
        } else if (counts[0] === 2 && counts[1] === 2) {
            multiplier = 2;
            handName = 'Two Pair';
        } else if (counts[0] === 2) {
            multiplier = 1;
            handName = 'Pair';
        }
        
        const win = currentBet * multiplier;
        
        if (win > 0) {
            setCredits(getCredits() + win);
            document.getElementById('lastWin').textContent = win;
            document.getElementById('handResult').textContent = '🎉 ' + handName + '! ' + multiplier + 'x = ' + win + ' credits';
        } else {
            document.getElementById('lastWin').textContent = 0;
            document.getElementById('handResult').textContent = 'No winning hand. Try again!';
        }
        
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
