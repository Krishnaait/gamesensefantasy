<?php
/**
 * GameSense Fantasy - Plinko Game
 * Drop ball through pegs and win coins
 */

require_once '../config/config.php';

$page_title = "Plinko Game";
$page_description = "Drop a ball through pegs and watch it bounce to win coins.";
$page_css = "game.css";
$page_js = "plinko.js";

include '../includes/header.php';
?>

<div class="game-container">
    <div class="game-wrapper">
        <!-- Game Area -->
        <div class="game-area">
            <h2 class="game-title">🎯 Plinko Game</h2>
            
            <div class="game-content">
                <canvas id="plinkoCanvas" width="600" height="500"></canvas>
                
                <div class="game-info mt-lg">
                    <div class="info-row">
                        <span>Last Multiplier:</span>
                        <span id="plinkoMultiplier" class="text-gold">0.0x</span>
                    </div>
                    <div class="info-row">
                        <span>Balls Dropped:</span>
                        <span id="ballsDropped" class="text-gold">0</span>
                    </div>
                </div>
                
                <div class="game-instructions mt-lg p-md card">
                    <h3 class="text-gold mb-md">📖 How to Play</h3>
                    <ul>
                        <li>🎯 Click "Drop Ball" to release the ball</li>
                        <li>⚪ The ball bounces through pegs</li>
                        <li>🎁 It lands in a slot at the bottom</li>
                        <li>💰 Each slot has a different multiplier (0.5x to 5.0x)</li>
                        <li>🏆 Higher risk slots offer higher rewards</li>
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
                    <input type="number" id="plinkoBetAmount" value="10" min="1" max="500">
                    <span class="input-suffix">Coins</span>
                </div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Your Balance</label>
                <div class="balance-display" id="plinkoBalanceDisplay">1000 Coins</div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Last Winnings</label>
                <div class="winnings-display text-success" id="plinkoWinningsDisplay">0 Coins</div>
            </div>
            
            <div class="button-group">
                <button class="btn btn-primary btn-block" id="dropBallBtn" onclick="dropBall()">Drop Ball</button>
                <button class="btn btn-secondary btn-block" id="plinkoResetBtn" onclick="resetPlinko()">Reset</button>
            </div>
            
            <div class="alert alert-info mt-lg">
                <p><strong>Tip:</strong> The center slots offer the best balance of risk and reward!</p>
            </div>
        </div>
    </div>
</div>

<style>
.game-content {
    text-align: center;
}

#plinkoCanvas {
    border: 2px solid var(--accent-gold);
    border-radius: var(--radius-lg);
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.2), rgba(255, 215, 0, 0.05));
    display: block;
    margin: 0 auto;
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

.game-instructions ul {
    list-style-position: inside;
}

.game-instructions li {
    margin-bottom: 10px;
}

@media (max-width: 1024px) {
    #plinkoCanvas {
        max-width: 100%;
    }
}
</style>

<?php include '../includes/footer.php'; ?>
