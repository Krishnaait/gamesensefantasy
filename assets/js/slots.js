/**
 * Slots Game Implementation
 * Classic slot machine
 */

const slotsCanvas = document.getElementById('slotsCanvas');
const slotsCtx = slotsCanvas.getContext('2d');

let slotsGameState = {
    balance: parseInt(localStorage.getItem('user_coins')) || 1000,
    betAmount: 10,
    totalSpins: 0,
    lastWin: 0,
    isSpinning: false,
    reels: [0, 0, 0],
    symbols: ['🍒', '🍋', '🍊', '🍉', '7️⃣']
};

const PAYOUTS = {
    '🍒🍒🍒': 2,
    '🍋🍋🍋': 3,
    '🍊🍊🍊': 4,
    '🍉🍉🍉': 5,
    '7️⃣7️⃣7️⃣': 10
};

function drawSlotsDisplay() {
    // Clear canvas
    slotsCtx.fillStyle = 'rgba(10, 14, 39, 0.8)';
    slotsCtx.fillRect(0, 0, slotsCanvas.width, slotsCanvas.height);
    
    // Draw frame
    slotsCtx.strokeStyle = '#FFD700';
    slotsCtx.lineWidth = 3;
    slotsCtx.strokeRect(50, 50, 500, 200);
    
    // Draw reels
    const reelWidth = 140;
    const reelHeight = 180;
    const reelX = [80, 240, 400];
    const reelY = 60;
    
    for (let i = 0; i < 3; i++) {
        // Reel background
        slotsCtx.fillStyle = 'rgba(0, 0, 0, 0.5)';
        slotsCtx.fillRect(reelX[i], reelY, reelWidth, reelHeight);
        slotsCtx.strokeStyle = '#7c3aed';
        slotsCtx.lineWidth = 2;
        slotsCtx.strokeRect(reelX[i], reelY, reelWidth, reelHeight);
        
        // Draw symbol
        slotsCtx.font = 'bold 80px Arial';
        slotsCtx.textAlign = 'center';
        slotsCtx.textBaseline = 'middle';
        slotsCtx.fillStyle = '#FFD700';
        slotsCtx.fillText(slotsGameState.symbols[slotsGameState.reels[i]], reelX[i] + reelWidth / 2, reelY + reelHeight / 2);
    }
    
    // Draw title
    slotsCtx.font = 'bold 24px Arial';
    slotsCtx.fillStyle = '#FFD700';
    slotsCtx.textAlign = 'center';
    slotsCtx.fillText('🎰 SLOTS 🎰', slotsCanvas.width / 2, 30);
}

function spinSlots() {
    if (slotsGameState.isSpinning) return;
    
    const betAmount = parseInt(document.getElementById('slotsBetAmount').value);
    
    if (betAmount < 1 || betAmount > 500) {
        alert('Bet amount must be between 1 and 500 coins');
        return;
    }
    
    if (slotsGameState.balance < betAmount) {
        alert('Insufficient balance');
        return;
    }
    
    slotsGameState.betAmount = betAmount;
    slotsGameState.balance -= betAmount;
    slotsGameState.isSpinning = true;
    slotsGameState.totalSpins++;
    
    document.getElementById('slotsSpinBtn').disabled = true;
    
    // Animate spinning
    let spins = 0;
    const spinInterval = setInterval(() => {
        slotsGameState.reels[0] = Math.floor(Math.random() * slotsGameState.symbols.length);
        slotsGameState.reels[1] = Math.floor(Math.random() * slotsGameState.symbols.length);
        slotsGameState.reels[2] = Math.floor(Math.random() * slotsGameState.symbols.length);
        
        drawSlotsDisplay();
        spins++;
        
        if (spins > 15) {
            clearInterval(spinInterval);
            
            // Final result
            slotsGameState.reels[0] = Math.floor(Math.random() * slotsGameState.symbols.length);
            slotsGameState.reels[1] = Math.floor(Math.random() * slotsGameState.symbols.length);
            slotsGameState.reels[2] = Math.floor(Math.random() * slotsGameState.symbols.length);
            
            drawSlotsDisplay();
            
            // Check for win
            const combination = slotsGameState.symbols[slotsGameState.reels[0]] +
                               slotsGameState.symbols[slotsGameState.reels[1]] +
                               slotsGameState.symbols[slotsGameState.reels[2]];
            
            if (PAYOUTS[combination]) {
                const winAmount = betAmount * PAYOUTS[combination];
                slotsGameState.balance += winAmount;
                slotsGameState.lastWin = winAmount;
                
                document.getElementById('slotsResultDisplay').textContent = `✓ Won ${winAmount} coins!`;
                document.getElementById('slotsResultDisplay').style.color = '#10b981';
            } else {
                document.getElementById('slotsResultDisplay').textContent = `✗ No match`;
                document.getElementById('slotsResultDisplay').style.color = '#ef4444';
            }
            
            updateSlotsUI();
            slotsGameState.isSpinning = false;
            document.getElementById('slotsSpinBtn').disabled = false;
        }
    }, 100);
}

function resetSlots() {
    slotsGameState.isSpinning = false;
    slotsGameState.reels = [0, 0, 0];
    slotsGameState.lastWin = 0;
    slotsGameState.totalSpins = 0;
    
    document.getElementById('slotsSpinBtn').disabled = false;
    document.getElementById('slotsResultDisplay').textContent = '-';
    document.getElementById('slotsResultDisplay').style.color = 'var(--accent-gold)';
    document.getElementById('lastSlotWin').textContent = '0 Coins';
    document.getElementById('totalSpins').textContent = '0';
    
    drawSlotsDisplay();
}

function updateSlotsUI() {
    document.getElementById('lastSlotWin').textContent = slotsGameState.lastWin + ' Coins';
    document.getElementById('totalSpins').textContent = slotsGameState.totalSpins;
    updateSlotsBalance();
}

function updateSlotsBalance() {
    document.getElementById('slotsBalanceDisplay').textContent = slotsGameState.balance + ' Coins';
    localStorage.setItem('user_coins', slotsGameState.balance);
    
    const coinDisplay = document.getElementById('coinBalance');
    if (coinDisplay) {
        coinDisplay.innerText = new Intl.NumberFormat().format(slotsGameState.balance) + ' Coins';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    slotsGameState.balance = parseInt(localStorage.getItem('user_coins')) || 1000;
    updateSlotsBalance();
    drawSlotsDisplay();
});
