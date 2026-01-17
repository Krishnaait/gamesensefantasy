document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('laserCanvas');
    const ctx = canvas.getContext('2d');
    
    let gameActive = false;
    let score = 0;
    let timeLeft = 30;
    let currentBet = 0;
    let jetX = canvas.width / 2;
    let jetY = canvas.height - 80;
    let asteroids = [];
    let lasers = [];
    let particles = []; // For flame effects
    
    // Game objects
    class Asteroid {
        constructor() {
            this.x = Math.random() * (canvas.width - 40) + 20;
            this.y = -30;
            this.size = 20 + Math.random() * 20;
            this.speed = 1 + Math.random() * 2;
            this.rotation = 0;
            this.rotationSpeed = (Math.random() - 0.5) * 0.1;
        }
        
        update() {
            this.y += this.speed;
            this.rotation += this.rotationSpeed;
        }
        
        draw() {
            ctx.save();
            ctx.translate(this.x, this.y);
            ctx.rotate(this.rotation);
            
            // Draw asteroid (rock shape)
            ctx.fillStyle = '#8B4513';
            ctx.strokeStyle = '#654321';
            ctx.lineWidth = 2;
            ctx.beginPath();
            for (let i = 0; i < 8; i++) {
                const angle = (i / 8) * Math.PI * 2;
                const radius = this.size * (0.8 + Math.random() * 0.4);
                const x = Math.cos(angle) * radius;
                const y = Math.sin(angle) * radius;
                if (i === 0) ctx.moveTo(x, y);
                else ctx.lineTo(x, y);
            }
            ctx.closePath();
            ctx.fill();
            ctx.stroke();
            
            ctx.restore();
        }
        
        isOffScreen() {
            return this.y > canvas.height + 50;
        }
    }
    
    class Laser {
        constructor(x, y) {
            this.x = x;
            this.y = y;
            this.speed = 8;
            this.width = 4;
            this.height = 20;
        }
        
        update() {
            this.y -= this.speed;
        }
        
        draw() {
            // Laser beam with glow
            ctx.shadowBlur = 10;
            ctx.shadowColor = '#00ff00';
            ctx.fillStyle = '#00ff00';
            ctx.fillRect(this.x - this.width/2, this.y, this.width, this.height);
            ctx.shadowBlur = 0;
        }
        
        isOffScreen() {
            return this.y < -this.height;
        }
        
        hits(asteroid) {
            const dx = this.x - asteroid.x;
            const dy = this.y - asteroid.y;
            const distance = Math.sqrt(dx * dx + dy * dy);
            return distance < asteroid.size;
        }
    }
    
    class Particle {
        constructor(x, y) {
            this.x = x;
            this.y = y;
            this.vx = (Math.random() - 0.5) * 2;
            this.vy = Math.random() * 2 + 1;
            this.life = 1.0;
            this.decay = 0.02;
            this.size = 3 + Math.random() * 3;
        }
        
        update() {
            this.x += this.vx;
            this.y += this.vy;
            this.life -= this.decay;
        }
        
        draw() {
            ctx.globalAlpha = this.life;
            const colors = ['#ff4500', '#ff6347', '#ffa500', '#ffff00'];
            ctx.fillStyle = colors[Math.floor(Math.random() * colors.length)];
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
            ctx.globalAlpha = 1.0;
        }
        
        isDead() {
            return this.life <= 0;
        }
    }
    
    // Draw fighter jet with flames
    function drawJet() {
        ctx.save();
        ctx.translate(jetX, jetY);
        
        // Jet body
        ctx.fillStyle = '#4169E1';
        ctx.strokeStyle = '#000080';
        ctx.lineWidth = 2;
        
        // Main body
        ctx.beginPath();
        ctx.moveTo(0, -20);
        ctx.lineTo(-15, 10);
        ctx.lineTo(-10, 20);
        ctx.lineTo(10, 20);
        ctx.lineTo(15, 10);
        ctx.closePath();
        ctx.fill();
        ctx.stroke();
        
        // Wings
        ctx.fillStyle = '#1E90FF';
        ctx.beginPath();
        ctx.moveTo(-15, 5);
        ctx.lineTo(-30, 10);
        ctx.lineTo(-20, 15);
        ctx.closePath();
        ctx.fill();
        ctx.stroke();
        
        ctx.beginPath();
        ctx.moveTo(15, 5);
        ctx.lineTo(30, 10);
        ctx.lineTo(20, 15);
        ctx.closePath();
        ctx.fill();
        ctx.stroke();
        
        // Cockpit
        ctx.fillStyle = '#00BFFF';
        ctx.beginPath();
        ctx.arc(0, -5, 5, 0, Math.PI * 2);
        ctx.fill();
        ctx.stroke();
        
        ctx.restore();
        
        // Flame particles from engines
        if (gameActive) {
            particles.push(new Particle(jetX - 8, jetY + 20));
            particles.push(new Particle(jetX + 8, jetY + 20));
        }
    }
    
    // Draw background stars
    function drawStars() {
        ctx.fillStyle = 'rgba(255, 255, 255, 0.5)';
        for (let i = 0; i < 50; i++) {
            const x = (i * 37) % canvas.width;
            const y = (i * 53) % canvas.height;
            ctx.fillRect(x, y, 2, 2);
        }
    }
    
    // Main game loop
    function gameLoop() {
        if (!gameActive) return;
        
        // Clear canvas
        ctx.fillStyle = '#000428';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // Draw stars
        drawStars();
        
        // Update and draw particles (flames)
        particles = particles.filter(p => !p.isDead());
        particles.forEach(p => {
            p.update();
            p.draw();
        });
        
        // Update and draw asteroids
        asteroids.forEach((asteroid, index) => {
            asteroid.update();
            asteroid.draw();
            
            // Remove off-screen asteroids
            if (asteroid.isOffScreen()) {
                asteroids.splice(index, 1);
            }
            
            // Check collision with jet
            const dx = jetX - asteroid.x;
            const dy = jetY - asteroid.y;
            if (Math.sqrt(dx * dx + dy * dy) < asteroid.size + 15) {
                // Game over - hit by asteroid
                gameActive = false;
                endGame();
            }
        });
        
        // Update and draw lasers
        lasers.forEach((laser, laserIndex) => {
            laser.update();
            laser.draw();
            
            // Remove off-screen lasers
            if (laser.isOffScreen()) {
                lasers.splice(laserIndex, 1);
                return;
            }
            
            // Check collision with asteroids
            asteroids.forEach((asteroid, asteroidIndex) => {
                if (laser.hits(asteroid)) {
                    // Hit! Remove both
                    asteroids.splice(asteroidIndex, 1);
                    lasers.splice(laserIndex, 1);
                    score += 10;
                    
                    // Create explosion particles
                    for (let i = 0; i < 10; i++) {
                        particles.push(new Particle(asteroid.x, asteroid.y));
                    }
                }
            });
        });
        
        // Draw jet
        drawJet();
        
        // Draw score
        ctx.fillStyle = '#FFD700';
        ctx.font = 'bold 20px Arial';
        ctx.textAlign = 'left';
        ctx.fillText('Score: ' + score, 10, 30);
        ctx.fillText('Time: ' + timeLeft + 's', 10, 60);
        
        requestAnimationFrame(gameLoop);
    }
    
    // Mouse/touch controls
    canvas.addEventListener('mousemove', (e) => {
        if (!gameActive) return;
        const rect = canvas.getBoundingClientRect();
        jetX = e.clientX - rect.left;
        jetX = Math.max(30, Math.min(canvas.width - 30, jetX));
    });
    
    canvas.addEventListener('touchmove', (e) => {
        if (!gameActive) return;
        e.preventDefault();
        const rect = canvas.getBoundingClientRect();
        jetX = e.touches[0].clientX - rect.left;
        jetX = Math.max(30, Math.min(canvas.width - 30, jetX));
    });
    
    // Shoot laser on click/tap
    canvas.addEventListener('click', () => {
        if (!gameActive) return;
        lasers.push(new Laser(jetX, jetY - 20));
    });
    
    canvas.addEventListener('touchstart', (e) => {
        if (!gameActive) return;
        e.preventDefault();
        lasers.push(new Laser(jetX, jetY - 20));
    });
    
    // Spawn asteroids
    function spawnAsteroid() {
        if (!gameActive) return;
        asteroids.push(new Asteroid());
        setTimeout(spawnAsteroid, 800 + Math.random() * 1200);
    }
    
    // Start game
    document.getElementById('startButton').addEventListener('click', function() {
        const bet = parseInt(document.getElementById('betAmount').value) || 10;
        const credits = getCredits();
        
        if (bet < 1 || bet > credits) {
            alert('Invalid bet amount!');
            return;
        }
        
        setCredits(credits - bet);
        currentBet = bet;
        startGame();
    });
    
    function startGame() {
        gameActive = true;
        score = 0;
        timeLeft = 30;
        asteroids = [];
        lasers = [];
        particles = [];
        jetX = canvas.width / 2;
        jetY = canvas.height - 80;
        
        // Start spawning asteroids
        spawnAsteroid();
        
        // Timer
        const timer = setInterval(() => {
            if (!gameActive) {
                clearInterval(timer);
                return;
            }
            
            timeLeft--;
            document.getElementById('score').textContent = 'Score: ' + score + ' | Time: ' + timeLeft + 's';
            
            if (timeLeft <= 0) {
                gameActive = false;
                clearInterval(timer);
                endGame();
            }
        }, 1000);
        
        gameLoop();
    }
    
    function endGame() {
        const multiplier = 1 + (score / 100);
        const win = Math.floor(currentBet * multiplier);
        setCredits(getCredits() + win);
        document.getElementById('lastWin').textContent = win;
        
        // Draw game over screen
        ctx.fillStyle = 'rgba(0, 0, 0, 0.7)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        ctx.fillStyle = '#FFD700';
        ctx.font = 'bold 36px Arial';
        ctx.textAlign = 'center';
        ctx.fillText('GAME OVER!', canvas.width / 2, canvas.height / 2 - 40);
        
        ctx.font = 'bold 24px Arial';
        ctx.fillText('Final Score: ' + score, canvas.width / 2, canvas.height / 2);
        ctx.fillText('Multiplier: ' + multiplier.toFixed(2) + 'x', canvas.width / 2, canvas.height / 2 + 40);
        ctx.fillText('Won: ' + win + ' credits', canvas.width / 2, canvas.height / 2 + 80);
        
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
    
    // Draw initial screen
    ctx.fillStyle = '#000428';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    drawStars();
    drawJet();
    
    ctx.fillStyle = '#FFD700';
    ctx.font = 'bold 24px Arial';
    ctx.textAlign = 'center';
    ctx.fillText('Click START GAME to begin!', canvas.width / 2, canvas.height / 2);
    ctx.font = '18px Arial';
    ctx.fillText('Move mouse to control jet', canvas.width / 2, canvas.height / 2 + 40);
    ctx.fillText('Click to shoot lasers', canvas.width / 2, canvas.height / 2 + 70);
});
