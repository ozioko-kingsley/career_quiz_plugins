document.addEventListener("DOMContentLoaded", function () {
    let quizContainer = document.getElementById("career-quiz-questions");
    let form = document.getElementById("career-quiz-form");
    let resultContainer = document.getElementById("career-quiz-result");

    // Fetch questions from PHP variable
    let questions = JSON.parse(quizContainer.getAttribute("data-questions"));

    questions.forEach((q, index) => {
        let questionHtml = `<div class='quiz-question'>
                                <p>${q.question}</p>`;
        q.options.forEach((opt, i) => {
            questionHtml += `<label>
                                <input type='radio' name='question${index}' value='${opt.score}'>
                                ${opt.text}
                             </label><br>`;
        });
        questionHtml += `</div>`;
        quizContainer.innerHTML += questionHtml;
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        let totalScore = 0;
        let selectedAnswers = document.querySelectorAll("input[type=radio]:checked");

        if (selectedAnswers.length !== questions.length) {
            resultContainer.innerHTML = `<p style='color:red;'>Please answer all questions.</p>`;
            return;
        }

        selectedAnswers.forEach((input) => {
            totalScore += parseInt(input.value);
        });

        let recommendation = totalScore > 10 ? "Engineering or Data Science" : "Arts or Business";
        resultContainer.innerHTML = `<h3>Recommended Career Path: ${recommendation}</h3>`;
    });

    
});


function career_quiz_shortcode() {
    $questions = get_option('career_quiz_questions', '[]');
    ob_start();
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
    return ob_get_clean();
}
