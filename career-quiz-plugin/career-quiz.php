<?php
/**
 * Plugin Name: Career Quiz Plugin
 * Plugin URI: https://github.com/ozioko-kingsley/career_quiz_plugins/blob/main/career-quiz-plugin/career-quiz.php
 * Description: A simple career quiz plugin that recommends career paths based on user responses.
 * Version: 1.0
 * Author: Kingsley Ozioko
 * Author URI: https://skilllink.infinityfreeapp.com/
 * License: GPL2
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue scripts and styles
function career_quiz_enqueue_assets() {
    wp_enqueue_style('career-quiz-style', plugin_dir_url(__FILE__) . 'career-quiz.css');
    wp_enqueue_script('career-quiz-script', plugin_dir_url(__FILE__) . 'js/quiz-script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'career_quiz_enqueue_assets');

// Include admin settings
include_once plugin_dir_path(__FILE__) . 'admin-settings.php';

// Include quiz display
include_once plugin_dir_path(__FILE__) . 'quiz-display.php';

// Shortcode to display the quiz
function career_quiz_shortcode() {
    ob_start();
    ?>
    <div id="career-quiz-container">
        <h2>Career Quiz</h2>
        <form id="career-quiz-form">
            <div id="career-quiz-questions"></div>
            <button type="submit">Get Recommendation</button>
        </form>
        <div id="career-quiz-result"></div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('career_quiz', 'career_quiz_shortcode');

// Admin Menu Setup
function career_quiz_admin_menu() {
    add_menu_page(
        'Career Quiz Settings',
        'Career Quiz',
        'manage_options',
        'career-quiz-settings',
        'career_quiz_settings_page',
        'dashicons-welcome-learn-more',
        20
    );
}
add_action('admin_menu', 'career_quiz_admin_menu');

// Admin Page Content
function career_quiz_settings_page() {
    ?>
    <div class="wrap">
        <h1>Career Quiz Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('career_quiz_options_group');
            do_settings_sections('career-quiz-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register Settings
function career_quiz_register_settings() {
    register_setting('career_quiz_options_group', 'career_quiz_questions');
    add_settings_section('career_quiz_main_section', 'Quiz Questions', null, 'career-quiz-settings');
    add_settings_field('career_quiz_questions_field', 'Enter Questions (JSON format)', 'career_quiz_questions_callback', 'career-quiz-settings', 'career_quiz_main_section');
}
add_action('admin_init', 'career_quiz_register_settings');

// Settings Field Callback
function career_quiz_questions_callback() {
    $questions = get_option('career_quiz_questions', '[]');
    echo '<textarea name="career_quiz_questions" rows="10" cols="50" class="large-text code">' . esc_textarea($questions) . '</textarea>';
}
