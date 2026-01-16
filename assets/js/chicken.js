/**
 * Chicken Game - Canvas Implementation
 * Pick eggs and avoid bones
 */

const canvas = document.getElementById('gameCanvas');
const ctx = canvas.getContext('2d');

let gameState = {
    isPlaying: false,
    items: [],
    multiplier: 1.0,
    itemsCount: 0,
    betAmount: 10,
    winnings: 0,
    balance: parseInt(localStorage.getItem('user_coins')) || 1000
};

const ITEM_RADIUS = 30;
const ITEM_COUNT = 12;

class Item {
    constructor(x, y, isEgg) {
        this.x = x;
        this.y = y;
        this.isEgg = isEgg;
        this.radius = ITEM_RADIUS;
        this.clicked = false;
    }
    
    draw() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
        
        if (this.clicked) {
            ctx.fillStyle = 'rgba(100, 100, 100, 0.3)';
        } else if (this.isEgg) {
            ctx.fillStyle = '#FFD700';
            ctx.shadowColor = 'rgba(255, 215, 0, 0.5)';
            ctx.shadowBlur = 10;
        } else {
            ctx.fillStyle = '#8B4513';
            ctx.shadowColor = 'rgba(139, 69, 19, 0.5)';
            ctx.shadowBlur = 10;
        }
        
        ctx.fill();
        ctx.strokeStyle = this.isEgg ? '#FFA500' : '#654321';
        ctx.lineWidth = 2;
        ctx.stroke();
        
        ctx.shadowColor = 'transparent';
        
        // Draw emoji
        ctx.font = '20px Arial';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillStyle = '#000';
        ctx.fillText(this.isEgg ? '🥚' : '💀', this.x, this.y);
    }
    
    isClicked(x, y) {
        const distance = Math.sqrt((x - this.x) ** 2 + (y - this.y) ** 2);
        return distance < this.radius;
    }
}

function initGame() {
    gameState.items = [];
    gameState.multiplier = 1.0;
    gameState.itemsCount = 0;
    gameState.winnings = 0;
    
    // Create random items (80% eggs, 20% bones)
    const positions = generateRandomPositions(ITEM_COUNT);
    positions.forEach((pos, index) => {
        const isEgg = Math.random() < 0.8;
        gameState.items.push(new Item(pos.x, pos.y, isEgg));
    });
    
    gameState.isPlaying = true;
    updateUI();
    draw();
}

function generateRandomPositions(count) {
    const positions = [];
    const padding = ITEM_RADIUS + 20;
    
    for (let i = 0; i < count; i++) {
        let x, y, overlapping;
        
        do {
            overlapping = false;
            x = Math.random() * (canvas.width - padding * 2) + padding;
            y = Math.random() * (canvas.height - padding * 2) + padding;
            
            for (let pos of positions) {
                const distance = Math.sqrt((x - pos.x) ** 2 + (y - pos.y) ** 2);
                if (distance < ITEM_RADIUS * 2 + 20) {
                    overlapping = true;
                    break;
                }
            }
        } while (overlapping);
        
        positions.push({ x, y });
    }
    
    return positions;
}

function draw() {
    // Clear canvas
    ctx.fillStyle = 'rgba(10, 14, 39, 0.8)';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    // Draw grid
    ctx.strokeStyle = 'rgba(255, 215, 0, 0.1)';
    ctx.lineWidth = 1;
    for (let i = 0; i < canvas.width; i += 50) {
        ctx.beginPath();
        ctx.moveTo(i, 0);
        ctx.lineTo(i, canvas.height);
        ctx.stroke();
    }
    for (let i = 0; i < canvas.height; i += 50) {
        ctx.beginPath();
        ctx.moveTo(0, i);
        ctx.lineTo(canvas.width, i);
        ctx.stroke();
    }
    
    // Draw items
    gameState.items.forEach(item => item.draw());
    
    // Draw status text
    if (gameState.isPlaying) {
        ctx.font = 'bold 24px Arial';
        ctx.fillStyle = '#FFD700';
        ctx.textAlign = 'center';
        ctx.fillText(`Multiplier: ${gameState.multiplier.toFixed(1)}x`, canvas.width / 2, 30);
    }
}

function startGame() {
    const betAmount = parseInt(document.getElementById('betAmount').value);
    
    if (betAmount < 1 || betAmount > 500) {
        alert('Bet amount must be between 1 and 500 coins');
        return;
    }
    
    if (gameState.balance < betAmount) {
        alert('Insufficient balance');
        return;
    }
    
    gameState.betAmount = betAmount;
    gameState.balance -= betAmount;
    gameState.winnings = betAmount;
    
    document.getElementById('startBtn').classList.add('hidden');
    document.getElementById('cashoutBtn').classList.remove('hidden');
    
    initGame();
}

function cashout() {
    if (!gameState.isPlaying) return;
    
    gameState.balance += gameState.winnings;
    updateBalance();
    
    gameState.isPlaying = false;
    document.getElementById('startBtn').classList.remove('hidden');
    document.getElementById('cashoutBtn').classList.add('hidden');
    
    alert(`You won ${gameState.winnings} coins! Total balance: ${gameState.balance}`);
    draw();
}

function resetGame() {
    gameState.isPlaying = false;
    gameState.items = [];
    gameState.multiplier = 1.0;
    gameState.itemsCount = 0;
    gameState.winnings = 0;
    
    document.getElementById('startBtn').classList.remove('hidden');
    document.getElementById('cashoutBtn').classList.add('hidden');
    
    updateUI();
    draw();
}

function updateUI() {
    document.getElementById('multiplier').textContent = gameState.multiplier.toFixed(1) + 'x';
    document.getElementById('itemsCount').textContent = gameState.itemsCount;
    document.getElementById('winningsDisplay').textContent = gameState.winnings + ' Coins';
    updateBalance();
}

function updateBalance() {
    document.getElementById('balanceDisplay').textContent = gameState.balance + ' Coins';
    localStorage.setItem('user_coins', gameState.balance);
    
    // Update header coin display
    const coinDisplay = document.getElementById('coinBalance');
    if (coinDisplay) {
        coinDisplay.innerText = new Intl.NumberFormat().format(gameState.balance) + ' Coins';
    }
}

canvas.addEventListener('click', (e) => {
    if (!gameState.isPlaying) return;
    
    const rect = canvas.getBoundingClientRect();
    const scaleX = canvas.width / rect.width;
    const scaleY = canvas.height / rect.height;
    const x = (e.clientX - rect.left) * scaleX;
    const y = (e.clientY - rect.top) * scaleY;
    
    for (let item of gameState.items) {
        if (!item.clicked && item.isClicked(x, y)) {
            item.clicked = true;
            
            if (item.isEgg) {
                gameState.itemsCount++;
                gameState.multiplier += 0.2;
                gameState.winnings = Math.floor(gameState.betAmount * gameState.multiplier);
                updateUI();
            } else {
                // Hit a bone - game over
                gameState.isPlaying = false;
                gameState.balance += gameState.betAmount; // Return bet
                updateBalance();
                
                document.getElementById('startBtn').classList.remove('hidden');
                document.getElementById('cashoutBtn').classList.add('hidden');
                
                alert('💀 You hit a bone! Game Over!');
                resetGame();
                return;
            }
            
            break;
        }
    }
    
    draw();
});

// Initialize on load
document.addEventListener('DOMContentLoaded', () => {
    gameState.balance = parseInt(localStorage.getItem('user_coins')) || 1000;
    updateBalance();
    draw();
});
