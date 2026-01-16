<?php
/**
 * GameSense Fantasy - Community Rules Page
 */

require_once '../config/config.php';

$page_title = "Community Rules";
$page_description = "Read the Community Rules for GameSense Fantasy to ensure a safe and respectful gaming environment.";

include '../includes/header.php';
?>

<section class="community-header text-center mb-2xl animate-fadeIn">
    <div class="container">
        <h1>Community Rules</h1>
        <p class="text-lg">Building a Safe and Respectful Gaming Community</p>
    </div>
</section>

<section class="community-content">
    <div class="container">
        <div class="card p-2xl mb-2xl alert alert-info">
            <h2 class="text-gold mb-lg">🤝 Our Community Values</h2>
            <p>At <?php echo SITE_NAME; ?>, we believe in creating a safe, respectful, and enjoyable gaming environment for all players. These community rules help us maintain that environment.</p>
        </div>

        <div class="card p-2xl mb-2xl">
            <h2 class="mb-lg">1. Respect & Courtesy</h2>
            <p>All players must treat each other with respect and courtesy:</p>
            <ul class="mb-lg">
                <li>Be respectful to other players and staff</li>
                <li>Use appropriate language at all times</li>
                <li>No harassment, bullying, or discrimination</li>
                <li>No hate speech or offensive content</li>
                <li>Respect cultural and religious differences</li>
            </ul>

            <h2 class="mb-lg mt-xl">2. Fair Play</h2>
            <p>All players must play fairly and honestly:</p>
            <ul class="mb-lg">
                <li>No cheating or exploiting game mechanics</li>
                <li>No use of bots or automated tools</li>
                <li>No account sharing or trading</li>
                <li>No attempting to manipulate game outcomes</li>
                <li>Report any suspicious activity immediately</li>
            </ul>

            <h2 class="mb-lg mt-xl">3. Account Security</h2>
            <p>Players are responsible for their account security:</p>
            <ul class="mb-lg">
                <li>Do not share your account details with anyone</li>
                <li>Do not use another person's account</li>
                <li>Report unauthorized access immediately</li>
                <li>Keep your browser and devices secure</li>
                <li>Use strong security practices</li>
            </ul>

            <h2 class="mb-lg mt-xl">4. Prohibited Conduct</h2>
            <p>The following conduct is strictly prohibited:</p>
            <ul class="mb-lg">
                <li>Harassment, threats, or abuse of other players</li>
                <li>Spam, advertising, or promotional content</li>
                <li>Sharing personal information of others</li>
                <li>Attempting to gain unauthorized access</li>
                <li>Distributing malware or harmful content</li>
                <li>Engaging in illegal activities</li>
                <li>Violating intellectual property rights</li>
                <li>Impersonating staff or other players</li>
            </ul>

            <h2 class="mb-lg mt-xl">5. Age Requirements</h2>
            <p>Players must comply with age requirements:</p>
            <ul class="mb-lg">
                <li>You must be at least 18 years old to play</li>
                <li>Minors are not permitted on the platform</li>
                <li>Parents/guardians are responsible for monitoring minors</li>
                <li>We reserve the right to verify age if necessary</li>
            </ul>

            <h2 class="mb-lg mt-xl">6. Content Standards</h2>
            <p>All content must meet our standards:</p>
            <ul class="mb-lg">
                <li>No explicit or adult content</li>
                <li>No violence or graphic content</li>
                <li>No hate speech or discriminatory content</li>
                <li>No misleading or false information</li>
                <li>No spam or repetitive content</li>
            </ul>

            <h2 class="mb-lg mt-xl">7. Responsible Gaming</h2>
            <p>Players must game responsibly:</p>
            <ul class="mb-lg">
                <li>Set time limits for gaming sessions</li>
                <li>Take regular breaks</li>
                <li>Never spend real money on virtual coins</li>
                <li>Seek help if gaming becomes problematic</li>
                <li>Respect self-exclusion requests</li>
            </ul>

            <h2 class="mb-lg mt-xl">8. Reporting Violations</h2>
            <p>If you witness a violation of these rules:</p>
            <ul class="mb-lg">
                <li>Report it immediately to our support team</li>
                <li>Provide detailed information about the violation</li>
                <li>Include any relevant screenshots or evidence</li>
                <li>Do not engage with the violator</li>
                <li>Allow our team to investigate</li>
            </ul>

            <h2 class="mb-lg mt-xl">9. Consequences of Violations</h2>
            <p>Violations of these rules may result in:</p>
            <ul class="mb-lg">
                <li>Warning or temporary suspension</li>
                <li>Permanent account ban</li>
                <li>Forfeiture of virtual coins</li>
                <li>Legal action if applicable</li>
                <li>Reporting to appropriate authorities</li>
            </ul>

            <h2 class="mb-lg mt-xl">10. Dispute Resolution</h2>
            <p>If you have a dispute or concern:</p>
            <ul class="mb-lg">
                <li>Contact our support team with details</li>
                <li>Provide any relevant evidence</li>
                <li>Allow time for investigation</li>
                <li>Accept our decision in good faith</li>
                <li>Escalate if necessary</li>
            </ul>

            <h2 class="mb-lg mt-xl">11. Modifications to Rules</h2>
            <p>We reserve the right to:</p>
            <ul class="mb-lg">
                <li>Modify these rules at any time</li>
                <li>Enforce rules at our discretion</li>
                <li>Take action against violations</li>
                <li>Terminate accounts for serious violations</li>
            </ul>

            <h2 class="mb-lg mt-xl">12. Contact & Support</h2>
            <p>For questions about these rules or to report violations:</p>
            <p>
                <strong><?php echo COMPANY_NAME; ?></strong><br>
                Email: <a href="mailto:<?php echo COMPANY_EMAIL; ?>"><?php echo COMPANY_EMAIL; ?></a><br>
                Address: <?php echo COMPANY_ADDRESS; ?>
            </p>
        </div>

        <div class="alert alert-success text-center">
            <p><strong>Together, we create a better gaming community.</strong> Thank you for following these rules and helping us maintain a safe and respectful environment.</p>
        </div>
    </div>
</section>

<style>
.community-header {
    padding: 60px 0;
    background: linear-gradient(to bottom, rgba(124, 58, 237, 0.05), transparent);
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
