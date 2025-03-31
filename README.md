# career_quiz_plugins
# Career Quiz Plugin

## Description
The **Career Quiz Plugin** is a simple WordPress plugin that allows users to take a quiz and receive career recommendations based on their answers.

## Features
- Customizable quiz questions through the WordPress admin panel.
- Dynamic question rendering using JavaScript.
- Instant career recommendations based on user responses.
- Shortcode `[career_quiz]` for easy embedding on any page or post.

## Installation
1. Download or clone the plugin files into the `wp-content/plugins/career-quiz` directory.
2. Navigate to the WordPress admin panel and go to **Plugins**.
3. Find "Career Quiz Plugin" and click **Activate**.

## Usage
1. Go to **Career Quiz Settings** in the WordPress admin menu.
2. Add quiz questions in JSON format.
3. Use the shortcode `[career_quiz]` on any page or post to display the quiz.

## Configuration
To add questions, navigate to **Career Quiz Settings** and enter JSON data like this:
```json
[
  {
    "question": "What subject do you enjoy the most?",
    "options": [
      { "text": "Mathematics", "score": 5 },
      { "text": "Art", "score": 2 },
      { "text": "Science", "score": 4 }
    ]
  }
]
```

## Troubleshooting
- If the quiz does not appear, ensure the plugin is activated.
- If the page is blank, enable WordPress debugging and check `wp-content/debug.log`.
- If JavaScript issues occur, open the browser console (`F12` → **Console**) to check for errors.

## License
This plugin is licensed under GPL2.

## Author
[Kingsley Ozioko](https://skilllink.infinityfreeapp.com/)

