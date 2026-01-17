/**
 * 247LASER Game Implementation
 * Aim and shoot lasers at targets
 */

const laserCanvas = document.getElementById('laserCanvas');
const laserCtx = laserCanvas.getContext('2d');

let laserGameState = {
    isPlaying: false,
    targets: [],
    targetsHit: 0,
    multiplier: 1.0,
    betAmount: 10,
    winnings: 0,
    balance: parseInt(localStorage.getItem('user_coins')) || 1000,
    timeRemaining: 30,
    totalTime: 30,
    gameTimer: null
};

class Target {
    constructor(x, y) {
        this.x = x;
        this.y = y;
        this.radius = 20;
        this.hit = false;
    }
    
    draw() {
        laserCtx.beginPath();
        laserCtx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
        
        if (this.hit) {
            laserCtx.fillStyle = 'rgba(16, 185, 129, 0.3)';
        } else {
            laserCtx.fillStyle = '#ef4444';
        }
        
        laserCtx.fill();
        laserCtx.strokeStyle = '#FFD700';
        laserCtx.lineWidth = 2;
        laserCtx.stroke();
        
        // Draw crosshair
        laserCtx.strokeStyle = '#FFF';
        laserCtx.lineWidth = 1;
        laserCtx.beginPath();
        laserCtx.moveTo(this.x - 10, this.y);
        laserCtx.lineTo(this.x + 10, this.y);
        laserCtx.moveTo(this.x, this.y - 10);
        laserCtx.lineTo(this.x, this.y + 10);
        laserCtx.stroke();
    }
    
    isClicked(x, y) {
        const distance = Math.sqrt((x - this.x) ** 2 + (y - this.y) ** 2);
        return distance < this.radius;
    }
}

function createTargets() {
    laserGameState.targets = [];
    const targetCount = 8;
    
    for (let i = 0; i < targetCount; i++) {
        let x, y, overlapping;
        
        do {
            overlapping = false;
            x = Math.random() * (laserCanvas.width - 100) + 50;
            y = Math.random() * (laserCanvas.height - 100) + 50;
            
            for (let target of laserGameState.targets) {
                const distance = Math.sqrt((x - target.x) ** 2 + (y - target.y) ** 2);
                if (distance < 80) {
                    overlapping = true;
                    break;
                }
            }
        } while (overlapping);
        
        laserGameState.targets.push(new Target(x, y));
    }
}

function drawLaserGame() {
    // Clear canvas
    laserCtx.fillStyle = 'rgba(10, 14, 39, 0.8)';
    laserCtx.fillRect(0, 0, laserCanvas.width, laserCanvas.height);
    
    // Draw grid
    laserCtx.strokeStyle = 'rgba(255, 215, 0, 0.1)';
    laserCtx.lineWidth = 1;
    for (let i = 0; i < laserCanvas.width; i += 50) {
        laserCtx.beginPath();
        laserCtx.moveTo(i, 0);
        laserCtx.lineTo(i, laserCanvas.height);
        laserCtx.stroke();
    }
    for (let i = 0; i < laserCanvas.height; i += 50) {
        laserCtx.beginPath();
        laserCtx.moveTo(0, i);
        laserCtx.lineTo(laserCanvas.width, i);
        laserCtx.stroke();
    }
    
    // Draw targets
    laserGameState.targets.forEach(target => target.draw());
    
    // Draw status
    if (laserGameState.isPlaying) {
        laserCtx.font = 'bold 20px Arial';
        laserCtx.fillStyle = '#FFD700';
        laserCtx.textAlign = 'left';
        laserCtx.fillText(`Targets Hit: ${laserGameState.targetsHit}`, 10, 30);
        laserCtx.fillText(`Time: ${laserGameState.timeRemaining}s`, 10, 60);
    }
}

