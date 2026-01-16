/**
 * Dice Game - Canvas Implementation
 * Predict dice outcomes
 */

const diceCanvas = document.getElementById('diceCanvas');
const diceCtx = diceCanvas.getContext('2d');

let diceGameState = {
    prediction: null,
    betAmount: 10,
    balance: parseInt(localStorage.getItem('user_coins')) || 1000,
    lastResult: null,
    isRolling: false
};

function drawDice(value) {
    const size = 180;
    const x = (diceCanvas.width - size) / 2;
    const y = (diceCanvas.height - size) / 2;
    const dotRadius = 8;
    
    // Clear canvas
    diceCtx.fillStyle = 'rgba(10, 14, 39, 0.8)';
    diceCtx.fillRect(0, 0, diceCanvas.width, diceCanvas.height);
    
    // Draw dice
    diceCtx.fillStyle = '#FFD700';
    diceCtx.fillRect(x, y, size, size);
    diceCtx.strokeStyle = '#FFA500';
    diceCtx.lineWidth = 3;
    diceCtx.strokeRect(x, y, size, size);
    
    // Draw dots based on value
    diceCtx.fillStyle = '#000';
    
    const dotPositions = {
        1: [[0.5, 0.5]],
        2: [[0.25, 0.25], [0.75, 0.75]],
        3: [[0.25, 0.25], [0.5, 0.5], [0.75, 0.75]],
        4: [[0.25, 0.25], [0.75, 0.25], [0.25, 0.75], [0.75, 0.75]],
        5: [[0.25, 0.25], [0.75, 0.25], [0.5, 0.5], [0.25, 0.75], [0.75, 0.75]],
        6: [[0.25, 0.25], [0.75, 0.25], [0.25, 0.5], [0.75, 0.5], [0.25, 0.75], [0.75, 0.75]]
    };
    
    if (dotPositions[value]) {
        dotPositions[value].forEach(pos => {
            const dotX = x + size * pos[0];
            const dotY = y + size * pos[1];
            diceCtx.beginPath();
            diceCtx.arc(dotX, dotY, dotRadius, 0, Math.PI * 2);
            diceCtx.fill();
        });
    }
    
    // Draw value text
    diceCtx.font = 'bold 60px Arial';
    diceCtx.fillStyle = '#FFA500';
    diceCtx.textAlign = 'center';
    diceCtx.textBaseline = 'middle';
    diceCtx.fillText(value, diceCanvas.width / 2, diceCanvas.height / 2 + 80);
}

function selectPrediction(type) {
    diceGameState.prediction = type;
    document.getElementById('selectionDisplay').textContent = type.toUpperCase();
    
    // Highlight selected button
    document.querySelectorAll('.prediction-buttons button').forEach(btn => {
        btn.classList.remove('btn-primary');
        btn.classList.add('btn-secondary');
    });
    
    event.target.classList.remove('btn-secondary');
    event.target.classList.add('btn-primary');
}

function rollDice() {
    if (!diceGameState.prediction) {
        alert('Please select a prediction first');
        return;
    }
    
    const betAmount = parseInt(document.getElementById('betAmount').value);
    
    if (betAmount < 1 || betAmount > 500) {
        alert('Bet amount must be between 1 and 500 coins');
        return;
    }
    
    if (diceGameState.balance < betAmount) {
        alert('Insufficient balance');
        return;
    }
    
    diceGameState.isRolling = true;
    document.getElementById('rollBtn').disabled = true;
    
    // Animate dice rolling
    let rolls = 0;
    const rollInterval = setInterval(() => {
        const randomValue = Math.floor(Math.random() * 6) + 1;
        drawDice(randomValue);
        rolls++;
        
        if (rolls > 10) {
            clearInterval(rollInterval);
            
            // Final result
            const finalValue = Math.floor(Math.random() * 6) + 1;
            drawDice(finalValue);
            
            // Check if prediction was correct
            let won = false;
            
            if (diceGameState.prediction === 'high' && finalValue >= 4) won = true;
            if (diceGameState.prediction === 'low' && finalValue <= 3) won = true;
            if (diceGameState.prediction === 'even' && finalValue % 2 === 0) won = true;
            if (diceGameState.prediction === 'odd' && finalValue % 2 !== 0) won = true;
            
            if (won) {
                diceGameState.balance += betAmount * 2;
                diceGameState.lastResult = `✓ Won ${betAmount * 2} coins!`;
                document.getElementById('resultDisplay').textContent = `✓ Won ${betAmount * 2} coins!`;
                document.getElementById('resultDisplay').style.color = '#10b981';
            } else {
                diceGameState.balance -= betAmount;
                diceGameState.lastResult = `✗ Lost ${betAmount} coins`;
                document.getElementById('resultDisplay').textContent = `✗ Lost ${betAmount} coins`;
                document.getElementById('resultDisplay').style.color = '#ef4444';
            }
            
            updateBalance();
            diceGameState.isRolling = false;
            document.getElementById('rollBtn').disabled = false;
        }
    }, 100);
}

function resetGame() {
    diceGameState.prediction = null;
    diceGameState.lastResult = null;
    document.getElementById('selectionDisplay').textContent = 'None';
    document.getElementById('resultDisplay').textContent = '-';
    document.getElementById('resultDisplay').style.color = 'var(--accent-gold)';
    
    document.querySelectorAll('.prediction-buttons button').forEach(btn => {
        btn.classList.remove('btn-primary');
        btn.classList.add('btn-secondary');
    });
    
    drawDice(0);
}

function updateBalance() {
    document.getElementById('balanceDisplay').textContent = diceGameState.balance + ' Coins';
    localStorage.setItem('user_coins', diceGameState.balance);
    
    const coinDisplay = document.getElementById('coinBalance');
    if (coinDisplay) {
        coinDisplay.innerText = new Intl.NumberFormat().format(diceGameState.balance) + ' Coins';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    diceGameState.balance = parseInt(localStorage.getItem('user_coins')) || 1000;
    updateBalance();
    drawDice(0);
});
