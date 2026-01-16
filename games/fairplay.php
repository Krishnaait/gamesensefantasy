<?php
/**
 * GameSense Fantasy - Fair Play Game
 * Demonstrating transparent game mechanics
 */

require_once '../config/config.php';

$page_title = "Fair Play Game";
$page_description = "Experience complete transparency with our Fair Play demonstration game.";
$page_css = "game.css";
$page_js = "fairplay.js";

include '../includes/header.php';
?>

<div class="game-container">
    <div class="game-wrapper">
        <!-- Game Area -->
        <div class="game-area">
            <h2 class="game-title">⚖️ Fair Play Game</h2>
            
            <div class="game-content">
                <div class="fairplay-display">
                    <canvas id="fairplayCanvas" width="500" height="300"></canvas>
                </div>
                
                <div class="game-info mt-lg">
                    <div class="info-row">
                        <span>Rounds Played:</span>
                        <span id="roundsPlayed" class="text-gold">0</span>
                    </div>
                    <div class="info-row">
                        <span>Win Rate:</span>
                        <span id="winRate" class="text-gold">0%</span>
                    </div>
                </div>
                
                <div class="game-instructions mt-lg p-md card">
                    <h3 class="text-gold mb-md">📖 How to Play</h3>
                    <ul>
                        <li>⚖️ This game demonstrates complete fairness</li>
                        <li>🎯 Each round has a 50% chance to win</li>
                        <li>💰 Win = 2x your bet, Lose = lose your bet</li>
                        <li>📊 See real-time statistics</li>
                        <li>✓ 100% transparent Random Number Generator</li>
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
                    <input type="number" id="fairplayBetAmount" value="10" min="1" max="500">
                    <span class="input-suffix">Coins</span>
                </div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Your Balance</label>
                <div class="balance-display" id="fairplayBalanceDisplay">1000 Coins</div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Last Result</label>
                <div class="result-display" id="fairplayResultDisplay">-</div>
            </div>
            
            <div class="control-section mb-xl">
                <label class="label-text">Statistics</label>
                <div class="stats-display">
                    <div>Wins: <span id="winsCount" class="text-success">0</span></div>
                    <div>Losses: <span id="lossesCount" class="text-danger">0</span></div>
                </div>
            </div>
            
            <div class="button-group">
                <button class="btn btn-primary btn-block" id="fairplayPlayBtn" onclick="playFairplay()">Play Round</button>
                <button class="btn btn-secondary btn-block" id="fairplayResetBtn" onclick="resetFairplay()">Reset Stats</button>
            </div>
            
            <div class="alert alert-success mt-lg">
                <p><strong>✓ Certified Fair:</strong> This game uses a certified RNG with 50/50 odds.</p>
            </div>
        </div>
    </div>
</div>

<style>
.game-content {
    text-align: center;
}

.fairplay-display {
    display: flex;
    justify-content: center;
    margin: var(--spacing-2xl) 0;
}

#fairplayCanvas {
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

.result-display {
    font-size: var(--font-size-lg);
    font-weight: var(--font-weight-bold);
    padding: var(--spacing-md);
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--radius-md);
    text-align: center;
    color: var(--accent-gold);
}

.stats-display {
    padding: var(--spacing-md);
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--radius-md);
    text-align: center;
    font-weight: var(--font-weight-bold);
}

.stats-display div {
    margin-bottom: 5px;
}

.game-instructions ul {
    list-style-position: inside;
}

.game-instructions li {
    margin-bottom: 10px;
}
</style>

<?php include '../includes/footer.php'; ?>
