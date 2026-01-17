/**
 * 11X Game Implementation
 * Multiply coins by 11x
 */

const elevenXCanvas = document.getElementById('elevenXCanvas');
const elevenXCtx = elevenXCanvas.getContext('2d');

let elevenXGameState = {
    isPlaying: false,
    multiplier: 1.0,
    betAmount: 10,
    winnings: 0,
    balance: parseInt(localStorage.getItem('user_coins')) || 1000,
    crashPoint: 0,
    animationId: null
};

function drawElevenXDisplay() {
    // Clear canvas
    elevenXCtx.fillStyle = 'rgba(10, 14, 39, 0.8)';
    elevenXCtx.fillRect(0, 0, elevenXCanvas.width, elevenXCanvas.height);
    
    // Draw background grid
    elevenXCtx.strokeStyle = 'rgba(255, 215, 0, 0.1)';
    elevenXCtx.lineWidth = 1;
    for (let i = 0; i < elevenXCanvas.width; i += 50) {
        elevenXCtx.beginPath();
        elevenXCtx.moveTo(i, 0);
        elevenXCtx.lineTo(i, elevenXCanvas.height);
        elevenXCtx.stroke();
    }
    
    if (!elevenXGameState.isPlaying) {
        // Draw ready state
        elevenXCtx.font = 'bold 48px Arial';
        elevenXCtx.fillStyle = '#FFD700';
        elevenXCtx.textAlign = 'center';
        elevenXCtx.textBaseline = 'middle';
        elevenXCtx.fillText('Ready', elevenXCanvas.width / 2, elevenXCanvas.height / 2);
        return;
    }
    
    // Draw multiplier
    elevenXCtx.font = 'bold 80px Arial';
    elevenXCtx.fillStyle = elevenXGameState.multiplier >= 5 ? '#ef4444' : '#FFD700';
    elevenXCtx.textAlign = 'center';
    elevenXCtx.textBaseline = 'middle';
    elevenXCtx.fillText(elevenXGameState.multiplier.toFixed(2) + 'x', elevenXCanvas.width / 2, elevenXCanvas.height / 2 - 50);
    
    // Draw status
    elevenXCtx.font = 'bold 24px Arial';
    elevenXCtx.fillStyle = '#10b981';
    elevenXCtx.fillText('RUNNING...', elevenXCanvas.width / 2, elevenXCanvas.height / 2 + 80);
    
    // Draw progress bar
    const barWidth = 300;
    const barHeight = 30;
    const barX = (elevenXCanvas.width - barWidth) / 2;
    const barY = elevenXCanvas.height - 60;
    
    elevenXCtx.fillStyle = 'rgba(255, 255, 255, 0.1)';
    elevenXCtx.fillRect(barX, barY, barWidth, barHeight);
    
    const progress = Math.min(elevenXGameState.multiplier / 11, 1);
    elevenXCtx.fillStyle = '#10b981';
    elevenXCtx.fillRect(barX, barY, barWidth * progress, barHeight);
    
    elevenXCtx.strokeStyle = '#FFD700';
    elevenXCtx.lineWidth = 2;
    elevenXCtx.strokeRect(barX, barY, barWidth, barHeight);
}

function startElevenX() {
    const betAmount = parseInt(document.getElementById('elevenXBetAmount').value);
    
    if (betAmount < 1 || betAmount > 500) {
        alert('Bet amount must be between 1 and 500 coins');
        return;
    }
    
    if (elevenXGameState.balance < betAmount) {
        alert('Insufficient balance');
        return;
    }
    
    elevenXGameState.betAmount = betAmount;
    elevenXGameState.balance -= betAmount;
    elevenXGameState.multiplier = 1.0;
    elevenXGameState.winnings = betAmount;
    elevenXGameState.isPlaying = true;
    
    // Random crash point between 1.5 and 11.5
    elevenXGameState.crashPoint = 1.5 + Math.random() * 10;
    
    document.getElementById('elevenXStartBtn').classList.add('hidden');
    document.getElementById('elevenXCashoutBtn').classList.remove('hidden');
    
    updateElevenXBalance();
    animateElevenX();
}

