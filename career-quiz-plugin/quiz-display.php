<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Function to display the quiz
function career_quiz_display() {
    $questions = get_option('career_quiz_questions', '[]');
    $questions = json_decode($questions, true);

    if (empty($questions)) {
        return '<p>No quiz questions available. Please add them in the settings.</p>';
    }

    ob_start();
    ?>
    <div id="career-quiz-container">
        <h2>Career Quiz</h2>
        <form id="career-quiz-form">
            <?php foreach ($questions as $index => $question): ?>
                <div class="quiz-question">
                    <p><?php echo esc_html($question['question']); ?></p>
                    <?php foreach ($question['options'] as $optionIndex => $option): ?>
                        <label>
                            <input type="radio" name="question<?php echo $index; ?>" value="<?php echo esc_attr($option['score']); ?>">
                            <?php echo esc_html($option['text']); ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <button type="submit">Get Recommendation</button>
        </form>
        <div id="career-quiz-result"></div>
    </div>

    <script>
    jQuery(document).ready(function($) {
        $('#career-quiz-form').submit(function(e) {
            e.preventDefault();
            let totalScore = 0;
            $('input[type=radio]:checked').each(function() {
                totalScore += parseInt($(this).val());
            });

            let recommendation = totalScore > 10 ? 'Engineering or Data Science' : 'Arts or Business';
            $('#career-quiz-result').html('<h3>Recommended Career Path: ' + recommendation + '</h3>');
        });
    });
    </script>
    <?php
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('career_quiz', 'career_quiz_display');
?>
