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
    let pastResults = JSON.parse(localStorage.getItem('past11xResults') || '[]');
    
    const betBtn = document.getElementById('betButton');
    const cashoutBtn = document.getElementById('cashoutButton');
    
    // Draw plane emoji
    function drawPlane(x, y, crashed = false) {
        ctx.save();
        ctx.translate(x, y);
        
        if (crashed) {
            // Explosion effect
            ctx.font = '40px Arial';
            ctx.fillText('💥', -20, 10);
        } else {
            // Plane emoji
            ctx.font = '30px Arial';
            ctx.fillText('✈️', -15, 10);
        }
        
        ctx.restore();
    }
    
    // Draw continuous trail line from start to current position
    function drawTrail() {
        if (trail.length < 2) return;
        
        // Draw gradient line
        const gradient = ctx.createLinearGradient(trail[0].x, trail[0].y, trail[trail.length-1].x, trail[trail.length-1].y);
        gradient.addColorStop(0, 'rgba(255, 215, 0, 0.3)');
        gradient.addColorStop(1, 'rgba(255, 215, 0, 1)');
        
        ctx.strokeStyle = gradient;
        ctx.lineWidth = 4;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        ctx.beginPath();
        ctx.moveTo(trail[0].x, trail[0].y);
        
        for (let i = 1; i < trail.length; i++) {
            ctx.lineTo(trail[i].x, trail[i].y);
        }
        
        ctx.stroke();
    }
    
    // Draw grid background
    function drawGrid() {
        ctx.strokeStyle = 'rgba(255, 255, 255, 0.05)';
        ctx.lineWidth = 1;
        
        // Vertical lines
        for (let x = 0; x < canvas.width; x += 60) {
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
    
    // Draw past results
    function drawPastResults() {
        const startX = 10;
        const startY = 10;
        const boxWidth = 60;
        const boxHeight = 30;
        const gap = 5;
        
        ctx.font = 'bold 14px Arial';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        
        // Show last 8 results
        const recentResults = pastResults.slice(-8).reverse();
        
        recentResults.forEach((result, index) => {
            const x = startX + (index * (boxWidth + gap));
            const y = startY;
            
            // Background
            if (result >= 2.0) {
                ctx.fillStyle = 'rgba(0, 255, 0, 0.2)';
            } else {
                ctx.fillStyle = 'rgba(255, 0, 0, 0.2)';
            }
            ctx.fillRect(x, y, boxWidth, boxHeight);
            
            // Border
            ctx.strokeStyle = result >= 2.0 ? '#00ff00' : '#ff0000';
            ctx.lineWidth = 2;
            ctx.strokeRect(x, y, boxWidth, boxHeight);
            
            // Text
            ctx.fillStyle = result >= 2.0 ? '#00ff00' : '#ff0000';
            ctx.fillText(result.toFixed(2) + 'x', x + boxWidth/2, y + boxHeight/2);
        });
    }
    
    function drawGraph() {
        // Clear canvas
        ctx.fillStyle = '#1a1a2e';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // Draw grid
        drawGrid();
        
        // Draw past results
        drawPastResults();
        
        // Calculate plane position based on multiplier
        // Start from bottom-left corner (20, canvas.height - 20)
        const startX = 20;
        const startY = canvas.height - 20;
        
        // Calculate trajectory
        planeX = startX + (multiplier - 1) * 70;
        planeY = startY - (multiplier - 1) * 40;
        
        // Keep plane within bounds
        if (planeX > canvas.width - 30) planeX = canvas.width - 30;
        if (planeY < 80) planeY = 80;
        
        // Add to trail
        if (gameActive) {
            trail.push({ x: planeX, y: planeY });
        }
        
        // Draw trail
        drawTrail();
        
        // Draw plane
        drawPlane(planeX, planeY, !gameActive && multiplier > 1);
        
        // Draw multiplier on canvas (centered, larger)
        ctx.fillStyle = '#FFD700';
        ctx.font = 'bold 32px Arial';
        ctx.textAlign = 'center';
        ctx.fillText(multiplier.toFixed(2) + 'x', canvas.width / 2, 70);
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
        planeX = 20;
        planeY = canvas.height - 20;
        trail = [{ x: 20, y: canvas.height - 20 }]; // Start trail from bottom-left
        
        // Random crash point between 1.2x and 10x
        const crashPoint = 1.2 + (Math.random() * 8.8);
        
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
                
                // Save crash result
                pastResults.push(parseFloat(multiplier.toFixed(2)));
                if (pastResults.length > 20) pastResults.shift(); // Keep last 20
                localStorage.setItem('past11xResults', JSON.stringify(pastResults));
                
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
        drawPastResults();
        planeX = 20;
        planeY = canvas.height - 20;
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
