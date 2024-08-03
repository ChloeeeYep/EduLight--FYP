//additonal nav
document.addEventListener('DOMContentLoaded', function() {
    // Function to remove active classes from all nav links
    function removeActiveClasses(navLinks) {
      navLinks.forEach(function(link) {
        link.classList.remove('active');
      });
    }
  
    // Function to set active class on current type link
    function setActiveClassOnCurrentType(navLinks, currentType) {
      navLinks.forEach(function(link) {
        if (link.textContent.trim().toLowerCase() === currentType.toLowerCase()) {
          link.classList.add('active');
        }
      });
    }
  
    // Get all additional nav links
    var navLinks = document.querySelectorAll('.additional-nav-list a');
  
    // Event listener for nav link click
    navLinks.forEach(function(link) {
      link.addEventListener('click', function(event) {
        // Prevent default anchor click behavior
        event.preventDefault();
        
        // Get the type from the clicked link's text
        var type = this.textContent.trim().toUpperCase();
  
        // Update the URL and reload the page to fetch content for the new type
        window.location.href = '/userquiz/' + encodeURIComponent(type);
      });
    });
  
    // Get the current path from the URL, to highlight the correct tab
    var currentPath = window.location.pathname.split('/').pop();
  
    // Remove 'active' class from all links and then set it on the current type
    removeActiveClasses(navLinks);
    setActiveClassOnCurrentType(navLinks, currentPath);
  });





//quiz
let currentQuestion = 1;
let score = 0;
const totalQuestions = document.querySelectorAll('.question-container').length;
let timerInterval;
let timePassed = 0; // Global variable to track the time passed since the quiz started

// Function to format time in minutes:seconds
function formatTime(time) {
    const minutes = Math.floor(time / 60);
    const seconds = time % 60;
    return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
}

function startTimer() {
    const timeElement = document.getElementById("time");
    timerInterval = setInterval(() => {
        timePassed++;
        timeElement.textContent = formatTime(timePassed);
    }, 1000);
}

function checkAnswer(correctAnswer, questionNumber, selectedButton) {
    const notificationId = `notification${questionNumber}`;
    const notificationElement = document.getElementById(notificationId);
    const buttons = document.querySelectorAll(`#question${questionNumber} .options button`);

    // Disable all buttons and reset their appearance
    buttons.forEach(button => {
        button.disabled = true;
        button.classList.remove('correct', 'incorrect');
        button.textContent  = button.textContent; // Reset button text
    });

    // Check if the selected answer is correct
    if (selectedButton.textContent.trim() === correctAnswer) {
        score++;
        notificationElement.textContent = "Correct!";
        selectedButton.classList.add('correct');
        selectedButton.innerHTML += ' <i class="fas fa-check"></i>';
    } else {
        notificationElement.textContent = `Wrong! The correct answer is: ${correctAnswer}.`;
        selectedButton.classList.add('incorrect');
        selectedButton.innerHTML += ' <i class="fas fa-times"></i>';

        // Highlight the correct button
        const correctButton = Array.from(buttons).find(button => button.textContent.trim() === correctAnswer);
        correctButton.classList.add('correct');
        correctButton.innerHTML += ' <i class="fas fa-check correct-icon"></i>';
    }

    // If this is the last question, stop the timer and show the "Finish" button
    if (currentQuestion === totalQuestions) {
        clearInterval(timerInterval); // Stop the timer
        const submitBtn = document.getElementById('submit-btn');
        submitBtn.textContent = 'Finish';
        submitBtn.style.display = 'block';
    } else {
        // It's not the last question, just show the "Next" button
        document.getElementById('submit-btn').style.display = 'block';
    }
}



function endQuiz() {
    clearInterval(timerInterval); // Stop the timer when the quiz ends
    const finalScoreElement = document.getElementById("final-score");
    const totalQuestionsElement = document.getElementById("total-questions");
    const finalTimeElement = document.getElementById("final-time");
    
    finalScoreElement.textContent = score;
    totalQuestionsElement.textContent = totalQuestions;
    finalTimeElement.textContent = formatTime(timePassed);

    const finalNotification = document.getElementById("final-notification");
    finalNotification.style.display = "block";

    document.getElementById('submit-btn').style.display = 'none';
    document.querySelector('.question-container.active').style.display = 'none';
    document.getElementById('timer').style.display = 'none';
    document.getElementById('time-line-container').style.display = 'none';
    document.getElementById('question-progress-container').style.display = 'none';
}


function showQuestion(questionNumber) {
    document.querySelector('.question-container.active').classList.remove('active');
    document.getElementById(`question${questionNumber}`).classList.add('active');
    updateProgressBar(questionNumber);
    updateCurrentQuestionNumber(questionNumber);
}

function updateProgressBar(questionNumber) {
    const progressPercentage = (questionNumber / totalQuestions) * 100;
    const timeLine = document.getElementById("time-line");
    timeLine.style.width = `${progressPercentage}%`;
}

function disableCurrentQuestionButtons() {
    const buttons = document.querySelectorAll(`#question${currentQuestion} .options button`);
    buttons.forEach(button => {
        button.disabled = true;
    });
}

function moveToNextQuestion() {
    // Disable options for the current question to prevent changing the answer
    disableCurrentQuestionButtons();

    // Hide the "Next"/"Finish" button until the next question is answered
    const submitBtn = document.getElementById('submit-btn');
    submitBtn.style.display = 'none';

    // If it's the last question, call `endQuiz` otherwise show the next question
    if (currentQuestion === totalQuestions) {
        endQuiz();
    } else {
        currentQuestion++;
        showQuestion(currentQuestion);
    }
}


function updateCurrentQuestionNumber(questionNumber) {
    const currentQuestionNumberElement = document.getElementById('current-question-number');
    currentQuestionNumberElement.textContent = questionNumber;
}

function resetQuiz() {
    location.reload();
  }
  


document.addEventListener('DOMContentLoaded', () => {
    showQuestion(1); // Show the first question
    startTimer(); // Start the timer only once when the quiz begins
    document.getElementById('submit-btn').addEventListener('click', moveToNextQuestion);
    updateCurrentQuestionNumber(1);
});
