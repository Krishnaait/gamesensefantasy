/**
 * Mines Game - Minesweeper-style betting game
 */

document.addEventListener('DOMContentLoaded', function() {
    let gameState = {
        isPlaying: false,
        bet: 0,
        multiplier: 1.00,
        tilesRevealed: 0,
        totalTiles: 25,
        mineCount: 5,
        minePositions: [],
        revealedTiles: []
    };
    
    const minesGrid = document.getElementById('minesGrid');
    const startBtn = document.getElementById('startButton');
    const cashoutBtn = document.getElementById('cashoutButton');
    const betInput = document.getElementById('betAmount');
    const mineCountSelect = document.getElementById('mineCount');
    const creditsEl = document.getElementById('credits');
    const multiplierEl = document.getElementById('currentMultiplier');
    const tilesRevealedEl = document.getElementById('tilesRevealed');
    const potentialWinEl = document.getElementById('potentialWin');
    
    createMinesGrid();
    updateUI();
    
    function createMinesGrid() {
        minesGrid.innerHTML = '';
        for (let i = 0; i < gameState.totalTiles; i++) {
            const tile = document.createElement('div');
            tile.className = 'tile';
            tile.dataset.index = i;
            tile.textContent = '?';
            tile.addEventListener('click', () => handleTileClick(i));
            minesGrid.appendChild(tile);
        }
    }
    
    startBtn.addEventListener('click', function() {
        const bet = parseInt(betInput.value) || 10;
        const credits = getCredits();
        
        if (bet < 1 || bet > credits) {
            alert('Invalid bet amount!');
            return;
        }
        
        setCredits(credits - bet);
        
        gameState = {
            isPlaying: true,
            bet: bet,
            multiplier: 1.00,
            tilesRevealed: 0,
            totalTiles: 25,
            mineCount: parseInt(mineCountSelect.value),
            minePositions: [],
            revealedTiles: []
        };
        
        while (gameState.minePositions.length < gameState.mineCount) {
            const pos = Math.floor(Math.random() * gameState.totalTiles);
            if (!gameState.minePositions.includes(pos)) {
                gameState.minePositions.push(pos);
            }
        }
        
        createMinesGrid();
        startBtn.disabled = true;
        cashoutBtn.disabled = false;
        betInput.disabled = true;
        mineCountSelect.disabled = true;
        updateUI();
    });
    
    function handleTileClick(index) {
        if (!gameState.isPlaying || gameState.revealedTiles.includes(index)) return;
        
        gameState.revealedTiles.push(index);
        const tileEl = minesGrid.children[index];
        tileEl.classList.add('revealed');
        
        if (gameState.minePositions.includes(index)) {
            tileEl.textContent = '💣';
            tileEl.classList.add('mine');
            gameOver(false);
        } else {
            tileEl.textContent = '💎';
            tileEl.classList.add('gem');
            gameState.tilesRevealed++;
            
            const multiplierIncrease = 0.20 + (gameState.mineCount * 0.05);
            gameState.multiplier = 1.00 + (gameState.tilesRevealed * multiplierIncrease);
            
            updateUI();
            
            if (gameState.tilesRevealed >= (gameState.totalTiles - gameState.mineCount)) {
                gameOver(true);
            }
        }
    }
    
    cashoutBtn.addEventListener('click', function() {
        if (gameState.isPlaying) gameOver(true);
    });
    
    function gameOver(won) {
        gameState.isPlaying = false;
        
        gameState.minePositions.forEach(pos => {
            if (!gameState.revealedTiles.includes(pos)) {
                const tileEl = minesGrid.children[pos];
                tileEl.textContent = '💣';
                tileEl.classList.add('revealed', 'mine');
            }
        });
        
        if (won) {
            const winAmount = Math.floor(gameState.bet * gameState.multiplier);
            setCredits(getCredits() + winAmount);
            alert('You won ' + winAmount + ' credits!');
        } else {
            alert('You hit a mine! Lost ' + gameState.bet + ' credits.');
        }
        
        startBtn.disabled = false;
        cashoutBtn.disabled = true;
        betInput.disabled = false;
        mineCountSelect.disabled = false;
        gameState.multiplier = 1.00;
        gameState.tilesRevealed = 0;
        updateUI();
    }
    
    document.querySelectorAll('.quick-bet').forEach(btn => {
        btn.addEventListener('click', function() {
            const amount = this.dataset.amount;
            betInput.value = amount === 'max' ? getCredits() : amount;
        });
    });
    
    function updateUI() {
        creditsEl.textContent = getCredits();
        multiplierEl.textContent = gameState.multiplier.toFixed(2) + 'x';
        tilesRevealedEl.textContent = gameState.tilesRevealed + '/' + (gameState.totalTiles - gameState.mineCount);
        potentialWinEl.textContent = Math.floor(gameState.bet * gameState.multiplier);
    }
    
    function getCredits() {
        return parseInt(localStorage.getItem('credits') || '1000');
    }
    
    function setCredits(amount) {
        localStorage.setItem('credits', amount);
        updateUI();
    }
});