function startLaserGame() {
    const betAmount = parseInt(document.getElementById('laserBetAmount').value);
    
    if (betAmount < 1 || betAmount > 500) {
        alert('Bet amount must be between 1 and 500 coins');
        return;
    }
    
    if (laserGameState.balance < betAmount) {
        alert('Insufficient balance');
        return;
    }
    
    laserGameState.betAmount = betAmount;
    laserGameState.balance -= betAmount;
    laserGameState.targetsHit = 0;
    laserGameState.multiplier = 1.0;
    laserGameState.winnings = betAmount;
    laserGameState.timeRemaining = laserGameState.totalTime;
    laserGameState.isPlaying = true;
    
    document.getElementById('laserStartBtn').disabled = true;
    
    createTargets();
    drawLaserGame();
    updateLaserUI();
    
    laserGameState.gameTimer = setInterval(() => {
        laserGameState.timeRemaining--;
        document.getElementById('laserTimerDisplay').textContent = laserGameState.timeRemaining + 's';
        
        if (laserGameState.timeRemaining <= 0) {
            endLaserGame();
        }
    }, 1000);
}

function endLaserGame() {
    laserGameState.isPlaying = false;
    clearInterval(laserGameState.gameTimer);
    
    laserGameState.balance += laserGameState.winnings;
    
    document.getElementById('laserStartBtn').disabled = false;
    
    updateLaserBalance();
    drawLaserGame();
    
    alert(`Game Over! You hit ${laserGameState.targetsHit} targets and won ${laserGameState.winnings} coins!`);
}

function resetLaserGame() {
    if (laserGameState.gameTimer) {
        clearInterval(laserGameState.gameTimer);
    }
    
    laserGameState.isPlaying = false;
    laserGameState.targets = [];
    laserGameState.targetsHit = 0;
    laserGameState.multiplier = 1.0;
    laserGameState.winnings = 0;
    laserGameState.timeRemaining = laserGameState.totalTime;
    
    document.getElementById('laserStartBtn').disabled = false;
    document.getElementById('targetsHit').textContent = '0';
    document.getElementById('laserMultiplier').textContent = '1.0x';
    document.getElementById('laserWinningsDisplay').textContent = '0 Coins';
    document.getElementById('laserTimerDisplay').textContent = '30s';
    
    drawLaserGame();
}

function updateLaserUI() {
    document.getElementById('targetsHit').textContent = laserGameState.targetsHit;
    document.getElementById('laserMultiplier').textContent = laserGameState.multiplier.toFixed(1) + 'x';
    document.getElementById('laserWinningsDisplay').textContent = laserGameState.winnings + ' Coins';
    updateLaserBalance();
}

function updateLaserBalance() {
    document.getElementById('laserBalanceDisplay').textContent = laserGameState.balance + ' Coins';
    localStorage.setItem('user_coins', laserGameState.balance);
    
    const coinDisplay = document.getElementById('coinBalance');
    if (coinDisplay) {
        coinDisplay.innerText = new Intl.NumberFormat().format(laserGameState.balance) + ' Coins';
    }
}

laserCanvas.addEventListener('click', (e) => {
    if (!laserGameState.isPlaying) return;
    
    const rect = laserCanvas.getBoundingClientRect();
    const scaleX = laserCanvas.width / rect.width;
    const scaleY = laserCanvas.height / rect.height;
    const x = (e.clientX - rect.left) * scaleX;
    const y = (e.clientY - rect.top) * scaleY;
    
    for (let target of laserGameState.targets) {
        if (!target.hit && target.isClicked(x, y)) {
            target.hit = true;
            laserGameState.targetsHit++;
            laserGameState.multiplier += 0.5;
            laserGameState.winnings = Math.floor(laserGameState.betAmount * laserGameState.multiplier);
            
            updateLaserUI();
            drawLaserGame();
            break;
        }
    }
});

document.addEventListener('DOMContentLoaded', () => {
    laserGameState.balance = parseInt(localStorage.getItem('user_coins')) || 1000;
    updateLaserBalance();
    drawLaserGame();
});
