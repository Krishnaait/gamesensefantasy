<?php
/**
 * GameSense Fantasy - 11X Game
 * Multiply your coins by 11x
 */

require_once '../config/config.php';

$page_title = "11X Game";
$page_description = "Try to multiply your coins by 11x in this high-risk, high-reward game.";
$page_css = "game.css";
$page_js = "11x.js";

include '../includes/header.php';
?>

<div class="game-container">
    <div class="game-wrapper">
        <!-- Game Area -->
        <div class="game-area">
            <h2 class="game-title">⚡ 11X Game</h2>
            
            <div class="game-content">
                <div class="game-display">
                    <canvas id="elevenXCanvas" width="400" height="300"></canvas>
                </div>
                
                <div class="game-info mt-lg">
                    <div class="info-row">
                        <span>Current Multiplier:</span>
                        <span id="elevenXMultiplier" class="text-gold">1.0x</span>
                    </div>
                    <div class="info-row">
                        <span>Status:</span>
                        <span id="elevenXStatus" class="text-gold">Ready</span>
                    </div>
                </div>
                
                <div class="game-instructions mt-lg p-md card">
                    <h3 class="text-gold mb-md">📖 How to Play</h3>
                    <ul>
                        <li>⚡ Place your bet to start</li>
                        <li>🎯 Watch the multiplier increase from 1.0x</li>
                        <li>💰 Cash out anytime to secure your winnings</li>
                        <li>🎁 Reach 11.0x for maximum payout</li>
                        <li>⚠️ If you don't cash out in time, you lose everything</li>
                        <li>⏱️ The multiplier increases randomly - timing is key!</li>
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
                    <input type="number" id="elevenXBetAmount" value="10" min="1" max="500">
                    <span class="input-suffix">Coins</span>
                </div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Your Balance</label>
                <div class="balance-display" id="elevenXBalanceDisplay">1000 Coins</div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Potential Winnings</label>
                <div class="winnings-display text-success" id="elevenXWinningsDisplay">0 Coins</div>
            </div>
            
            <div class="button-group">
                <button class="btn btn-primary btn-block" id="elevenXStartBtn" onclick="startElevenX()">Start Game</button>
                <button class="btn btn-success btn-block hidden" id="elevenXCashoutBtn" onclick="elevenXCashout()">Cash Out Now!</button>
                <button class="btn btn-secondary btn-block" id="elevenXResetBtn" onclick="resetElevenX()">Reset</button>
            </div>
            
            <div class="alert alert-warning mt-lg">
                <p><strong>⚠️ High Risk!</strong> This game can crash anytime. Cash out before it's too late!</p>
            </div>
        </div>
    </div>
</div>

<style>
.game-content {
    text-align: center;
}

.game-display {
    display: flex;
    justify-content: center;
    margin: var(--spacing-2xl) 0;
}

#elevenXCanvas {
    border: 3px solid var(--accent-gold);
    border-radius: var(--radius-lg);
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.3), rgba(255, 215, 0, 0.1));
    box-shadow: 0 0 30px rgba(255, 215, 0, 0.2);
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
</style>

<?php include '../includes/footer.php'; ?>
