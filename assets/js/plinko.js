/**
 * Plinko Game - Canvas Implementation
 * Drop ball through pegs
 */

const plinkoCanvas = document.getElementById('plinkoCanvas');
const plinkoCtx = plinkoCanvas.getContext('2d');

let plinkoGameState = {
    balance: parseInt(localStorage.getItem('user_coins')) || 1000,
    betAmount: 10,
    ballsDropped: 0,
    lastMultiplier: 0,
    lastWinnings: 0,
    isDropping: false
};

const PLINKO_CONFIG = {
    pegRadius: 5,
    ballRadius: 8,
    rows: 8,
    cols: 9,
    gravity: 0.3,
    friction: 0.99,
    pegSpacingX: 60,
    pegSpacingY: 40,
    startX: 300,
    startY: 20,
    slotMultipliers: [0.5, 1.0, 1.5, 2.0, 3.0, 2.0, 1.5, 1.0, 0.5]
};

class Ball {
    constructor(x, y) {
        this.x = x;
        this.y = y;
        this.vx = (Math.random() - 0.5) * 2;
        this.vy = 0;
        this.radius = PLINKO_CONFIG.ballRadius;
    }
    
    update() {
        this.vy += PLINKO_CONFIG.gravity;
        this.x += this.vx;
        this.y += this.vy;
        
        this.vx *= PLINKO_CONFIG.friction;
        this.vy *= PLINKO_CONFIG.friction;
        
        // Bounce off walls
        if (this.x - this.radius < 0) {
            this.x = this.radius;
            this.vx *= -0.8;
        }
        if (this.x + this.radius > plinkoCanvas.width) {
            this.x = plinkoCanvas.width - this.radius;
            this.vx *= -0.8;
        }
    }
    
    draw() {
        plinkoCtx.beginPath();
        plinkoCtx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
        plinkoCtx.fillStyle = '#FFD700';
        plinkoCtx.fill();
        plinkoCtx.strokeStyle = '#FFA500';
        plinkoCtx.lineWidth = 2;
        plinkoCtx.stroke();
    }
}

let pegs = [];
let ball = null;
let animationId = null;

function initPlinko() {
    pegs = [];
    
    const startX = PLINKO_CONFIG.startX;
    const startY = PLINKO_CONFIG.startY + 50;
    const spacingX = PLINKO_CONFIG.pegSpacingX;
    const spacingY = PLINKO_CONFIG.pegSpacingY;
    
    for (let row = 0; row < PLINKO_CONFIG.rows; row++) {
        for (let col = 0; col < PLINKO_CONFIG.cols; col++) {
            const x = startX + col * spacingX - (PLINKO_CONFIG.cols * spacingX) / 2;
            const y = startY + row * spacingY;
            pegs.push({ x, y, radius: PLINKO_CONFIG.pegRadius });
        }
    }
}

function drawPlinko() {
    // Clear canvas
    plinkoCtx.fillStyle = 'rgba(10, 14, 39, 0.8)';
    plinkoCtx.fillRect(0, 0, plinkoCanvas.width, plinkoCanvas.height);
    
    // Draw pegs
    pegs.forEach(peg => {
        plinkoCtx.beginPath();
        plinkoCtx.arc(peg.x, peg.y, peg.radius, 0, Math.PI * 2);
        plinkoCtx.fillStyle = '#7c3aed';
        plinkoCtx.fill();
        plinkoCtx.strokeStyle = '#a78bfa';
        plinkoCtx.lineWidth = 1;
        plinkoCtx.stroke();
    });
    
    // Draw slots
    const slotWidth = 60;
    const slotStartX = PLINKO_CONFIG.startX - (PLINKO_CONFIG.cols * slotWidth) / 2;
    const slotY = plinkoCanvas.height - 40;
    
    PLINKO_CONFIG.slotMultipliers.forEach((multiplier, index) => {
        const x = slotStartX + index * slotWidth;
        
        plinkoCtx.fillStyle = multiplier >= 2 ? '#ef4444' : '#10b981';
        plinkoCtx.fillRect(x, slotY, slotWidth - 5, 30);
        
        plinkoCtx.strokeStyle = '#FFD700';
        plinkoCtx.lineWidth = 2;
        plinkoCtx.strokeRect(x, slotY, slotWidth - 5, 30);
        
        plinkoCtx.font = 'bold 12px Arial';
        plinkoCtx.fillStyle = '#FFF';
        plinkoCtx.textAlign = 'center';
        plinkoCtx.textBaseline = 'middle';
        plinkoCtx.fillText(multiplier + 'x', x + (slotWidth - 5) / 2, slotY + 15);
    });
    
    // Draw ball
    if (ball) {
        ball.draw();
    }
}

