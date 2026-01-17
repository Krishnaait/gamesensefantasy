<?php
require_once '../config/config.php';
$page_title = "11X Game";
$page_js = "11x.js";
include '../includes/header.php';
?>
<div class="game-container"><div class="game-wrapper">
<div class="game-area"><h2 class="game-title">⚡ 11X CRASH GAME ⚡</h2>
<canvas id="gameCanvas" width="600" height="400" style="background:#1a1a2e;border:3px solid gold;border-radius:15px;display:block;margin:20px auto"></canvas>
<div style="text-align:center;margin:20px"><h1 id="multiplier" style="color:gold;font-size:48px">1.00x</h1></div>
</div>
<div class="control-panel"><h2>Controls</h2>
<div class="control-section mb-xl"><label>Bet Amount</label>
<input type="number" id="betAmount" value="10" min="1">
<div class="quick-bet-buttons mt-md">
<button class="btn btn-sm quick-bet" data-amount="10">10</button>
<button class="btn btn-sm quick-bet" data-amount="50">50</button>
<button class="btn btn-sm quick-bet" data-amount="100">100</button>
<button class="btn btn-sm quick-bet" data-amount="max">MAX</button>
</div></div>
<div class="control-section mb-xl"><label>Credits</label><div id="credits">1000</div></div>
<div class="control-section mb-xl"><label>Last Win</label><div id="lastWin">0</div></div>
<button class="btn btn-primary btn-block" id="betButton">🎮 PLACE BET 🎮</button>
<button class="btn btn-success btn-block" id="cashoutButton" style="display:none">💰 CASH OUT 💰</button>
</div></div></div>
<?php include '../includes/footer.php'; ?>
