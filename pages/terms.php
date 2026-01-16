<?php
/**
 * GameSense Fantasy - Terms of Use Page
 */

require_once '../config/config.php';

$page_title = "Terms of Use";
$page_description = "Read the Terms of Use for GameSense Fantasy. Please review these terms before using our platform.";

include '../includes/header.php';
?>

<section class="terms-header text-center mb-2xl animate-fadeIn">
    <div class="container">
        <h1>Terms of Use</h1>
        <p class="text-lg">Last Updated: <?php echo getLastUpdated(); ?></p>
    </div>
</section>

<section class="terms-content">
    <div class="container">
        <div class="card p-2xl">
            <h2 class="mb-lg">1. Acceptance of Terms</h2>
            <p>By accessing and using the <?php echo SITE_NAME; ?> website and services, you agree to be bound by these Terms of Use. If you do not agree to abide by the above, please do not use this service.</p>

            <h2 class="mb-lg mt-xl">2. Use License</h2>
            <p>Permission is granted to temporarily download one copy of the materials (information or software) on <?php echo SITE_NAME; ?> for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>
            <ul class="mb-lg">
                <li>Modifying or copying the materials</li>
                <li>Using the materials for any commercial purpose or for any public display</li>
                <li>Attempting to decompile or reverse engineer any software contained on the website</li>
                <li>Removing any copyright or other proprietary notations from the materials</li>
                <li>Transferring the materials to another person or "mirroring" the materials on any other server</li>
                <li>Attempting to gain unauthorized access to any portion or feature of the website</li>
            </ul>

            <h2 class="mb-lg">3. Disclaimer</h2>
            <p>The materials on <?php echo SITE_NAME; ?> are provided on an 'as is' basis. <?php echo COMPANY_NAME; ?> makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</p>

            <h2 class="mb-lg mt-xl">4. Limitations</h2>
            <p>In no event shall <?php echo COMPANY_NAME; ?> or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on <?php echo SITE_NAME; ?>, even if <?php echo COMPANY_NAME; ?> or an authorized representative has been notified orally or in writing of the possibility of such damage.</p>

            <h2 class="mb-lg mt-xl">5. Accuracy of Materials</h2>
            <p>The materials appearing on <?php echo SITE_NAME; ?> could include technical, typographical, or photographic errors. <?php echo COMPANY_NAME; ?> does not warrant that any of the materials on the website are accurate, complete, or current. <?php echo COMPANY_NAME; ?> may make changes to the materials contained on the website at any time without notice.</p>

            <h2 class="mb-lg mt-xl">6. Links</h2>
            <p><?php echo COMPANY_NAME; ?> has not reviewed all of the sites linked to its website and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by <?php echo COMPANY_NAME; ?> of the site. Use of any such linked website is at the user's own risk.</p>

            <h2 class="mb-lg mt-xl">7. Modifications</h2>
            <p><?php echo COMPANY_NAME; ?> may revise these terms of use for the website at any time without notice. By using this website, you are agreeing to be bound by the then current version of these terms of use.</p>

            <h2 class="mb-lg mt-xl">8. Governing Law</h2>
            <p>These terms and conditions are governed by and construed in accordance with the laws of India, and you irrevocably submit to the exclusive jurisdiction of the courts in Agra, Uttar Pradesh.</p>

            <h2 class="mb-lg mt-xl">9. Virtual Coins</h2>
            <p>Virtual coins used on <?php echo SITE_NAME; ?> have no real-world value and cannot be exchanged for real money, prizes, or any other items of value. All virtual coins are provided for entertainment purposes only.</p>

            <h2 class="mb-lg mt-xl">10. User Conduct</h2>
            <p>Users agree not to:</p>
            <ul class="mb-lg">
                <li>Use the website for any illegal purpose or in violation of any applicable laws</li>
                <li>Harass, abuse, or threaten other users</li>
                <li>Attempt to gain unauthorized access to the website or its systems</li>
                <li>Use automated tools or bots to access the website</li>
                <li>Engage in any form of cheating or manipulation of games</li>
            </ul>

            <h2 class="mb-lg">11. Age Requirement</h2>
            <p>You must be at least 18 years of age to use this website and play our games. By using this website, you represent and warrant that you are at least 18 years of age.</p>

            <h2 class="mb-lg mt-xl">12. Contact Information</h2>
            <p>If you have any questions about these Terms of Use, please contact us at:</p>
            <p>
                <strong><?php echo COMPANY_NAME; ?></strong><br>
                Email: <a href="mailto:<?php echo COMPANY_EMAIL; ?>"><?php echo COMPANY_EMAIL; ?></a><br>
                Address: <?php echo COMPANY_ADDRESS; ?>
            </p>
        </div>
    </div>
</section>

<style>
.terms-header {
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
