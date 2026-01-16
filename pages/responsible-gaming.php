<?php
/**
 * GameSense Fantasy - Responsible Gaming Page
 */

require_once '../config/config.php';

$page_title = "Responsible Gaming";
$page_description = "Learn about responsible gaming practices and resources available on GameSense Fantasy.";

include '../includes/header.php';
?>

<section class="responsible-header text-center mb-2xl animate-fadeIn">
    <div class="container">
        <h1>Responsible Gaming</h1>
        <p class="text-lg">Your Well-being is Our Priority</p>
    </div>
</section>

<section class="responsible-content">
    <div class="container">
        <div class="card p-2xl mb-2xl alert alert-info">
            <h2 class="text-gold mb-lg">💡 Gaming Should Be Fun</h2>
            <p><?php echo SITE_NAME; ?> is designed for entertainment purposes only. We are committed to promoting responsible gaming practices and ensuring that all players enjoy our platform safely and responsibly.</p>
        </div>

        <div class="card p-2xl mb-2xl">
            <h2 class="mb-lg">1. What is Responsible Gaming?</h2>
            <p>Responsible gaming means playing for entertainment while maintaining control over your gaming habits. It involves:</p>
            <ul class="mb-lg">
                <li>Playing for fun, not as a way to earn money</li>
                <li>Setting limits on time and virtual coins spent</li>
                <li>Never gambling with money you cannot afford to lose</li>
                <li>Recognizing warning signs of problem gaming</li>
                <li>Seeking help if gaming becomes problematic</li>
            </ul>

            <h2 class="mb-lg mt-xl">2. Gaming Guidelines</h2>
            <p>Follow these guidelines for a safe and enjoyable gaming experience:</p>
            <ul class="mb-lg">
                <li><strong>Set Time Limits:</strong> Decide how long you will play before starting</li>
                <li><strong>Take Breaks:</strong> Take regular breaks during gaming sessions</li>
                <li><strong>Never Chase Losses:</strong> Accept losses and move on</li>
                <li><strong>No Real Money:</strong> Never spend real money on virtual coins</li>
                <li><strong>Balance Gaming:</strong> Maintain balance with other activities</li>
                <li><strong>Play Sober:</strong> Never play under the influence of alcohol or drugs</li>
                <li><strong>Protect Privacy:</strong> Never share your account details with others</li>
            </ul>

            <h2 class="mb-lg mt-xl">3. Warning Signs</h2>
            <p>Be aware of these warning signs that gaming may be becoming problematic:</p>
            <ul class="mb-lg">
                <li>Spending more time gaming than intended</li>
                <li>Thinking about gaming constantly</li>
                <li>Neglecting work, school, or relationships</li>
                <li>Feeling anxious or irritable when not gaming</li>
                <li>Lying about gaming habits to family or friends</li>
                <li>Using gaming to escape problems or negative emotions</li>
                <li>Experiencing financial problems due to gaming</li>
                <li>Failed attempts to reduce gaming</li>
            </ul>

            <h2 class="mb-lg mt-xl">4. Self-Exclusion</h2>
            <p>If you feel that gaming is becoming problematic, you can request self-exclusion by contacting us at:</p>
            <p>
                Email: <a href="mailto:<?php echo COMPANY_EMAIL; ?>"><?php echo COMPANY_EMAIL; ?></a>
            </p>
            <p>Upon request, we will temporarily or permanently restrict your access to the platform.</p>

            <h2 class="mb-lg mt-xl">5. Setting Limits</h2>
            <p>You can set personal limits to help manage your gaming:</p>
            <ul class="mb-lg">
                <li><strong>Daily Time Limit:</strong> Set a maximum time you will play per day</li>
                <li><strong>Weekly Time Limit:</strong> Set a maximum time you will play per week</li>
                <li><strong>Session Limit:</strong> Take breaks after a certain period</li>
                <li><strong>Virtual Coin Limit:</strong> Set a limit on coins you will use</li>
            </ul>

            <h2 class="mb-lg mt-xl">6. For Parents & Guardians</h2>
            <p>If you are a parent or guardian concerned about a young person's gaming:</p>
            <ul class="mb-lg">
                <li>Monitor their gaming activity</li>
                <li>Set clear rules about gaming time</li>
                <li>Encourage other activities and hobbies</li>
                <li>Communicate openly about gaming</li>
                <li>Seek professional help if concerned</li>
            </ul>

            <h2 class="mb-lg mt-xl">7. Resources & Support</h2>
            <p>If you or someone you know is struggling with gaming habits, help is available:</p>
            <ul class="mb-lg">
                <li><strong>National Council for Problem Gambling:</strong> Professional support and counseling</li>
                <li><strong>Gamblers Anonymous:</strong> Peer support groups</li>
                <li><strong>Mental Health Services:</strong> Professional mental health support</li>
                <li><strong>Family Counseling:</strong> Support for family members</li>
            </ul>

            <h2 class="mb-lg mt-xl">8. Our Commitment</h2>
            <p><?php echo SITE_NAME; ?> is committed to:</p>
            <ul class="mb-lg">
                <li>Providing accurate information about responsible gaming</li>
                <li>Making responsible gaming resources easily accessible</li>
                <li>Implementing tools to help players manage their gaming</li>
                <li>Training staff on responsible gaming practices</li>
                <li>Cooperating with responsible gaming organizations</li>
                <li>Continuously improving our responsible gaming initiatives</li>
            </ul>

            <h2 class="mb-lg mt-xl">9. Age Verification</h2>
            <p>We are committed to protecting minors:</p>
            <ul class="mb-lg">
                <li>Our platform is for users 18 years and above only</li>
                <li>We do not knowingly allow minors to access our games</li>
                <li>If we discover a minor using our platform, we will take immediate action</li>
                <li>Parents can report suspected underage gaming</li>
            </ul>

            <h2 class="mb-lg mt-xl">10. Frequently Asked Questions</h2>
            <p><strong>Q: Is GameSense Fantasy gambling?</strong><br>
            A: No. Since there is no real money involved and virtual coins have no monetary value, it is classified as social gaming, not gambling.</p>
            
            <p><strong>Q: Can I win real money?</strong><br>
            A: No. Virtual coins cannot be exchanged for real money or prizes.</p>
            
            <p><strong>Q: What should I do if I think I have a problem?</strong><br>
            A: Contact us immediately at <?php echo COMPANY_EMAIL; ?> or seek professional help from the resources listed above.</p>

            <h2 class="mb-lg mt-xl">11. Contact & Support</h2>
            <p>For any questions or concerns about responsible gaming, please contact us:</p>
            <p>
                <strong><?php echo COMPANY_NAME; ?></strong><br>
                Email: <a href="mailto:<?php echo COMPANY_EMAIL; ?>"><?php echo COMPANY_EMAIL; ?></a><br>
                Address: <?php echo COMPANY_ADDRESS; ?>
            </p>
        </div>

        <div class="alert alert-warning text-center">
            <p><strong>Remember:</strong> Gaming should be fun. If it stops being fun, it's time to take a break or seek help.</p>
        </div>
    </div>
</section>

<style>
.responsible-header {
    padding: 60px 0;
    background: linear-gradient(to bottom, rgba(249, 115, 22, 0.05), transparent);
}

ul {
    list-style-position: inside;
    padding-left: 20px;
}

ul li {
    margin-bottom: 10px;
}

p {
    margin-bottom: 15px;
}
</style>

<?php include '../includes/footer.php'; ?>