function animate() {
    if (!ball) {
        drawPlinko();
        return;
    }
    
    ball.update();
    
    // Check collision with pegs
    pegs.forEach(peg => {
        const dx = ball.x - peg.x;
        const dy = ball.y - peg.y;
        const distance = Math.sqrt(dx * dx + dy * dy);
        
        if (distance < ball.radius + peg.radius) {
            const angle = Math.atan2(dy, dx);
            ball.x = peg.x + Math.cos(angle) * (ball.radius + peg.radius);
            ball.y = peg.y + Math.sin(angle) * (ball.radius + peg.radius);
            
            ball.vx = Math.cos(angle) * 5;
            ball.vy = Math.sin(angle) * 5;
        }
    });
    
    // Check if ball reached bottom
    const slotY = plinkoCanvas.height - 40;
    if (ball.y > slotY) {
        const slotWidth = 60;
        const slotStartX = PLINKO_CONFIG.startX - (PLINKO_CONFIG.cols * slotWidth) / 2;
        
        let slotIndex = Math.floor((ball.x - slotStartX) / slotWidth);
        slotIndex = Math.max(0, Math.min(slotIndex, PLINKO_CONFIG.slotMultipliers.length - 1));
        
        const multiplier = PLINKO_CONFIG.slotMultipliers[slotIndex];
        const winnings = Math.floor(plinkoGameState.betAmount * multiplier);
        
        plinkoGameState.lastMultiplier = multiplier;
        plinkoGameState.lastWinnings = winnings;
        plinkoGameState.balance += winnings;
        plinkoGameState.ballsDropped++;
        
        ball = null;
        plinkoGameState.isDropping = false;
        
        document.getElementById('plinkoMultiplier').textContent = multiplier.toFixed(1) + 'x';
        document.getElementById('ballsDropped').textContent = plinkoGameState.ballsDropped;
        document.getElementById('plinkoWinningsDisplay').textContent = winnings + ' Coins';
        updatePlinkoBalance();
        
        drawPlinko();
        return;
    }
    
    drawPlinko();
    animationId = requestAnimationFrame(animate);
}

function dropBall() {
    if (plinkoGameState.isDropping) return;
    
    const betAmount = parseInt(document.getElementById('plinkoBetAmount').value);
    
    if (betAmount < 1 || betAmount > 500) {
        alert('Bet amount must be between 1 and 500 coins');
        return;
    }
    
    if (plinkoGameState.balance < betAmount) {
        alert('Insufficient balance');
        return;
    }
    
    plinkoGameState.betAmount = betAmount;
    plinkoGameState.balance -= betAmount;
    plinkoGameState.isDropping = true;
    
    ball = new Ball(PLINKO_CONFIG.startX, PLINKO_CONFIG.startY);
    
    updatePlinkoBalance();
    animate();
}

function resetPlinko() {
    if (animationId) {
        cancelAnimationFrame(animationId);
    }
    
    ball = null;
    plinkoGameState.isDropping = false;
    plinkoGameState.ballsDropped = 0;
    plinkoGameState.lastMultiplier = 0;
    plinkoGameState.lastWinnings = 0;
    
    document.getElementById('plinkoMultiplier').textContent = '0.0x';
    document.getElementById('ballsDropped').textContent = '0';
    document.getElementById('plinkoWinningsDisplay').textContent = '0 Coins';
    
    drawPlinko();
}

function updatePlinkoBalance() {
    document.getElementById('plinkoBalanceDisplay').textContent = plinkoGameState.balance + ' Coins';
    localStorage.setItem('user_coins', plinkoGameState.balance);
    
    const coinDisplay = document.getElementById('coinBalance');
    if (coinDisplay) {
        coinDisplay.innerText = new Intl.NumberFormat().format(plinkoGameState.balance) + ' Coins';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    plinkoGameState.balance = parseInt(localStorage.getItem('user_coins')) || 1000;
    initPlinko();
    updatePlinkoBalance();
    drawPlinko();
});
