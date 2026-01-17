<?php
/**
 * GameSense Fantasy - Plinko Game
 * Drop ball through pegs, land in multiplier slots
 */

require_once '../config/config.php';

$page_title = "Plinko Game";
$page_description = "Drop a ball through pegs and win based on where it lands!";
$page_css = "game.css";
$page_js = "plinko.js";

include '../includes/header.php';
?>

<div class="game-container">
    <div class="game-wrapper">
        <!-- Game Area -->
        <div class="game-area">
            <h2 class="game-title">🎯 PLINKO GAME 🎯</h2>
            
            <div class="game-content">
                <canvas id="plinkoCanvas" width="600" height="600"></canvas>
                
                <!-- Game Instructions -->
                <div class="game-instructions mt-lg p-md card">
                    <h3 class="text-gold mb-md">📖 How to Play</h3>
                    <ul>
                        <li>💰 Set your bet amount</li>
                        <li>🎚️ Choose risk level (Low/Medium/High)</li>
                        <li>🎯 Click "DROP BALL" to release</li>
                        <li>⚪ Watch ball bounce down through pegs</li>
                        <li>🎁 Ball lands in multiplier slot at bottom</li>
                        <li>💎 Win = Bet × Multiplier</li>
                        <li>⚠️ Higher risk = bigger multipliers!</li>
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
                <div class="quick-bet-buttons mt-md">
                    <button class="btn btn-sm btn-secondary quick-bet" data-amount="10">10</button>
                    <button class="btn btn-sm btn-secondary quick-bet" data-amount="50">50</button>
                    <button class="btn btn-sm btn-secondary quick-bet" data-amount="100">100</button>
                    <button class="btn btn-sm btn-secondary quick-bet" data-amount="max">MAX</button>
                </div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Risk Level</label>
                <select id="riskLevel" class="form-select">
                    <option value="low">Low Risk</option>
                    <option value="medium" selected>Medium Risk</option>
                    <option value="high">High Risk</option>
                </select>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Your Credits</label>
                <div class="balance-display" id="credits">1000</div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Last Win</label>
                <div class="last-win-display" id="lastWin">0</div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Statistics</label>
                <div class="stats-grid">
                    <div class="stat-item">
                        <span class="stat-label">Total Drops:</span>
                        <span class="stat-value" id="totalDrops">0</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Total Won:</span>
                        <span class="stat-value" id="totalWon">0</span>
                    </div>
                </div>
            </div>
            
            <div class="button-group">
                <button class="btn btn-primary btn-block" id="dropButton">🎯 DROP BALL 🎯</button>
            </div>
            
            <div class="alert alert-info mt-lg">
                <p><strong>Tip:</strong> Center slots = lower multipliers, Edge slots = higher multipliers!</p>
            </div>
        </div>
    </div>
</div>

<style>
.game-content {
    text-align: center;
}

#plinkoCanvas {
    border: 3px solid var(--accent-gold);
    border-radius: var(--radius-lg);
    background: linear-gradient(180deg, rgba(10, 14, 39, 0.9), rgba(124, 58, 237, 0.3));
    box-shadow: 0 0 30px rgba(255, 215, 0, 0.2);
    max-width: 100%;
    height: auto;
}

.form-select {
    width: 100%;
    padding: var(--spacing-md);
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-md);
    color: var(--text-primary);
    font-size: var(--font-size-md);
    cursor: pointer;
}

.form-select:focus {
    outline: none;
    border-color: var(--accent-gold);
}

.quick-bet-buttons {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: var(--spacing-sm);
}

.stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spacing-md);
}

.stat-item {
    display: flex;
    flex-direction: column;
    padding: var(--spacing-sm);
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--radius-md);
}

.stat-label {
    font-size: var(--font-size-sm);
    opacity: 0.7;
}

.stat-value {
    font-size: var(--font-size-lg);
    font-weight: var(--font-weight-bold);
    color: var(--accent-gold);
}

.last-win-display {
    font-size: var(--font-size-xl);
    font-weight: var(--font-weight-bold);
    padding: var(--spacing-md);
    background: rgba(16, 185, 129, 0.1);
    border-radius: var(--radius-md);
    text-align: center;
    color: #10b981;
}

@media (max-width: 768px) {
    #plinkoCanvas {
        width: 100%;
    }
    
    .quick-bet-buttons {
        grid-template-columns: repeat(3, 1fr);
    }
}
</style>

<?php include '../includes/footer.php'; ?>
