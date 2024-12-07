<template>
  <div class="game-container">
    <h2 class="text-xl font-semibold mb-4">Quiz Game</h2>
    <div v-if="currentQuestion < questions.length">
      <p class="mb-4">{{ questions[currentQuestion].question }}</p>
      <div v-for="(option, index) in questions[currentQuestion].options" :key="index">
        <button @click="checkAnswer(option)" class="btn-option">{{ option }}</button>
      </div>
      <p v-if="feedback" class="mt-4">{{ feedback }}</p>
    </div>
    <div v-else>
      <p class="text-lg font-semibold">Game Over! Your Score: {{ score }}</p>
      <button @click="restartGame" class="btn-restart">Restart Game</button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const allquestions = [
  {
    question: 'Which course covers the basics of Python programming?',
    options: ['Introduction to Python Programming', 'Web Development Bootcamp', 'Data Science with R', 'Machine Learning Algorithms'],
    answer: 'Introduction to Python Programming'
  },
  {
    question: 'Which course focuses on advanced JavaScript concepts?',
    options: ['Introduction to Python Programming', 'Advanced JavaScript Programming', 'Web Development Bootcamp', 'Digital Marketing Strategies'],
    answer: 'Advanced JavaScript Programming'
  },
  {
    question: 'What is the duration of the "Project Management Fundamentals" course?',
    options: ['30 hours', '40 hours', '50 hours', '60 hours'],
    answer: '30 hours'
  },
  {
    question: 'Which course includes learning about digital marketing strategies?',
    options: ['Digital Marketing Strategies', 'Data Science with R', 'Creative Writing Workshop', 'Cybersecurity Basics'],
    answer: 'Digital Marketing Strategies'
  },
  {
    question: 'What level is the "Introduction to Artificial Intelligence" course?',
    options: ['Beginner', 'Intermediate', 'Advanced', 'Expert'],
    answer: 'Intermediate'
  },
  {
    question: 'Which course provides an overview of key events and periods in world history?',
    options: ['World History Overview', 'Philosophy and Critical Thinking', 'Introduction to Chemistry', 'Engineering Mechanics'],
    answer: 'World History Overview'
  },
  {
    question: 'What is the primary focus of the "Cybersecurity Basics" course?',
    options: ['Data Analysis', 'Digital Marketing', 'Cybersecurity Principles', 'Graphic Design'],
    answer: 'Cybersecurity Principles'
  },
  {
    question: 'Which course is targeted at learning the fundamentals of graphic design?',
    options: ['Graphic Design Essentials', 'Introduction to Python Programming', 'Video Production Techniques', 'Personal Finance Planning'],
    answer: 'Graphic Design Essentials'
  },
  {
    question: 'How long is the "Digital Photography Techniques" course?',
    options: ['30 hours', '40 hours', '50 hours', '55 hours'],
    answer: '55 hours'
  },
  {
    question: 'Which course includes learning about leadership and management skills?',
    options: ['Leadership and Management Skills', 'Principles of Physics', 'Financial Accounting Basics', 'Time Management and Productivity'],
    answer: 'Leadership and Management Skills'
  },
  {
    question: 'Which course covers the basics of data science using R?',
    options: ['Introduction to Python Programming', 'Data Science with R', 'Introduction to Chemistry', 'Machine Learning Algorithms'],
    answer: 'Data Science with R'
  },
  {
    question: 'What is the duration of the "Introduction to Psychology" course?',
    options: ['30 hours', '40 hours', '45 hours', '50 hours'],
    answer: '40 hours'
  },
  {
    question: 'Which course is focused on understanding the principles of project management?',
    options: ['Project Management Fundamentals', 'Data Science with R', 'Introduction to Artificial Intelligence', 'User Experience Design'],
    answer: 'Project Management Fundamentals'
  },
  {
    question: 'What level is the "Digital Marketing Strategies" course?',
    options: ['Beginner', 'Intermediate', 'Advanced', 'Expert'],
    answer: 'Intermediate'
  },
  {
    question: 'Which course teaches about the fundamentals of photography techniques?',
    options: ['Photography for Beginners', 'Creative Writing Workshop', 'Introduction to Python Programming', 'Leadership and Management Skills'],
    answer: 'Photography for Beginners'
  },
  {
    question: 'How many hours does the "Environmental Science Basics" course last?',
    options: ['30 hours', '40 hours', '50 hours', '55 hours'],
    answer: '50 hours'
  },
  {
    question: 'Which course focuses on advanced concepts in machine learning?',
    options: ['Machine Learning Algorithms', 'Introduction to Artificial Intelligence', 'Data Science with R', 'Project Management Fundamentals'],
    answer: 'Machine Learning Algorithms'
  },
  {
    question: 'What is the primary focus of the "Time Management and Productivity" course?',
    options: ['Managing Time and Productivity', 'Learning to Code', 'Designing Graphics', 'Understanding Chemistry'],
    answer: 'Managing Time and Productivity'
  },
  {
    question: 'Which course is a bootcamp covering web development essentials?',
    options: ['Web Development Bootcamp', 'Introduction to Chemistry', 'Sociology: Understanding Society', 'Financial Accounting Basics'],
    answer: 'Web Development Bootcamp'
  },
  {
    question: 'What level is the "Data Analysis with Python" course?',
    options: ['Beginner', 'Intermediate', 'Advanced', 'Expert'],
    answer: 'Intermediate'
  },
  {
    question: 'Which course focuses on the principles of physics?',
    options: ['Principles of Physics', 'Digital Marketing Strategies', 'Machine Learning Algorithms', 'Cybersecurity Basics'],
    answer: 'Principles of Physics'
  },
  {
    question: 'What is the main topic of the "Creative Writing Workshop" course?',
    options: ['Creative Writing Skills', 'Web Development', 'Data Science', 'Video Production'],
    answer: 'Creative Writing Skills'
  },
  {
    question: 'Which course provides an overview of basic psychological concepts?',
    options: ['Introduction to Psychology', 'Engineering Mechanics', 'Digital Marketing Strategies', 'Introduction to Chemistry'],
    answer: 'Introduction to Psychology'
  },
  {
    question: 'How long is the "Introduction to Chemistry" course?',
    options: ['30 hours', '40 hours', '45 hours', '50 hours'],
    answer: '45 hours'
  },
  {
    question: 'Which course teaches the fundamentals of artificial intelligence?',
    options: ['Introduction to Artificial Intelligence', 'Digital Marketing Strategies', 'Leadership and Management Skills', 'Graphic Design Essentials'],
    answer: 'Introduction to Artificial Intelligence'
  },
  {
    question: 'What is the primary focus of the "User Experience Design" course?',
    options: ['UX Design Principles', 'Public Speaking', 'Photography Techniques', 'Machine Learning Algorithms'],
    answer: 'UX Design Principles'
  },
  {
    question: 'Which course provides an overview of environmental science concepts?',
    options: ['Environmental Science Basics', 'Public Speaking and Communication', 'Philosophy and Critical Thinking', 'Introduction to Chemistry'],
    answer: 'Environmental Science Basics'
  },
  {
    question: 'What is the duration of the "Sociology: Understanding Society" course?',
    options: ['30 hours', '40 hours', '45 hours', '50 hours'],
    answer: '45 hours'
  },
  {
    question: 'Which course is about mastering video production techniques?',
    options: ['Video Production Techniques', 'Creative Writing Workshop', 'Digital Photography Techniques', 'Data Science with R'],
    answer: 'Video Production Techniques'
  },
  {
    question: 'What is the level of the "Principles of Physics" course?',
    options: ['Beginner', 'Intermediate', 'Advanced', 'Expert'],
    answer: 'Beginner'
  },
  {
    question: 'Which course is designed to enhance digital photography skills?',
    options: ['Digital Photography Techniques', 'Graphic Design Essentials', 'Machine Learning Algorithms', 'Public Speaking and Communication'],
    answer: 'Digital Photography Techniques'
  },
  {
    question: 'What is the duration of the "Introduction to Artificial Intelligence" course?',
    options: ['30 hours', '40 hours', '50 hours', '60 hours'],
    answer: '60 hours'
  },
  {
    question: 'Which course covers the basics of financial accounting?',
    options: ['Financial Accounting Basics', 'Introduction to Chemistry', 'Principles of Physics', 'Leadership and Management Skills'],
    answer: 'Financial Accounting Basics'
  },
  {
    question: 'What level is the "Graphic Design Essentials" course?',
    options: ['Beginner', 'Intermediate', 'Advanced', 'Expert'],
    answer: 'Beginner'
  },
  {
    question: 'Which course helps to improve public speaking and communication skills?',
    options: ['Public Speaking and Communication', 'Video Production Techniques', 'Introduction to Python Programming', 'Creative Writing Workshop'],
    answer: 'Public Speaking and Communication'
  },
  {
    question: 'How long is the "Machine Learning Algorithms" course?',
    options: ['30 hours', '40 hours', '45 hours', '50 hours'],
    answer: '45 hours'
  },
  {
    question: 'Which course focuses on understanding societal structures?',
    options: ['Sociology: Understanding Society', 'Digital Marketing Strategies', 'Data Science with R', 'Introduction to Chemistry'],
    answer: 'Sociology: Understanding Society'
  },
  {
    question: 'What is the main topic of the "Introduction to Psychology" course?',
    options: ['Basic Psychological Concepts', 'Graphic Design', 'Public Speaking', 'Time Management'],
    answer: 'Basic Psychological Concepts'
  },
  {
    question: 'Which course provides an overview of the fundamentals of machine learning?',
    options: ['Machine Learning Algorithms', 'Data Science with R', 'Introduction to Artificial Intelligence', 'Principles of Physics'],
    answer: 'Machine Learning Algorithms'
  },
  {
    question: 'What level is the "Leadership and Management Skills" course?',
    options: ['Beginner', 'Intermediate', 'Advanced', 'Expert'],
    answer: 'Intermediate'
  },
  {
    question: 'Which course is focused on learning time management and productivity strategies?',
    options: ['Time Management and Productivity', 'Financial Accounting Basics', 'Project Management Fundamentals', 'Introduction to Chemistry'],
    answer: 'Time Management and Productivity'
  },
  {
    question: 'What is the duration of the "Introduction to Python Programming" course?',
    options: ['30 hours', '40 hours', '45 hours', '50 hours'],
    answer: '40 hours'
  },
  {
    question: 'Which course covers advanced JavaScript programming techniques?',
    options: ['Advanced JavaScript Programming', 'Data Science with R', 'Introduction to Artificial Intelligence', 'Project Management Fundamentals'],
    answer: 'Advanced JavaScript Programming'
  },
  {
    question: 'What is the primary focus of the "Introduction to Chemistry" course?',
    options: ['Chemistry Concepts', 'Financial Accounting Basics', 'Leadership Skills', 'Digital Photography'],
    answer: 'Chemistry Concepts'
  },
  {
    question: 'Which course is designed to help with personal finance planning?',
    options: ['Personal Finance Planning', 'Leadership and Management Skills', 'Video Production Techniques', 'User Experience Design'],
    answer: 'Personal Finance Planning'
  },
  {
    question: 'What is the duration of the "Philosophy and Critical Thinking" course?',
    options: ['30 hours', '40 hours', '50 hours', '55 hours'],
    answer: '55 hours'
  },
  {
    question: 'Which course is about learning to manage stress and practice mindfulness?',
    options: ['Mindfulness and Stress Management', 'Cybersecurity Basics', 'Data Analysis with Python', 'Creative Writing Workshop'],
    answer: 'Mindfulness and Stress Management'
  },
  {
    question: 'What level is the "Digital Photography Techniques" course?',
    options: ['Beginner', 'Intermediate', 'Advanced', 'Expert'],
    answer: 'Intermediate'
  },
  {
    question: 'Which course is about understanding the principles of environmental science?',
    options: ['Environmental Science Basics', 'Introduction to Python Programming', 'Introduction to Artificial Intelligence', 'Creative Writing Workshop'],
    answer: 'Environmental Science Basics'
  },
  {
    question: 'What is the duration of the "Public Speaking and Communication" course?',
    options: ['30 hours', '40 hours', '45 hours', '50 hours'],
    answer: '30 hours'
  },
  {
    question: 'Which course focuses on mastering video production techniques?',
    options: ['Video Production Techniques', 'Data Science with R', 'Introduction to Psychology', 'Leadership and Management Skills'],
    answer: 'Video Production Techniques'
  },
  {
    question: 'What is the primary focus of the "Creative Writing Workshop" course?',
    options: ['Creative Writing Skills', 'Digital Photography', 'Introduction to Python Programming', 'Principles of Physics'],
    answer: 'Creative Writing Skills'
  },
  {
    question: 'Which course covers understanding societal structures?',
    options: ['Sociology: Understanding Society', 'Introduction to Chemistry', 'Project Management Fundamentals', 'Web Development Bootcamp'],
    answer: 'Sociology: Understanding Society'
  },
  {
    question: 'What is the duration of the "Introduction to Artificial Intelligence" course?',
    options: ['40 hours', '50 hours', '60 hours', '70 hours'],
    answer: '60 hours'
  },
  {
    question: 'Which course is about understanding project management principles?',
    options: ['Project Management Fundamentals', 'Cybersecurity Basics', 'Introduction to Python Programming', 'Principles of Physics'],
    answer: 'Project Management Fundamentals'
  },
  {
    question: 'What level is the "Data Science with R" course?',
    options: ['Beginner', 'Intermediate', 'Advanced', 'Expert'],
    answer: 'Intermediate'
  },
  {
    question: 'Which course focuses on learning advanced techniques in digital photography?',
    options: ['Digital Photography Techniques', 'Creative Writing Workshop', 'Introduction to Chemistry', 'Machine Learning Algorithms'],
    answer: 'Digital Photography Techniques'
  },
  {
    question: 'What is the duration of the "Mindfulness and Stress Management" course?',
    options: ['25 hours', '35 hours', '45 hours', '50 hours'],
    answer: '35 hours'
  },
{
    question: 'Which course is about the basics of user experience design?',
    options: ['User Experience Design', 'Principles of Physics', 'Introduction to Artificial Intelligence', 'Video Production Techniques'],
    answer: 'User Experience Design'
  },
  {
    question: 'What is the main focus of the "Introduction to Python Programming" course?',
    options: ['Python Basics', 'Web Development', 'Graphic Design', 'Digital Marketing'],
    answer: 'Python Basics'
  }
];

