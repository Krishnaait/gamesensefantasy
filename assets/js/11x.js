document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('gameCanvas');
    const ctx = canvas.getContext('2d');
    let multiplier = 1.0;
    let gameActive = false;
    let betPlaced = false;
    let currentBet = 0;
    let planeX = 50;
    let planeY = canvas.height - 50;
    let trail = [];
    
    const betBtn = document.getElementById('betButton');
    const cashoutBtn = document.getElementById('cashoutButton');
    
    // Draw plane emoji or simple plane shape
    function drawPlane(x, y, crashed = false) {
        ctx.save();
        ctx.translate(x, y);
        
        if (crashed) {
            // Explosion effect
            ctx.fillStyle = '#ff0000';
            ctx.font = '40px Arial';
            ctx.fillText('💥', -20, 10);
        } else {
            // Plane emoji
            ctx.font = '30px Arial';
            ctx.fillText('✈️', -15, 10);
        }
        
        ctx.restore();
    }
    
    // Draw trail behind plane
    function drawTrail() {
        if (trail.length < 2) return;
        
        ctx.strokeStyle = 'rgba(255, 215, 0, 0.6)';
        ctx.lineWidth = 3;
        ctx.beginPath();
        ctx.moveTo(trail[0].x, trail[0].y);
        
        for (let i = 1; i < trail.length; i++) {
            ctx.lineTo(trail[i].x, trail[i].y);
        }
        
        ctx.stroke();
    }
    
    // Draw grid background
    function drawGrid() {
        ctx.strokeStyle = 'rgba(255, 255, 255, 0.1)';
        ctx.lineWidth = 1;
        
        // Vertical lines
        for (let x = 0; x < canvas.width; x += 50) {
            ctx.beginPath();
            ctx.moveTo(x, 0);
            ctx.lineTo(x, canvas.height);
            ctx.stroke();
        }
        
        // Horizontal lines
        for (let y = 0; y < canvas.height; y += 50) {
            ctx.beginPath();
            ctx.moveTo(0, y);
            ctx.lineTo(canvas.width, y);
            ctx.stroke();
        }
    }
    
    function drawGraph() {
        // Clear canvas
        ctx.fillStyle = '#1a1a2e';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // Draw grid
        drawGrid();
        
        // Draw trail
        drawTrail();
        
        // Update plane position
        planeX = 50 + (multiplier - 1) * 60;
        planeY = canvas.height - 50 - (multiplier - 1) * 35;
        
        // Keep plane within bounds
        if (planeX > canvas.width - 50) planeX = canvas.width - 50;
        if (planeY < 50) planeY = 50;
        
        // Add to trail
        if (gameActive) {
            trail.push({ x: planeX, y: planeY });
            if (trail.length > 100) trail.shift(); // Limit trail length
        }
        
        // Draw plane
        drawPlane(planeX, planeY, !gameActive && multiplier > 1);
        
        // Draw multiplier on canvas
        ctx.fillStyle = '#FFD700';
        ctx.font = 'bold 24px Arial';
        ctx.textAlign = 'center';
        ctx.fillText(multiplier.toFixed(2) + 'x', canvas.width / 2, 40);
    }
    
    betBtn.addEventListener('click', function() {
        const bet = parseInt(document.getElementById('betAmount').value) || 10;
        const credits = getCredits();
        
        if (bet < 1 || bet > credits) {
            alert('Invalid bet amount!');
            return;
        }
        
        setCredits(credits - bet);
        currentBet = bet;
        betPlaced = true;
        betBtn.style.display = 'none';
        cashoutBtn.style.display = 'block';
        startGame();
    });
    
    cashoutBtn.addEventListener('click', function() {
        if (!betPlaced || !gameActive) return;
        
        const win = Math.floor(currentBet * multiplier);
        setCredits(getCredits() + win);
        document.getElementById('lastWin').textContent = win;
        alert('✅ Cashed out at ' + multiplier.toFixed(2) + 'x! Won: ' + win + ' credits!');
        resetGame();
    });
    
    function startGame() {
        gameActive = true;
        multiplier = 1.0;
        planeX = 50;
        planeY = canvas.height - 50;
        trail = [];
        
        // Random crash point between 1.5x and 10x
        const crashPoint = 1.5 + (Math.random() * 8.5);
        
        const interval = setInterval(() => {
            if (!gameActive) {
                clearInterval(interval);
                return;
            }
            
            multiplier += 0.01;
            document.getElementById('multiplier').textContent = multiplier.toFixed(2) + 'x';
            drawGraph();
            
            if (multiplier >= crashPoint) {
                gameActive = false;
                clearInterval(interval);
                
                // Draw crashed plane
                drawGraph();
                
                // Show crash message
                setTimeout(() => {
                    alert('💥 CRASHED at ' + multiplier.toFixed(2) + 'x!');
                    if (betPlaced) {
                        document.getElementById('lastWin').textContent = 0;
                    }
                    resetGame();
                }, 500);
            }
        }, 50);
    }
    
    function resetGame() {
        betPlaced = false;
        gameActive = false;
        betBtn.style.display = 'block';
        cashoutBtn.style.display = 'none';
        trail = [];
        
        // Reset canvas
        ctx.fillStyle = '#1a1a2e';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        drawGrid();
        planeX = 50;
        planeY = canvas.height - 50;
        drawPlane(planeX, planeY);
        
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
    resetGame();
});
