<?php
/**
 * GameSense Fantasy - Mines Game
 * Click safe tiles and avoid mines
 */

require_once '../config/config.php';

$page_title = "Mines Game";
$page_description = "Click safe tiles and avoid mines to multiply your coins.";
$page_css = "game.css";
$page_js = "mines.js";

include '../includes/header.php';
?>

<div class="game-container">
    <div class="game-wrapper">
        <!-- Game Area -->
        <div class="game-area">
            <h2 class="game-title">💣 Mines Game</h2>
            
            <div class="game-content">
                <div class="mines-grid" id="minesGrid"></div>
                
                <div class="game-info mt-lg">
                    <div class="info-row">
                        <span>Safe Tiles Clicked:</span>
                        <span id="safeCount" class="text-gold">0</span>
                    </div>
                    <div class="info-row">
                        <span>Current Multiplier:</span>
                        <span id="minesMultiplier" class="text-gold">1.0x</span>
                    </div>
                </div>
                
                <div class="game-instructions mt-lg p-md card">
                    <h3 class="text-gold mb-md">📖 How to Play</h3>
                    <ul>
                        <li>🟩 Click on tiles to reveal them</li>
                        <li>✓ Green tiles are safe and increase your multiplier</li>
                        <li>💣 Red tiles are mines - hit one and lose everything</li>
                        <li>💰 Cash out anytime to secure your winnings</li>
                        <li>⚠️ The more tiles you click, the higher the risk</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Control Panel -->
        <div class="control-panel">
            <h2 class="control-title">Game Controls</h2>
            
            <div class="control-section mb-xl">
                <label class="label-text">Number of Mines</label>
                <select id="mineCount">
                    <option value="1">1 Mine</option>
                    <option value="2">2 Mines</option>
                    <option value="3" selected>3 Mines</option>
                    <option value="4">4 Mines</option>
                    <option value="5">5 Mines</option>
                </select>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Bet Amount</label>
                <div class="input-group">
                    <input type="number" id="mineBetAmount" value="10" min="1" max="500">
                    <span class="input-suffix">Coins</span>
                </div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Your Balance</label>
                <div class="balance-display" id="mineBalanceDisplay">1000 Coins</div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Potential Winnings</label>
                <div class="winnings-display text-success" id="mineWinningsDisplay">0 Coins</div>
            </div>
            
            <div class="button-group">
                <button class="btn btn-primary btn-block" id="mineStartBtn" onclick="startMinesGame()">Start Game</button>
                <button class="btn btn-success btn-block hidden" id="mineCashoutBtn" onclick="minesCashout()">Cash Out</button>
                <button class="btn btn-secondary btn-block" id="mineResetBtn" onclick="resetMinesGame()">Reset</button>
            </div>
            
            <div class="alert alert-info mt-lg">
                <p><strong>Tip:</strong> More mines = higher risk but higher multiplier per safe tile!</p>
            </div>
        </div>
    </div>
</div>

<style>
.game-content {
    text-align: center;
}

.mines-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 10px;
    margin: var(--spacing-2xl) auto;
    max-width: 400px;
}

.mine-tile {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.5), rgba(255, 215, 0, 0.2));
    border: 2px solid var(--accent-gold);
    border-radius: var(--radius-md);
    cursor: pointer;
    font-size: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all var(--transition-fast);
    user-select: none;
}

.mine-tile:hover:not(.revealed) {
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(255, 215, 0, 0.3);
}

.mine-tile.revealed {
    cursor: not-allowed;
}

.mine-tile.safe {
    background: linear-gradient(135deg, #10b981, #059669);
    border-color: #10b981;
    animation: revealSafe 0.3s ease;
}

.mine-tile.mine {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    border-color: #ef4444;
    animation: revealMine 0.3s ease;
}

@keyframes revealSafe {
    0% {
        transform: scale(0.8);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes revealMine {
    0% {
        transform: scale(0.8);
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
    }
}

.game-info {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spacing-md);
}

.info-row {
    display: flex;
    justify-content: space-between;
    padding: var(--spacing-md);
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--radius-md);
}

@media (max-width: 768px) {
    .mines-grid {
        grid-template-columns: repeat(4, 1fr);
    }
    
    .mine-tile {
        width: 60px;
        height: 60px;
        font-size: 24px;
    }
}
</style>

<?php include '../includes/footer.php'; ?>
