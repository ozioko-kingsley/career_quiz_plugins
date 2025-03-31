<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Function to display the career quiz
function career_quiz_display() {
    $questions = get_option('career_quiz_questions', '[]');
    ?>
    <div id="career-quiz-container">
        <h2>Career Quiz</h2>
        <form id="career-quiz-form">
            <div id="career-quiz-questions" data-questions='<?php echo esc_attr($questions); ?>'></div>
            <button type="submit">Get Recommendation</button>
        </form>
        <div id="career-quiz-result"></div>
    </div>
    <?php
}
