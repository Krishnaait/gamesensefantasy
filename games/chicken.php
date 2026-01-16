<?php
/**
 * GameSense Fantasy - Chicken Game
 * Pick eggs and avoid bones for virtual coins
 */

require_once '../config/config.php';

$page_title = "Chicken Game";
$page_description = "Pick eggs and avoid bones in this exciting social casino game.";
$page_css = "game.css";
$page_js = "chicken.js";

include '../includes/header.php';
?>

<div class="game-container">
    <div class="game-wrapper">
        <!-- Game Area -->
        <div class="game-area">
            <h2 class="game-title">🐔 Chicken Game</h2>
            
            <div class="game-content">
                <canvas id="gameCanvas" width="600" height="400"></canvas>
                
                <div class="game-info mt-lg">
                    <div class="info-row">
                        <span>Current Multiplier:</span>
                        <span id="multiplier" class="text-gold">1.0x</span>
                    </div>
                    <div class="info-row">
                        <span>Items Picked:</span>
                        <span id="itemsCount" class="text-gold">0</span>
                    </div>
                </div>
                
                <div class="game-instructions mt-lg p-md card">
                    <h3 class="text-gold mb-md">📖 How to Play</h3>
                    <ul>
                        <li>🥚 Click on eggs to increase your multiplier (1.2x each)</li>
                        <li>💀 Avoid bones - they end the game immediately</li>
                        <li>🎯 The more eggs you collect, the higher your winnings</li>
                        <li>💰 Cash out anytime to secure your coins</li>
                        <li>⚠️ If you hit a bone, you lose everything in this round</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Control Panel -->
        <div class="control-panel">
            <h2 class="control-title">Game Controls</h2>
            
            <div class="control-section mb-xl">
                <label class="label-text">Bet Amount</label>
                <div class="input-group">
                    <input type="number" id="betAmount" value="10" min="1" max="500">
                    <span class="input-suffix">Coins</span>
                </div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Your Balance</label>
                <div class="balance-display" id="balanceDisplay">1000 Coins</div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Potential Winnings</label>
                <div class="winnings-display text-success" id="winningsDisplay">0 Coins</div>
            </div>
            
            <div class="button-group">
                <button class="btn btn-primary btn-block" id="startBtn" onclick="startGame()">Start Game</button>
                <button class="btn btn-success btn-block hidden" id="cashoutBtn" onclick="cashout()">Cash Out</button>
                <button class="btn btn-secondary btn-block" id="resetBtn" onclick="resetGame()">Reset</button>
            </div>
            
            <div class="alert alert-info mt-lg">
                <p><strong>Tip:</strong> Start with small bets and work your way up as you get comfortable with the game.</p>
            </div>
        </div>
    </div>
</div>

<style>
.game-content {
    text-align: center;
}

#gameCanvas {
    border: 2px solid var(--accent-gold);
    border-radius: var(--radius-lg);
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.2), rgba(255, 215, 0, 0.05));
    display: block;
    margin: 0 auto;
    cursor: pointer;
    max-width: 100%;
    height: auto;
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

.game-instructions {
    text-align: left;
}

.game-instructions ul {
    list-style-position: inside;
}

.game-instructions li {
    margin-bottom: 10px;
}

.control-section {
    padding: var(--spacing-md);
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--radius-md);
}

.label-text {
    display: block;
    font-size: var(--font-size-sm);
    color: var(--text-tertiary);
    margin-bottom: var(--spacing-sm);
    font-weight: var(--font-weight-medium);
}

.input-group {
    display: flex;
    gap: var(--spacing-sm);
}

.input-group input {
    flex: 1;
}

.input-suffix {
    display: flex;
    align-items: center;
    padding: 0 var(--spacing-md);
    color: var(--text-tertiary);
    font-size: var(--font-size-sm);
}

.balance-display,
.winnings-display {
    font-size: var(--font-size-lg);
    font-weight: var(--font-weight-bold);
    padding: var(--spacing-md);
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--radius-md);
    text-align: center;
}

.button-group {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-md);
}

.btn-block {
    width: 100%;
}

@media (max-width: 1024px) {
    #gameCanvas {
        max-width: 100%;
    }
    
    .game-info {
        grid-template-columns: 1fr;
    }
}
</style>

<?php include '../includes/footer.php'; ?>
