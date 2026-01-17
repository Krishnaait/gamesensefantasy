<?php
/**
 * GameSense Fantasy - Fair Play Policy Page
 */

require_once '../config/config.php';

$page_title = "Fair Play Policy";
$page_description = "Learn about our commitment to fair play and transparent game mechanics on GameSense Fantasy.";

include '../includes/header.php';
?>

<section class="fairplay-header text-center mb-2xl animate-fadeIn">
    <div class="container">
        <h1>Fair Play Policy</h1>
        <p class="text-lg">Our Commitment to Transparency and Fairness</p>
    </div>
</section>

<section class="fairplay-content">
    <div class="container">
        <div class="card p-2xl mb-2xl alert alert-success">
            <h2 class="text-gold mb-lg">✓ 100% Fair Gaming Guaranteed</h2>
            <p>At <?php echo SITE_NAME; ?>, we are committed to providing a completely fair and transparent gaming experience. All our games are designed with fairness as the top priority.</p>
        </div>

        <div class="card p-2xl mb-2xl">
            <h2 class="mb-lg">1. Random Number Generator (RNG)</h2>
            <p>All games on <?php echo SITE_NAME; ?> use certified Random Number Generators (RNG) to ensure that every outcome is completely random and unpredictable. Our RNG is:</p>
            <ul class="mb-lg">
                <li>Certified by independent testing laboratories</li>
                <li>Regularly audited for accuracy and fairness</li>
                <li>Compliant with international gaming standards</li>
                <li>Designed to prevent manipulation or bias</li>
            </ul>

            <h2 class="mb-lg mt-xl">2. Game Mechanics</h2>
            <p>Each game on our platform operates under specific, transparent mechanics:</p>
            <ul class="mb-lg">
                <li><strong>Slots:</strong> Fixed paylines with clearly defined payout percentages</li>
                <li><strong>Poker:</strong> Standard poker hand rankings with fair card distribution</li>
                <li><strong>Blackjack:</strong> Standard blackjack rules with fair deck composition</li>
                <li><strong>Dice:</strong> Fair dice rolls with equal probability for each outcome</li>
                <li><strong>Mines:</strong> Random mine placement with equal probability for each tile</li>
                <li><strong>Chicken:</strong> Random egg and bone distribution</li>
                <li><strong>Plinko:</strong> Physics-based ball drop with random peg interactions</li>
                <li><strong>11X Game:</strong> Fair multiplier calculation</li>
                <li><strong>247LASER:</strong> Transparent game mechanics</li>

            </ul>

            <h2 class="mb-lg mt-xl">3. Payout Rates</h2>
            <p>All games have published Return to Player (RTP) rates that represent the theoretical percentage of wagered virtual coins returned to players over time. These rates are:</p>
            <ul class="mb-lg">
                <li>Clearly displayed for each game</li>
                <li>Based on mathematical calculations</li>
                <li>Independently verified</li>
                <li>Consistent across all players</li>
            </ul>

            <h2 class="mb-lg mt-xl">4. No Manipulation</h2>
            <p>We guarantee that:</p>
            <ul class="mb-lg">
                <li>Game outcomes cannot be manipulated by the platform</li>
                <li>No player receives preferential treatment</li>
                <li>All players have equal chances of winning</li>
                <li>Game algorithms are not influenced by player behavior or history</li>
                <li>Virtual coin balances are accurately tracked and displayed</li>
            </ul>

            <h2 class="mb-lg mt-xl">5. Transparency</h2>
            <p>We believe in complete transparency regarding our games:</p>
            <ul class="mb-lg">
                <li>Game rules are clearly documented and easily accessible</li>
                <li>"How to Play" guides are embedded in each game</li>
                <li>Payout information is publicly available</li>
                <li>Technical specifications are disclosed</li>
                <li>Players can view their game history</li>
            </ul>

            <h2 class="mb-lg mt-xl">6. Security Measures</h2>
            <p>To ensure fair play, we implement:</p>
            <ul class="mb-lg">
                <li>Advanced encryption for all data transmission</li>
                <li>Regular security audits and penetration testing</li>
                <li>Anti-fraud detection systems</li>
                <li>Monitoring for suspicious activity</li>
                <li>Secure virtual coin management</li>
            </ul>

            <h2 class="mb-lg mt-xl">7. Compliance</h2>
            <p><?php echo SITE_NAME; ?> complies with:</p>
            <ul class="mb-lg">
                <li>International gaming standards</li>
                <li>Data protection regulations</li>
                <li>Fair gaming practices</li>
                <li>Responsible gaming guidelines</li>
            </ul>

            <h2 class="mb-lg mt-xl">8. Dispute Resolution</h2>
            <p>If you believe there is an issue with game fairness, please contact us immediately:</p>
            <p>
                Email: <a href="mailto:<?php echo COMPANY_EMAIL; ?>"><?php echo COMPANY_EMAIL; ?></a><br>
                We will investigate all claims thoroughly and respond within 48 hours.
            </p>

            <h2 class="mb-lg mt-xl">9. Regular Audits</h2>
            <p>Our games and systems are regularly audited by independent third parties to ensure:</p>
            <ul class="mb-lg">
                <li>RNG functionality and randomness</li>
                <li>Payout accuracy</li>
                <li>Security and data protection</li>
                <li>Compliance with fair gaming standards</li>
            </ul>

            <h2 class="mb-lg mt-xl">10. Player Protection</h2>
            <p>We protect our players by:</p>
            <ul class="mb-lg">
                <li>Ensuring game fairness</li>
                <li>Protecting personal data</li>
                <li>Preventing fraud and cheating</li>
                <li>Providing transparent information</li>
                <li>Offering responsive customer support</li>
            </ul>

            <h2 class="mb-lg mt-xl">11. Continuous Improvement</h2>
            <p>We are committed to continuously improving our fair play practices:</p>
            <ul class="mb-lg">
                <li>Regular updates to game algorithms</li>
                <li>Implementation of latest security technologies</li>
                <li>Feedback from player community</li>
                <li>Industry best practices adoption</li>
            </ul>

            <h2 class="mb-lg mt-xl">12. Contact & Feedback</h2>
            <p>If you have any questions about our fair play policy or would like to provide feedback, please contact us:</p>
            <p>
                <strong><?php echo COMPANY_NAME; ?></strong><br>
                Email: <a href="mailto:<?php echo COMPANY_EMAIL; ?>"><?php echo COMPANY_EMAIL; ?></a><br>
                Address: <?php echo COMPANY_ADDRESS; ?>
            </p>
        </div>

        <div class="alert alert-success text-center">
            <p><strong>Your trust is our priority.</strong> We are committed to maintaining the highest standards of fair play and transparency.</p>
        </div>
    </div>
</section>

<style>
.fairplay-header {
    padding: 60px 0;
    background: linear-gradient(to bottom, rgba(16, 185, 129, 0.05), transparent);
}

ul {
    list-style-position: inside;
    padding-left: 20px;
}

ul li {
    margin-bottom: 10px;
}
</style>

<?php include '../includes/footer.php'; ?>
