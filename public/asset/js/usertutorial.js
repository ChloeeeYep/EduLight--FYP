//additional-nav
document.addEventListener('DOMContentLoaded', function() {
  // Remove active class from all nav links and set it based on current page
  var navLinks = document.querySelectorAll('.additional-nav-list a');
  removeActiveClasses(navLinks);
  setActiveClassOnCurrentType(navLinks, window.location.pathname.split('/').pop());

    // Ensure this is always set on page load, not just after clicking a specific link
    sessionStorage.setItem('activateFirstSidebarItem', 'true');

    // Existing code to check the sessionStorage and activate the first sidebar item
       if (sessionStorage.getItem('activateFirstSidebarItem') === 'true') {
        activateFirstSidebarItem();
        sessionStorage.removeItem('activateFirstSidebarItem'); // Clear the flag after activating
    }

    // Listen for clicks on the refresh button
    const refreshButton = document.getElementById('refreshButton');
    if (refreshButton) {
      refreshButton.addEventListener('click', function(event) {
        event.preventDefault();
        activateFirstSidebarItem();
      });
    }


  // Attach click event handler to nav links once
  navLinks.forEach(function(link) {
    link.addEventListener('click', function(event) {
      event.preventDefault();
      sessionStorage.setItem('activateFirstSidebarItem', 'true');
      window.location.href = `/usertutorial/${encodeURIComponent(this.textContent.trim().toUpperCase())}`;
    });
  });
  
  // Check if the first sidebar item should be activated
  if (sessionStorage.getItem('activateFirstSidebarItem') === 'true') {
    activateFirstSidebarItem();
    sessionStorage.removeItem('activateFirstSidebarItem');
  }
});

function removeActiveClasses(navLinks) {
  navLinks.forEach(function(link) {
    link.classList.remove('active');
  });
}

function setActiveClassOnCurrentType(navLinks, currentType) {
  navLinks.forEach(function(link) {
    if (link.textContent.trim().toLowerCase() === currentType.toLowerCase()) {
      link.classList.add('active');
    }
  });
}

document.body.addEventListener('click', function(event) {
  var link = event.target.closest('.additional-nav-list a');
  if (link) {
    event.preventDefault();
    var type = link.textContent.trim().toUpperCase();
    sessionStorage.setItem('activateFirstSidebarItem', 'true');
    window.location.href = `/usertutorial/${encodeURIComponent(type)}`;
  }
});



// side-bar
// Function to adjust the height of a single textarea element
function adjustTextareaHeight(textarea) {
  textarea.style.height = 'auto';
  textarea.style.height = textarea.scrollHeight + 'px';
}


// Function to show an article and adjust the height of textareas within it
function showArticle(tutorialId, defaultDisplay = false, clickedElement = null) {
  document.querySelectorAll('.main-content article').forEach(article => {
    article.style.display = 'none';
  });

  document.querySelectorAll('.sidebar-nav a').forEach(link => {
    link.classList.remove('active');
  });

  const selectedArticle = document.getElementById('article-' + tutorialId);
  if (selectedArticle) {
    selectedArticle.style.display = 'block';
    selectedArticle.querySelectorAll('textarea').forEach(adjustTextareaHeight);
    if (clickedElement) {
      clickedElement.classList.add('active');
    }
  } else if (defaultDisplay) {
    const defaultArticle = document.querySelector('.main-content article');
    defaultArticle.style.display = 'block';
    defaultArticle.querySelectorAll('textarea').forEach(adjustTextareaHeight);
    if (clickedElement) {
      clickedElement.classList.add('active');
    }
  }
}

// Activate the first sidebar item based on additional-nav interaction
function activateFirstSidebarItem() {
  const firstSidebarLink = document.querySelector('.sidebar-nav a');
  if (firstSidebarLink) {
    showArticle(firstSidebarLink.getAttribute('data-tutorial-id'), false, firstSidebarLink);
  }
}


const params = new URLSearchParams(window.location.search);
const tutorialId = params.get('id');
if (tutorialId && !isNaN(tutorialId)) {
  showArticle(tutorialId, false, document.querySelector(`.sidebar-nav a[data-tutorial-id="${tutorialId}"]`));
} else {
  showArticle('default', true, document.querySelector('.sidebar-nav a:first-child'));
}

document.querySelectorAll('.sidebar-nav a').forEach(link => {
  link.addEventListener('click', function(event) {
    event.preventDefault();
    const tutorialId = event.currentTarget.getAttribute('data-tutorial-id');
    showArticle(tutorialId, false, event.currentTarget);
  });
});

document.querySelectorAll('.section-text, .example-textarea').forEach(function(textarea) {
  textarea.addEventListener('input', function() {
    adjustTextareaHeight(textarea);
  });
});




//mcq
document.addEventListener('DOMContentLoaded', function() {
  const articles = document.querySelectorAll('.main-content article');

  articles.forEach(article => {
    const options = Array.from(article.querySelectorAll('.option'));
    const feedback = article.querySelector('.feedback');

    // Get the correct answer
    const correctAnswerButton = article.querySelector('.option[data-correct-answer]');
    const correctAnswer = correctAnswerButton.textContent.trim();

    // Fisher-Yates shuffle algorithm
    for (let i = options.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [options[i], options[j]] = [options[j], options[i]];
    }

    // Set click event listener for each option
    options.forEach(option => {
      option.addEventListener('click', function() {
        const selectedOption = this.textContent.trim();

        if (selectedOption === correctAnswer) {
          feedback.textContent = "Correct!";
          feedback.style.color = "green";

          // Hide feedback after a delay
          setTimeout(function() {
            feedback.style.display = "none";
          }, 2000); // Adjust the delay as needed (here it's set to 2 seconds)
        } else {
          feedback.textContent = "Wrong answer. Try again!";
          feedback.style.color = "red";
        }
        feedback.style.display = "block";
      });
    });

    // Append the shuffled options back to the options list
    const optionsList = article.querySelector('.options');
    optionsList.innerHTML = '';
    options.forEach(option => {
      const li = document.createElement('li');
      li.appendChild(option);
      optionsList.appendChild(li);
    });
  });
});