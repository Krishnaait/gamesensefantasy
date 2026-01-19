/**
 * Plinko Game - Physics-based ball drop game
 * Ball bounces through pegs and lands in multiplier slots
 */

document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('plinkoCanvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    
    // Game state
    let gameState = {
        isDropping: false,
        ball: null,
        betAmount: 10,
        riskLevel: 'medium',
        totalDrops: parseInt(localStorage.getItem('plinko_total_drops') || '0'),
        totalWon: parseInt(localStorage.getItem('plinko_total_won') || '0')
    };
    
    // Plinko board configuration
    const config = {
        pegRows: 12,
        pegRadius: 4,
        ballRadius: 8,
        slotCount: 10,
        slotHeight: 50,
        gravity: 0.5,
        bounce: 0.7
    };
    
    // Multipliers for different risk levels
    const multipliers = {
        low: [1.5, 1.2, 1.0, 0.8, 0.5, 0.5, 0.8, 1.0, 1.2, 1.5],
        medium: [3.0, 2.0, 1.5, 1.0, 0.5, 0.5, 1.0, 1.5, 2.0, 3.0],
        high: [5.0, 3.0, 2.0, 1.0, 0.5, 0.5, 1.0, 2.0, 3.0, 5.0]
    };
    
    // Peg positions
    let pegs = [];
    
    // Ball class
    class Ball {
        constructor(x, y) {
            this.x = x;
            this.y = y;
            this.vx = 0;
            this.vy = 0;
            this.radius = config.ballRadius;
        }
        
        update() {
            // Apply gravity
            this.vy += config.gravity;
            
            // Update position
            this.x += this.vx;
            this.y += this.vy;
            
            // Check collision with pegs
            pegs.forEach(peg => {
                const dx = this.x - peg.x;
                const dy = this.y - peg.y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                
                if (distance < this.radius + config.pegRadius) {
                    // Collision detected
                    const angle = Math.atan2(dy, dx);
                    const targetX = peg.x + Math.cos(angle) * (this.radius + config.pegRadius);
                    const targetY = peg.y + Math.sin(angle) * (this.radius + config.pegRadius);
                    
                    // Bounce
                    this.x = targetX;
                    this.y = targetY;
                    
                    // Add random bounce
                    this.vx = Math.cos(angle) * config.bounce * 3 + (Math.random() - 0.5) * 2;
                    this.vy = Math.sin(angle) * config.bounce * 3;
                }
            });
            
            // Check walls
            if (this.x - this.radius < 0) {
                this.x = this.radius;
                this.vx *= -config.bounce;
            }
            if (this.x + this.radius > canvas.width) {
                this.x = canvas.width - this.radius;
                this.vx *= -config.bounce;
            }
            
            // Check if reached bottom
            if (this.y + this.radius >= canvas.height - config.slotHeight) {
                this.y = canvas.height - config.slotHeight - this.radius;
                this.vy = 0;
                this.vx *= 0.9; // Friction
                
                // Check if stopped
                if (Math.abs(this.vx) < 0.1) {
                    return true; // Ball has stopped
                }
            }
            
            return false;
        }
        
        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
            ctx.fillStyle = '#FFD700';
            ctx.fill();
            ctx.strokeStyle = '#FFA500';
            ctx.lineWidth = 2;
            ctx.stroke();
        }
    }
    
    // Initialize pegs
    function initPegs() {
        pegs = [];
        const startY = 80;
        const rowSpacing = (canvas.height - config.slotHeight - startY) / config.pegRows;
        
        for (let row = 0; row < config.pegRows; row++) {
            const pegsInRow = row + 3;
            const spacing = canvas.width / (pegsInRow + 1);
            const y = startY + row * rowSpacing;
            
            for (let col = 0; col < pegsInRow; col++) {
                const x = spacing * (col + 1);
                pegs.push({ x, y });
            }
        }
    }
    
    // Draw board
    function drawBoard() {
        // Clear canvas
        ctx.fillStyle = 'rgba(10, 14, 39, 0.8)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // Draw pegs
        pegs.forEach(peg => {
            ctx.beginPath();
            ctx.arc(peg.x, peg.y, config.pegRadius, 0, Math.PI * 2);
            ctx.fillStyle = '#FFD700';
            ctx.fill();
        });
        
        // Draw slots
        const slotWidth = canvas.width / config.slotCount;
        const currentMultipliers = multipliers[gameState.riskLevel];
        
        for (let i = 0; i < config.slotCount; i++) {
            const x = i * slotWidth;
            const y = canvas.height - config.slotHeight;
            const multiplier = currentMultipliers[i];
            
            // Color based on multiplier
            let color;
            if (multiplier >= 3) color = '#10b981'; // Green for high
            else if (multiplier >= 1) color = '#FFD700'; // Gold for medium
            else color = '#ef4444'; // Red for low
            
            ctx.fillStyle = color + '40';
            ctx.fillRect(x, y, slotWidth, config.slotHeight);
            ctx.strokeStyle = color;
            ctx.lineWidth = 2;
            ctx.strokeRect(x, y, slotWidth, config.slotHeight);
            
            // Draw multiplier text
            ctx.fillStyle = color;
            ctx.font = 'bold 14px Arial';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText(multiplier + 'x', x + slotWidth / 2, y + config.slotHeight / 2);
        }
        
        // Draw ball
        if (gameState.ball) {
            gameState.ball.draw();
        }
    }
    
    // Game loop
    function gameLoop() {
        if (!gameState.isDropping) return;
        
        const stopped = gameState.ball.update();
        drawBoard();
        
        if (stopped) {
            // Calculate which slot ball landed in
            const slotIndex = Math.floor(gameState.ball.x / (canvas.width / config.slotCount));
            const clampedIndex = Math.max(0, Math.min(config.slotCount - 1, slotIndex));
            const multiplier = multipliers[gameState.riskLevel][clampedIndex];
            
            // Calculate winnings
            const winAmount = Math.floor(gameState.betAmount * multiplier);
            setCredits(getCredits() + winAmount);
            
            // Update stats
            gameState.totalDrops++;
            gameState.totalWon += winAmount;
            localStorage.setItem('plinko_total_drops', gameState.totalDrops);
            localStorage.setItem('plinko_total_won', gameState.totalWon);
            
            // Show result
            document.getElementById('lastWin').textContent = winAmount;
            
            setTimeout(() => {
                alert(`🎯 Ball landed in ${multiplier}x slot!\n\nYou won ${winAmount} credits!`);
                gameState.isDropping = false;
                gameState.ball = null;
                drawBoard();
                updateUI();
                document.getElementById('dropButton').disabled = false;
            }, 500);
            
            return;
        }
        
        requestAnimationFrame(gameLoop);
    }
    
    // Drop ball
    document.getElementById('dropButton').addEventListener('click', function() {
        if (gameState.isDropping) return;
        
        const bet = parseInt(document.getElementById('betAmount').value) || 10;
        const credits = getCredits();
        
        if (bet < 1) {
            alert('Minimum bet is 1 credit!');
            return;
        }
        
        if (bet > credits) {
            alert('Insufficient credits!');
            return;
        }
        
        // Deduct bet
        setCredits(credits - bet);
        gameState.betAmount = bet;
        gameState.riskLevel = document.getElementById('riskLevel').value;
        
        // Create ball at top center
        gameState.ball = new Ball(canvas.width / 2 + (Math.random() - 0.5) * 20, 20);
        gameState.isDropping = true;
        this.disabled = true;
        
        // Start game loop
        gameLoop();
    });
    
    // Quick bet buttons
    document.querySelectorAll('.quick-bet').forEach(btn => {
        btn.addEventListener('click', function() {
            const amount = this.dataset.amount;
            const betInput = document.getElementById('betAmount');
            if (amount === 'max') {
                betInput.value = getCredits();
            } else {
                betInput.value = amount;
            }
        });
    });
    
    // Update UI
    function updateUI() {
        document.getElementById('credits').textContent = getCredits();
        document.getElementById('totalDrops').textContent = gameState.totalDrops;
        document.getElementById('totalWon').textContent = gameState.totalWon;
    }
    
    // Credits management
    function getCredits() {
        return parseInt(localStorage.getItem('credits') || '1000');
    }
    
    function setCredits(amount) {
        localStorage.setItem('credits', amount);
        updateUI();
    }
    
    // Initialize
    initPegs();
    drawBoard();
    updateUI();
});
