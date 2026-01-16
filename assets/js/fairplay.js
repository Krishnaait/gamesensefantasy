/**
 * Fair Play Game Implementation
 * Transparent game mechanics demonstration
 */

const fairplayCanvas = document.getElementById('fairplayCanvas');
const fairplayCtx = fairplayCanvas.getContext('2d');

let fairplayGameState = {
    balance: parseInt(localStorage.getItem('user_coins')) || 1000,
    betAmount: 10,
    roundsPlayed: 0,
    wins: 0,
    losses: 0,
    lastResult: null,
    isAnimating: false
};

function drawFairplayDisplay() {
    // Clear canvas
    fairplayCtx.fillStyle = 'rgba(10, 14, 39, 0.8)';
    fairplayCtx.fillRect(0, 0, fairplayCanvas.width, fairplayCanvas.height);
    
    // Draw title
    fairplayCtx.font = 'bold 24px Arial';
    fairplayCtx.fillStyle = '#FFD700';
    fairplayCtx.textAlign = 'center';
    fairplayCtx.fillText('FAIR PLAY - 50/50 ODDS', fairplayCanvas.width / 2, 40);
    
    if (fairplayGameState.lastResult === null) {
        // Initial state
        fairplayCtx.font = 'bold 48px Arial';
        fairplayCtx.fillStyle = '#7c3aed';
        fairplayCtx.textAlign = 'center';
        fairplayCtx.textBaseline = 'middle';
        fairplayCtx.fillText('?', fairplayCanvas.width / 2, fairplayCanvas.height / 2);
    } else if (fairplayGameState.lastResult === true) {
        // Win
        fairplayCtx.fillStyle = 'rgba(16, 185, 129, 0.2)';
        fairplayCtx.fillRect(0, 0, fairplayCanvas.width, fairplayCanvas.height);
        
        fairplayCtx.font = 'bold 80px Arial';
        fairplayCtx.fillStyle = '#10b981';
        fairplayCtx.textAlign = 'center';
        fairplayCtx.textBaseline = 'middle';
        fairplayCtx.fillText('✓ WIN', fairplayCanvas.width / 2, fairplayCanvas.height / 2);
    } else {
        // Loss
        fairplayCtx.fillStyle = 'rgba(239, 68, 68, 0.2)';
        fairplayCtx.fillRect(0, 0, fairplayCanvas.width, fairplayCanvas.height);
        
        fairplayCtx.font = 'bold 80px Arial';
        fairplayCtx.fillStyle = '#ef4444';
        fairplayCtx.textAlign = 'center';
        fairplayCtx.textBaseline = 'middle';
        fairplayCtx.fillText('✗ LOSS', fairplayCanvas.width / 2, fairplayCanvas.height / 2);
    }
    
    // Draw statistics
    fairplayCtx.font = '14px Arial';
    fairplayCtx.fillStyle = '#FFD700';
    fairplayCtx.textAlign = 'left';
    fairplayCtx.fillText(`Rounds: ${fairplayGameState.roundsPlayed}`, 20, fairplayCanvas.height - 20);
    
    const winRate = fairplayGameState.roundsPlayed > 0 
        ? ((fairplayGameState.wins / fairplayGameState.roundsPlayed) * 100).toFixed(1)
        : 0;
    fairplayCtx.fillText(`Win Rate: ${winRate}%`, fairplayCanvas.width / 2 - 50, fairplayCanvas.height - 20);
}

