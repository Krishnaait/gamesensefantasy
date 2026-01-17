/**
 * Mines Game Implementation
 * Click safe tiles and avoid mines
 */

let minesGameState = {
    isPlaying: false,
    tiles: [],
    minePositions: [],
    safeCount: 0,
    multiplier: 1.0,
    betAmount: 10,
    winnings: 0,
    balance: parseInt(localStorage.getItem('user_coins')) || 1000,
    mineCount: 3,
    gridSize: 25
};

function createMinesGrid() {
    const grid = document.getElementById('minesGrid');
    grid.innerHTML = '';
    grid.style.gridTemplateColumns = `repeat(5, 1fr)`;
    
    minesGameState.tiles = [];
    
    for (let i = 0; i < minesGameState.gridSize; i++) {
        const tile = document.createElement('div');
        tile.className = 'mine-tile';
        tile.textContent = '?';
        tile.dataset.index = i;
        tile.onclick = () => clickTile(i);
        
        grid.appendChild(tile);
        minesGameState.tiles.push({
            index: i,
            revealed: false,
            isMine: false,
            element: tile
        });
    }
    
    // Place mines randomly
    minesGameState.minePositions = [];
    while (minesGameState.minePositions.length < minesGameState.mineCount) {
        const randomIndex = Math.floor(Math.random() * minesGameState.gridSize);
        if (!minesGameState.minePositions.includes(randomIndex)) {
            minesGameState.minePositions.push(randomIndex);
            minesGameState.tiles[randomIndex].isMine = true;
        }
    }
}

function startMinesGame() {
    const betAmount = parseInt(document.getElementById('mineBetAmount').value);
    const mineCount = parseInt(document.getElementById('mineCount').value);
    
    if (betAmount < 1 || betAmount > 500) {
        alert('Bet amount must be between 1 and 500 coins');
        return;
    }
    
    if (minesGameState.balance < betAmount) {
        alert('Insufficient balance');
        return;
    }
    
    minesGameState.betAmount = betAmount;
    minesGameState.mineCount = mineCount;
    minesGameState.balance -= betAmount;
    minesGameState.winnings = betAmount;
    minesGameState.safeCount = 0;
    minesGameState.multiplier = 1.0;
    minesGameState.isPlaying = true;
    
    document.getElementById('mineStartBtn').classList.add('hidden');
    document.getElementById('mineCashoutBtn').classList.remove('hidden');
    document.getElementById('mineCount').disabled = true;
    
    createMinesGrid();
    updateMinesUI();
}

function clickTile(index) {
    if (!minesGameState.isPlaying) return;
    
    const tile = minesGameState.tiles[index];
    
    if (tile.revealed) return;
    
    tile.revealed = true;
    
    if (tile.isMine) {
        // Hit a mine - game over
        tile.element.classList.add('mine');
        tile.element.textContent = '💣';
        
        minesGameState.isPlaying = false;
        minesGameState.balance += minesGameState.betAmount; // Return bet
        
        document.getElementById('mineStartBtn').classList.remove('hidden');
        document.getElementById('mineCashoutBtn').classList.add('hidden');
        document.getElementById('mineCount').disabled = false;
        
        // Reveal all mines
        minesGameState.tiles.forEach(t => {
            if (t.isMine && !t.revealed) {
                t.element.classList.add('mine');
                t.element.textContent = '💣';
            }
        });
        
        updateMinesBalance();
        alert('💣 You hit a mine! Game Over!');
        return;
    }
    
    // Safe tile
    tile.element.classList.add('safe');
    tile.element.textContent = '✓';
    
    minesGameState.safeCount++;
    
    // Calculate multiplier based on mines
    // More mines = higher multiplier per safe tile
    const multiplierIncrease = 0.5 + (minesGameState.mineCount * 0.1);
    minesGameState.multiplier += multiplierIncrease;
    minesGameState.winnings = Math.floor(minesGameState.betAmount * minesGameState.multiplier);
    
    updateMinesUI();
}

function minesCashout() {
    if (!minesGameState.isPlaying) return;
    
    minesGameState.balance += minesGameState.winnings;
    minesGameState.isPlaying = false;
    
    document.getElementById('mineStartBtn').classList.remove('hidden');
    document.getElementById('mineCashoutBtn').classList.add('hidden');
    document.getElementById('mineCount').disabled = false;
    
    updateMinesBalance();
    alert(`You won ${minesGameState.winnings} coins! Total balance: ${minesGameState.balance}`);
}

function resetMinesGame() {
    minesGameState.isPlaying = false;
    minesGameState.tiles = [];
    minesGameState.minePositions = [];
    minesGameState.safeCount = 0;
    minesGameState.multiplier = 1.0;
    minesGameState.winnings = 0;
    
    document.getElementById('mineStartBtn').classList.remove('hidden');
    document.getElementById('mineCashoutBtn').classList.add('hidden');
    document.getElementById('mineCount').disabled = false;
    
    document.getElementById('minesGrid').innerHTML = '';
    updateMinesUI();
}

function updateMinesUI() {
    document.getElementById('safeCount').textContent = minesGameState.safeCount;
    document.getElementById('minesMultiplier').textContent = minesGameState.multiplier.toFixed(1) + 'x';
    document.getElementById('mineWinningsDisplay').textContent = minesGameState.winnings + ' Coins';
    updateMinesBalance();
}

function updateMinesBalance() {
    document.getElementById('mineBalanceDisplay').textContent = minesGameState.balance + ' Coins';
    localStorage.setItem('user_coins', minesGameState.balance);
    
    const coinDisplay = document.getElementById('coinBalance');
    if (coinDisplay) {
        coinDisplay.innerText = new Intl.NumberFormat().format(minesGameState.balance) + ' Coins';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    minesGameState.balance = parseInt(localStorage.getItem('user_coins')) || 1000;
    updateMinesBalance();
});
