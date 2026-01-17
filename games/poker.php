<?php
require_once '../config/config.php';
$page_title = "Poker Game";
$page_js = "poker.js";
include '../includes/header.php';
?>
<div class="game-container"><div class="game-wrapper">
<div class="game-area"><h2 class="game-title">🃏 VIDEO POKER 🃏</h2>
<div id="pokerHand" style="display:flex;gap:10px;justify-content:center;margin:30px 0"></div>
<div style="text-align:center"><h3 id="handResult" style="color:gold">Place your bet to start!</h3></div>
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
<button class="btn btn-primary btn-block" id="dealButton">🎴 DEAL 🎴</button>
<button class="btn btn-success btn-block" id="drawButton" style="display:none">🔄 DRAW 🔄</button>
</div></div></div>
<?php include '../includes/footer.php'; ?>
