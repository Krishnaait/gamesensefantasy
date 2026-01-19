/**
 * Chicken Game - Risk/Reward Egg Picking Game
 * Click eggs to reveal gems or bones
 * Cash out anytime to collect winnings
 */

document.addEventListener('DOMContentLoaded', function() {
    // Game state
    let gameState = {
        isPlaying: false,
        bet: 0,
        multiplier: 1.00,
        eggsRevealed: 0,
        totalEggs: 20,
        boneCount: 5,
        bonePositions: [],
        revealedEggs: []
    };
    
    // DOM elements
    const eggGrid = document.getElementById('eggGrid');
    const startBtn = document.getElementById('startButton');
    const cashoutBtn = document.getElementById('cashoutButton');
    const betInput = document.getElementById('betAmount');
    const boneCountSelect = document.getElementById('boneCount');
    const creditsEl = document.getElementById('credits');
    const multiplierEl = document.getElementById('currentMultiplier');
    const eggsRevealedEl = document.getElementById('eggsRevealed');
    const potentialWinEl = document.getElementById('potentialWin');
    
    // Initialize
    createEggGrid();
    updateUI();
    
    // Create egg grid
    function createEggGrid() {
        eggGrid.innerHTML = '';
        for (let i = 0; i < gameState.totalEggs; i++) {
            const egg = document.createElement('div');
            egg.className = 'egg';
            egg.dataset.index = i;
            egg.textContent = '🥚';
            egg.addEventListener('click', () => handleEggClick(i));
            eggGrid.appendChild(egg);
        }
    }
    
    // Start game
    startBtn.addEventListener('click', function() {
        const bet = parseInt(betInput.value) || 10;
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
        
        // Initialize game
        gameState = {
            isPlaying: true,
            bet: bet,
            multiplier: 1.00,
            eggsRevealed: 0,
            totalEggs: 20,
            boneCount: parseInt(boneCountSelect.value),
            bonePositions: [],
            revealedEggs: []
        };
        
        // Randomly place bones
        while (gameState.bonePositions.length < gameState.boneCount) {
            const pos = Math.floor(Math.random() * gameState.totalEggs);
            if (!gameState.bonePositions.includes(pos)) {
                gameState.bonePositions.push(pos);
            }
        }
        
        // Reset grid
        createEggGrid();
        
        // Update UI
        startBtn.disabled = true;
        cashoutBtn.disabled = false;
        betInput.disabled = true;
        boneCountSelect.disabled = true;
        updateUI();
    });
    
    // Handle egg click
    function handleEggClick(index) {
        if (!gameState.isPlaying) return;
        if (gameState.revealedEggs.includes(index)) return;
        
        // Reveal egg
        gameState.revealedEggs.push(index);
        const eggEl = eggGrid.children[index];
        eggEl.classList.add('revealed');
        
        if (gameState.bonePositions.includes(index)) {
            // Hit bone - game over
            eggEl.textContent = '🦴';
            eggEl.classList.add('bone');
            gameOver(false);
        } else {
            // Hit gem - increase multiplier
            eggEl.textContent = '💎';
            eggEl.classList.add('gem');
            gameState.eggsRevealed++;
            
            // Calculate multiplier (increases with each gem)
            gameState.multiplier = 1.00 + (gameState.eggsRevealed * 0.30);
            
            updateUI();
            
            // Check if all safe eggs revealed
            if (gameState.eggsRevealed >= (gameState.totalEggs - gameState.boneCount)) {
                gameOver(true);
            }
        }
    }
    
    // Cash out
    cashoutBtn.addEventListener('click', function() {
        if (!gameState.isPlaying) return;
        gameOver(true);
    });
    
    // Game over
    function gameOver(won) {
        gameState.isPlaying = false;
        
        // Reveal all bones
        gameState.bonePositions.forEach(pos => {
            if (!gameState.revealedEggs.includes(pos)) {
                const eggEl = eggGrid.children[pos];
                eggEl.textContent = '🦴';
                eggEl.classList.add('revealed', 'bone');
            }
        });
        
        if (won) {
            const winAmount = Math.floor(gameState.bet * gameState.multiplier);
            setCredits(getCredits() + winAmount);
            alert(`🎉 YOU CASHED OUT!\n\nMultiplier: ${gameState.multiplier.toFixed(2)}x\nYou won ${winAmount} credits!`);
        } else {
            alert(`💀 GAME OVER!\n\nYou hit a bone and lost ${gameState.bet} credits.\nBetter luck next time!`);
        }
        
        // Reset UI
        startBtn.disabled = false;
        cashoutBtn.disabled = true;
        betInput.disabled = false;
        boneCountSelect.disabled = false;
        
        gameState.multiplier = 1.00;
        gameState.eggsRevealed = 0;
        updateUI();
    }
    
    // Quick bet buttons
    document.querySelectorAll('.quick-bet').forEach(btn => {
        btn.addEventListener('click', function() {
            const amount = this.dataset.amount;
            if (amount === 'max') {
                betInput.value = getCredits();
            } else {
                betInput.value = amount;
            }
        });
    });
    
    // Update UI
    function updateUI() {
        creditsEl.textContent = getCredits();
        multiplierEl.textContent = gameState.multiplier.toFixed(2) + 'x';
        eggsRevealedEl.textContent = `${gameState.eggsRevealed}/${gameState.totalEggs - gameState.boneCount}`;
        
        const potentialWin = Math.floor(gameState.bet * gameState.multiplier);
        potentialWinEl.textContent = potentialWin;
    }
    
    // Credits management
    function getCredits() {
        return parseInt(localStorage.getItem('credits') || '1000');
    }
    
    function setCredits(amount) {
        localStorage.setItem('credits', amount);
        updateUI();
    }
});
