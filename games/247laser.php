<?php
/**
 * GameSense Fantasy - 247LASER Game
 * 24/7 laser-themed game
 */

require_once '../config/config.php';

$page_title = "247LASER Game";
$page_description = "Aim and shoot lasers to hit targets and win coins in this fast-paced game.";
$page_css = "game.css";
$page_js = "247laser.js";

include '../includes/header.php';
?>

<div class="game-container">
    <div class="game-wrapper">
        <!-- Game Area -->
        <div class="game-area">
            <h2 class="game-title">🔫 247LASER Game</h2>
            
            <div class="game-content">
                <canvas id="laserCanvas" width="600" height="400"></canvas>
                
                <div class="game-info mt-lg">
                    <div class="info-row">
                        <span>Targets Hit:</span>
                        <span id="targetsHit" class="text-gold">0</span>
                    </div>
                    <div class="info-row">
                        <span>Current Multiplier:</span>
                        <span id="laserMultiplier" class="text-gold">1.0x</span>
                    </div>
                </div>
                
                <div class="game-instructions mt-lg p-md card">
                    <h3 class="text-gold mb-md">📖 How to Play</h3>
                    <ul>
                        <li>🎯 Click on targets to shoot lasers</li>
                        <li>⚡ Each hit increases your multiplier</li>
                        <li>💰 More targets = higher winnings</li>
                        <li>⏱️ You have limited time per round</li>
                        <li>🏆 Try to hit as many targets as possible</li>
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
                    <input type="number" id="laserBetAmount" value="10" min="1" max="500">
                    <span class="input-suffix">Coins</span>
                </div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Your Balance</label>
                <div class="balance-display" id="laserBalanceDisplay">1000 Coins</div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Potential Winnings</label>
                <div class="winnings-display text-success" id="laserWinningsDisplay">0 Coins</div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Time Remaining</label>
                <div class="timer-display" id="laserTimerDisplay">30s</div>
            </div>
            
            <div class="button-group">
                <button class="btn btn-primary btn-block" id="laserStartBtn" onclick="startLaserGame()">Start Game</button>
                <button class="btn btn-secondary btn-block" id="laserResetBtn" onclick="resetLaserGame()">Reset</button>
            </div>
            
            <div class="alert alert-info mt-lg">
                <p><strong>Tip:</strong> Click fast! More targets hit = higher multiplier!</p>
            </div>
        </div>
    </div>
</div>

<style>
.game-content {
    text-align: center;
}

#laserCanvas {
    border: 2px solid var(--accent-gold);
    border-radius: var(--radius-lg);
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.2), rgba(255, 215, 0, 0.05));
    display: block;
    margin: 0 auto;
    cursor: crosshair;
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

.timer-display {
    font-size: var(--font-size-lg);
    font-weight: var(--font-weight-bold);
    padding: var(--spacing-md);
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--radius-md);
    text-align: center;
    color: var(--accent-gold);
}

.game-instructions ul {
    list-style-position: inside;
}

.game-instructions li {
    margin-bottom: 10px;
}

@media (max-width: 1024px) {
    #laserCanvas {
        max-width: 100%;
    }
}
</style>

<?php include '../includes/footer.php'; ?>