function playFairplay() {
    if (fairplayGameState.isAnimating) return;
    
    const betAmount = parseInt(document.getElementById('fairplayBetAmount').value);
    
    if (betAmount < 1 || betAmount > 500) {
        alert('Bet amount must be between 1 and 500 coins');
        return;
    }
    
    if (fairplayGameState.balance < betAmount) {
        alert('Insufficient balance');
        return;
    }
    
    fairplayGameState.betAmount = betAmount;
    fairplayGameState.balance -= betAmount;
    fairplayGameState.isAnimating = true;
    
    document.getElementById('fairplayPlayBtn').disabled = true;
    
    // Animate coin flip
    let flips = 0;
    const flipInterval = setInterval(() => {
        fairplayCtx.fillStyle = 'rgba(10, 14, 39, 0.8)';
        fairplayCtx.fillRect(0, 0, fairplayCanvas.width, fairplayCanvas.height);
        
        fairplayCtx.font = 'bold 24px Arial';
        fairplayCtx.fillStyle = '#FFD700';
        fairplayCtx.textAlign = 'center';
        fairplayCtx.fillText('FAIR PLAY - 50/50 ODDS', fairplayCanvas.width / 2, 40);
        
        fairplayCtx.font = 'bold 80px Arial';
        fairplayCtx.fillStyle = flips % 2 === 0 ? '#10b981' : '#ef4444';
        fairplayCtx.textAlign = 'center';
        fairplayCtx.textBaseline = 'middle';
        fairplayCtx.fillText(flips % 2 === 0 ? 'H' : 'T', fairplayCanvas.width / 2, fairplayCanvas.height / 2);
        
        flips++;
        
        if (flips > 10) {
            clearInterval(flipInterval);
            
            // Determine result (50/50 chance)
            const result = Math.random() < 0.5;
            fairplayGameState.lastResult = result;
            fairplayGameState.roundsPlayed++;
            
            if (result) {
                fairplayGameState.wins++;
                fairplayGameState.balance += betAmount * 2;
                document.getElementById('fairplayResultDisplay').textContent = `✓ Won ${betAmount} coins!`;
                document.getElementById('fairplayResultDisplay').style.color = '#10b981';
            } else {
                fairplayGameState.losses++;
                document.getElementById('fairplayResultDisplay').textContent = `✗ Lost ${betAmount} coins`;
                document.getElementById('fairplayResultDisplay').style.color = '#ef4444';
            }
            
            updateFairplayStats();
            updateFairplayBalance();
            drawFairplayDisplay();
            
            fairplayGameState.isAnimating = false;
            document.getElementById('fairplayPlayBtn').disabled = false;
        }
    }, 100);
}

function resetFairplay() {
    fairplayGameState.roundsPlayed = 0;
    fairplayGameState.wins = 0;
    fairplayGameState.losses = 0;
    fairplayGameState.lastResult = null;
    
    document.getElementById('fairplayResultDisplay').textContent = '-';
    document.getElementById('fairplayResultDisplay').style.color = 'var(--accent-gold)';
    document.getElementById('winsCount').textContent = '0';
    document.getElementById('lossesCount').textContent = '0';
    document.getElementById('roundsPlayed').textContent = '0';
    document.getElementById('winRate').textContent = '0%';
    
    drawFairplayDisplay();
}

function updateFairplayStats() {
    document.getElementById('winsCount').textContent = fairplayGameState.wins;
    document.getElementById('lossesCount').textContent = fairplayGameState.losses;
    document.getElementById('roundsPlayed').textContent = fairplayGameState.roundsPlayed;
    
    const winRate = fairplayGameState.roundsPlayed > 0 
        ? ((fairplayGameState.wins / fairplayGameState.roundsPlayed) * 100).toFixed(1)
        : 0;
    document.getElementById('winRate').textContent = winRate + '%';
}

function updateFairplayBalance() {
    document.getElementById('fairplayBalanceDisplay').textContent = fairplayGameState.balance + ' Coins';
    localStorage.setItem('user_coins', fairplayGameState.balance);
    
    const coinDisplay = document.getElementById('coinBalance');
    if (coinDisplay) {
        coinDisplay.innerText = new Intl.NumberFormat().format(fairplayGameState.balance) + ' Coins';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    fairplayGameState.balance = parseInt(localStorage.getItem('user_coins')) || 1000;
    updateFairplayBalance();
    drawFairplayDisplay();
});
