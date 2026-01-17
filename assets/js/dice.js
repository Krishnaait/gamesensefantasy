/**
 * Dice Game - Two Dice Prediction
 * Player predicts: Under 7, Exactly 7, or Over 7
 * Payouts: Under/Over = 2x, Exactly 7 = 5x
 */

document.addEventListener('DOMContentLoaded', function() {
    // Game state
    let gameState = {
        prediction: null,
        betAmount: 10,
        isRolling: false,
        totalRolls: parseInt(localStorage.getItem('dice_total_rolls') || '0'),
        totalWins: parseInt(localStorage.getItem('dice_total_wins') || '0')
    };
    
    // DOM elements
    const dice1El = document.getElementById('dice1');
    const dice2El = document.getElementById('dice2');
    const totalEl = document.getElementById('diceTotal');
    const rollBtn = document.getElementById('rollButton');
    const betInput = document.getElementById('betAmount');
    const predictionBtns = document.querySelectorAll('.prediction-btn');
    const creditsEl = document.getElementById('credits');
    const potentialWinEl = document.getElementById('potentialWin');
    const totalRollsEl = document.getElementById('totalRolls');
    const totalWinsEl = document.getElementById('totalWins');
    
    // Initialize
    updateUI();
    
    // Prediction buttons
    predictionBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            predictionBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            // Set prediction
            gameState.prediction = this.dataset.prediction;
            // Update potential win
            updatePotentialWin();
        });
    });
    
    // Bet amount change
    betInput.addEventListener('input', function() {
        gameState.betAmount = parseInt(this.value) || 10;
        updatePotentialWin();
    });
    
    // Quick bet buttons
    document.querySelectorAll('.quick-bet').forEach(btn => {
        btn.addEventListener('click', function() {
            const amount = this.dataset.amount;
            if (amount === 'max') {
                betInput.value = getCredits();
            } else {
                betInput.value = amount;
            }
            gameState.betAmount = parseInt(betInput.value);
            updatePotentialWin();
        });
    });
    
    // Roll button
    rollBtn.addEventListener('click', function() {
        if (gameState.isRolling) return;
        
        if (!gameState.prediction) {
            alert('Please select a prediction first!');
            return;
        }
        
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
        
        // Start rolling
        gameState.isRolling = true;
        gameState.betAmount = bet;
        rollBtn.disabled = true;
        
        // Deduct bet
        setCredits(credits - bet);
        
        // Animate dice rolling
        animateDiceRoll();
    });
    
    // Animate dice roll
    function animateDiceRoll() {
        let rolls = 0;
        const maxRolls = 15;
        
        const interval = setInterval(() => {
            // Show random dice values during animation
            const rand1 = Math.floor(Math.random() * 6) + 1;
            const rand2 = Math.floor(Math.random() * 6) + 1;
            dice1El.querySelector('.dice-face').textContent = rand1;
            dice2El.querySelector('.dice-face').textContent = rand2;
            totalEl.textContent = '?';
            
            rolls++;
            
            if (rolls >= maxRolls) {
                clearInterval(interval);
                // Show final result
                showFinalResult();
            }
        }, 100);
    }
    
    // Show final dice result
    function showFinalResult() {
        // Generate final dice values
        const dice1 = Math.floor(Math.random() * 6) + 1;
        const dice2 = Math.floor(Math.random() * 6) + 1;
        const total = dice1 + dice2;
        
        // Display result
        dice1El.querySelector('.dice-face').textContent = dice1;
        dice2El.querySelector('.dice-face').textContent = dice2;
        totalEl.textContent = total;
        
        // Check win/loss
        setTimeout(() => {
            checkResult(total);
        }, 500);
    }
    
    // Check if player won
    function checkResult(total) {
        let won = false;
        let multiplier = 0;
        
        if (gameState.prediction === 'under' && total < 7) {
            won = true;
            multiplier = 2;
        } else if (gameState.prediction === 'exactly' && total === 7) {
            won = true;
            multiplier = 5;
        } else if (gameState.prediction === 'over' && total > 7) {
            won = true;
            multiplier = 2;
        }
        
        // Update stats
        gameState.totalRolls++;
        localStorage.setItem('dice_total_rolls', gameState.totalRolls);
        
        if (won) {
            gameState.totalWins++;
            localStorage.setItem('dice_total_wins', gameState.totalWins);
            const winAmount = gameState.betAmount * multiplier;
            setCredits(getCredits() + winAmount);
            alert(`🎉 YOU WON ${winAmount} CREDITS! (${multiplier}x)\n\nDice: ${dice1El.querySelector('.dice-face').textContent} + ${dice2El.querySelector('.dice-face').textContent} = ${total}\nPrediction: ${gameState.prediction.toUpperCase()}`);
        } else {
            alert(`❌ YOU LOST!\n\nDice: ${dice1El.querySelector('.dice-face').textContent} + ${dice2El.querySelector('.dice-face').textContent} = ${total}\nPrediction: ${gameState.prediction.toUpperCase()}\n\nBetter luck next time!`);
        }
        
        // Reset game state
        gameState.isRolling = false;
        gameState.prediction = null;
        rollBtn.disabled = false;
        
        // Remove active class from prediction buttons
        predictionBtns.forEach(btn => btn.classList.remove('active'));
        
        // Update UI
        updateUI();
    }
    
    // Update potential win display
    function updatePotentialWin() {
        if (!gameState.prediction) {
            potentialWinEl.textContent = '0';
            return;
        }
        
        let multiplier = 0;
        if (gameState.prediction === 'under' || gameState.prediction === 'over') {
            multiplier = 2;
        } else if (gameState.prediction === 'exactly') {
            multiplier = 5;
        }
        
        const potentialWin = gameState.betAmount * multiplier;
        potentialWinEl.textContent = potentialWin;
    }
    
    // Update UI
    function updateUI() {
        creditsEl.textContent = getCredits();
        totalRollsEl.textContent = gameState.totalRolls;
        totalWinsEl.textContent = gameState.totalWins;
        updatePotentialWin();
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