const questions = ref([]);
const currentQuestion = ref(0);
const score = ref(0);
const feedback = ref('');

const getRandomQuestions = () => {
  const shuffled = [...allquestions].sort(() => 0.5 - Math.random());
  return shuffled.slice(0, 5); // Select 5 random questions
};

const startGame = () => {
  questions.value = getRandomQuestions();
  currentQuestion.value = 0;
  score.value = 0;
  feedback.value = '';
};

const checkAnswer = (answer) => {
  if (answer === questions.value[currentQuestion.value].answer) {
    feedback.value = 'Correct!';
    score.value += 1;
  } else {
    feedback.value = 'Incorrect!';
  }
  currentQuestion.value += 1;
  if (currentQuestion.value >= questions.value.length) {
    feedback.value = `Game Over! Your Score: ${score.value}`;
  }
};

const restartGame = () => {
  startGame();
};

// Initialize game
startGame();
</script>

<style scoped>
.game-container {
  padding: 16px;
  background-color:rgb(17 24 39 / var(--tw-bg-opacity, 1));
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-option {
  background-color: #4a5568;
  color: #fff;
  border: none;
  padding: 8px 16px;
  margin: 4px;
  border-radius: 4px;
  cursor: pointer;
}

.btn-option:hover {
  background-color: #2d3748;
}

.btn-restart {
  background-color: #3182ce;
  color: #fff;
  border: none;
  padding: 8px 16px;
  margin-top: 16px;
  border-radius: 4px;
  cursor: pointer;
}

.btn-restart:hover {
  background-color: #2b6cb0;
}
</style>