function animateElevenX() {
    if (!elevenXGameState.isPlaying) {
        drawElevenXDisplay();
        return;
    }
    
    // Increase multiplier
    elevenXGameState.multiplier += 0.05 + Math.random() * 0.1;
    elevenXGameState.winnings = Math.floor(elevenXGameState.betAmount * elevenXGameState.multiplier);
    
    document.getElementById('elevenXMultiplier').textContent = elevenXGameState.multiplier.toFixed(2) + 'x';
    document.getElementById('elevenXWinningsDisplay').textContent = elevenXGameState.winnings + ' Coins';
    
    drawElevenXDisplay();
    
    // Check if crashed
    if (elevenXGameState.multiplier >= elevenXGameState.crashPoint) {
        crash();
        return;
    }
    
    // Check if reached 11x
    if (elevenXGameState.multiplier >= 11) {
        elevenXGameState.multiplier = 11.0;
        elevenXGameState.winnings = Math.floor(elevenXGameState.betAmount * 11);
        document.getElementById('elevenXMultiplier').textContent = '11.0x';
        document.getElementById('elevenXWinningsDisplay').textContent = elevenXGameState.winnings + ' Coins';
        drawElevenXDisplay();
        return;
    }
    
    elevenXGameState.animationId = requestAnimationFrame(animateElevenX);
}

function crash() {
    elevenXGameState.isPlaying = false;
    elevenXGameState.balance += elevenXGameState.betAmount; // Return bet
    
    document.getElementById('elevenXStartBtn').classList.remove('hidden');
    document.getElementById('elevenXCashoutBtn').classList.add('hidden');
    
    updateElevenXBalance();
    
    // Draw crash
    elevenXCtx.fillStyle = 'rgba(10, 14, 39, 0.8)';
    elevenXCtx.fillRect(0, 0, elevenXCanvas.width, elevenXCanvas.height);
    
    elevenXCtx.font = 'bold 60px Arial';
    elevenXCtx.fillStyle = '#ef4444';
    elevenXCtx.textAlign = 'center';
    elevenXCtx.textBaseline = 'middle';
    elevenXCtx.fillText('CRASHED!', elevenXCanvas.width / 2, elevenXCanvas.height / 2);
    
    alert('💥 Game Crashed! You lost your bet.');
}

function elevenXCashout() {
    if (!elevenXGameState.isPlaying) return;
    
    elevenXGameState.isPlaying = false;
    elevenXGameState.balance += elevenXGameState.winnings;
    
    if (elevenXGameState.animationId) {
        cancelAnimationFrame(elevenXGameState.animationId);
    }
    
    document.getElementById('elevenXStartBtn').classList.remove('hidden');
    document.getElementById('elevenXCashoutBtn').classList.add('hidden');
    
    updateElevenXBalance();
    
    alert(`You cashed out at ${elevenXGameState.multiplier.toFixed(2)}x! Won ${elevenXGameState.winnings} coins!`);
    
    drawElevenXDisplay();
}

function resetElevenX() {
    if (elevenXGameState.animationId) {
        cancelAnimationFrame(elevenXGameState.animationId);
    }
    
    elevenXGameState.isPlaying = false;
    elevenXGameState.multiplier = 1.0;
    elevenXGameState.winnings = 0;
    
    document.getElementById('elevenXStartBtn').classList.remove('hidden');
    document.getElementById('elevenXCashoutBtn').classList.add('hidden');
    document.getElementById('elevenXMultiplier').textContent = '1.0x';
    document.getElementById('elevenXStatus').textContent = 'Ready';
    document.getElementById('elevenXWinningsDisplay').textContent = '0 Coins';
    
    drawElevenXDisplay();
}

function updateElevenXBalance() {
    document.getElementById('elevenXBalanceDisplay').textContent = elevenXGameState.balance + ' Coins';
    localStorage.setItem('user_coins', elevenXGameState.balance);
    
    const coinDisplay = document.getElementById('coinBalance');
    if (coinDisplay) {
        coinDisplay.innerText = new Intl.NumberFormat().format(elevenXGameState.balance) + ' Coins';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    elevenXGameState.balance = parseInt(localStorage.getItem('user_coins')) || 1000;
    updateElevenXBalance();
    drawElevenXDisplay();
});
