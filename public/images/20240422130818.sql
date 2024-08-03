-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 05:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edulight`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `universityId` bigint(20) UNSIGNED NOT NULL,
  `scholarshipId` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nric` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `universityId`, `scholarshipId`, `userId`, `name`, `nric`, `gender`, `birthday`, `email`, `address`, `contact`, `course`, `qualification`, `file`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, 'Ali Baba', '012638347217', 'Male', '2016-07-08', 'Ali@gmail.com', 'No,28,Jalan Ecohill 3/2a, Setia Eco Hill', '0182828236', 'Art History', 'High School', 'user_files/bLSM79bxntEEmBw004G1lZbeOrVVAmzyhqNqFOIk.pdf', 'Reject', '2024-04-21 08:27:57', '2024-04-21 09:37:53'),
(2, 3, 1, 4, 'Abu', '123645623523', 'Male', '1939-04-03', 'szheeyoong2001@gmail.com', 'No,28,Jalan Ecohill 3/2a, Setia Eco Hill', '0182828236', 'Art History', 'Foundation', 'user_files/fNnsUMSIHfYVnLjPQL3gu8190A28Zbmn31x8Y40a.pdf', 'Accept', '2024-04-21 09:02:33', '2024-04-21 09:39:48'),
(3, 3, 2, 1, 'Ali', '123123123122', 'Male', '2024-04-21', 'Ali@gmail.com', 'No,28,Jalan Ecohill 3/2a, Setia Eco Hill', '0182828236', 'Physics', 'Associate Degree', 'user_files/ESWk3nJPvyLwhfUL7uGsUEuYoh6MXTlIaqEBHOlZ.pdf', 'Pending', '2024-04-21 09:13:03', '2024-04-21 09:13:03'),
(4, 3, 1, 1, 'Ali', '016202826332', 'Male', '2024-04-21', 'szheeyoong2001@gmail.com', 'No,28,Jalan Ecohill 3/2a, Setia Eco Hill', '0182828236', 'Physics', 'Associate Degree', 'user_files/ESWk3nJPvyLwhfUL7uGsUEuYoh6MXTlIaqEBHOlZ.pdf', 'Reject', '2024-04-21 10:32:13', '2024-04-21 10:33:00'),
(7, 3, 1, 1, 'Ali', '111111111111', 'Male', '2024-04-21', 'szheeyoong2001@gmail.com', 'No,28,Jalan Ecohill 3/2a, Setia Eco Hill', '0182828236', 'Physics', 'Associate Degree', 'user_files/ESWk3nJPvyLwhfUL7uGsUEuYoh6MXTlIaqEBHOlZ.pdf', 'Reject', '2024-04-21 10:38:37', '2024-04-21 10:39:09');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cartId` bigint(20) UNSIGNED NOT NULL,
  `courseId` varchar(255) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `courseLevel` varchar(255) NOT NULL,
  `coursePrice` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(300) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `instructor` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `lesson` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `learn1` text NOT NULL,
  `learn2` text NOT NULL,
  `learn3` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `photo`, `price`, `duration`, `instructor`, `level`, `type`, `lesson`, `language`, `learn1`, `learn2`, `learn3`, `created_at`, `updated_at`) VALUES
(1, 'Managing Happiness', 'What is happiness? What makes you happy?’ Can you get happier through study and effort?\r\n\r\nMaybe you have pondered these questions over the course of your life, but haven’t been able to come up with any definitive answers. Still, you’d like to think that happiness is something you can understand and manage, right? \r\n\r\nThis is a class that answers these questions and shows you how you can use the answers to build a happier life. It introduces you to the modern science of human well-being and shows you how to practice it. Unlike other happiness courses, Managing Happiness goes a step further and demonstrates how you can share the ideas with others, thus bringing more happiness and love to the world and supercharging your own well-being efforts. \r\n\r\nLed by Harvard professor, author, social scientist, and former classical musician Arthur Brooks, this course will introduce cutting-edge survey tools, the best research, and trends in social science, positive psychology, neuroscience, and philosophy to help learners unlock the strategies to create a more purposeful life, full of long-lasting enjoyment and satisfaction. Managing Happiness uses philosophical and technical insights to challenge your assumptions about happiness — helping you break bad habits that hold you back and build good ones you can use for the rest of your life. \r\n\r\nHappiness is a core competency for those that want to be in charge of their lives — both personally and professionally. The concepts learned in this course will lead to enduring improvements and lifelong learning. At the end of the course, you will take away key concepts and actionable insights to apply to your daily routines. People around you will notice the difference.\r\n\r\nStart getting happier today, with Managing Happiness.', '20240421135739.jpg', 200.00, '9', '1', 'INTERMEDIATE', 'Self-Control', '6', 'ENGLISH', 'Explore diverse definitions of happiness and understand its function in everyday life', 'Apply the science of the mind, body, psychology, and community to manage emotions and behaviors for greater happiness', 'Learn how genetic, social, and economic influences impact your happiness', '2024-04-21 05:57:39', '2024-04-21 06:17:41'),
(2, 'Introduction to Programming with Python', 'An introduction to programming using a language called Python. Learn how to read and write code as well as how to test and \"debug\" it. Designed for students with or without prior programming experience who\'d like to learn Python specifically. Learn about functions, arguments, and return values (oh my!); variables and types; conditionals and Boolean expressions; and loops. Learn how to handle exceptions, find and fix bugs, and write unit tests; use third-party libraries; validate and extract data with regular expressions; model real-world entities with classes, objects, methods, and properties; and read and write files. Hands-on opportunities for lots of practice. Exercises inspired by real-world programming problems. No software required except for a web browser, or you can write code on your own PC or Mac.\r\n\r\nWhereas CS50x itself focuses on computer science more generally as well as programming with C, Python, SQL, and JavaScript, this course, aka CS50P, is entirely focused on programming with Python. You can take CS50P before CS50x, during CS50x, or after CS50x. But for an introduction to computer science itself, you should still take CS50x!', '20240421140038.jpg', 100.00, '10', '2', 'ADVANCED', 'Coding', '10', 'ENGLISH', 'Functions, Variables', 'Conditionals', 'File I/O', '2024-04-21 06:00:38', '2024-04-21 06:23:54'),
(3, 'Web Programming with Python and JavaScript', 'Topics include database design, scalability, security, and user experience. Through hands-on projects, you\'ll learn to write and use APIs, create interactive UIs, and leverage cloud services like GitHub and Heroku. By course\'s end, you\'ll emerge with knowledge and experience in principles, languages, and tools that empower you to design and deploy applications on the Internet.', '20240421140817.jpg', 150.00, '5', '2', 'BEGINNER', 'Coding', '5', 'ENGLISH', 'HTML, CSS, JavaScript', 'SQL, Models, and Migrations', 'Scalability and Security', '2024-04-21 06:08:17', '2024-04-21 06:24:05'),
(4, 'Introduction to Cybersecurity', 'This is CS50\'s introduction to cybersecurity for technical and non-technical audiences alike. Learn how to protect your own data, devices, and systems from today\'s threats and how to recognize and evaluate tomorrow\'s as well, both at home and at work. Learn to view cybersecurity not in absolute terms but relative, a function of risks and rewards (for an adversary) and costs and benefits (for you). Learn to recognize cybersecurity as a trade-off with usability itself. Course presents both high-level and low-level examples of threats, providing students with all they need know technically to understand both. Assignments inspired by real-world events.', '20240421141838.jpg', 200.00, '2', '3', 'INTERMEDIATE', 'Cybersecurity', '2', 'CHINESE', 'brute-force attacks, dictionary attacks biometrics multi-factor authentication, password managers', 'hacking, cracking social engineering, phishing attacks passcodes, passwords, SSO', 'viruses, worms, botnets SQL injection attacks port-scanning', '2024-04-21 06:18:38', '2024-04-21 06:24:16'),
(5, 'Introduction to Data Science with Python', 'Every single minute, computers across the world collect millions of gigabytes of data. What can you do to make sense of this mountain of data? How do data scientists use this data for the applications that power our modern world?\r\n\r\nData science is an ever-evolving field, using algorithms and scientific methods to parse complex data sets. Data scientists use a range of programming languages, such as Python and R, to harness and analyze data. This course focuses on using Python in data science. By the end of the course, you’ll have a fundamental understanding of machine learning models and basic concepts around Machine Learning (ML) and Artificial Intelligence (AI).\r\n\r\nUsing Python, learners will study regression models (Linear, Multilinear, and Polynomial) and classification models (kNN, Logistic), utilizing popular libraries such as sklearn, Pandas, matplotlib, and numPy. The course will cover key concepts of machine learning such as: picking the right complexity, preventing overfitting, regularization, assessing uncertainty, weighing trade-offs, and model evaluation. Participation in this course will build your confidence in using Python, preparing you for more advanced study in Machine Learning (ML) and Artificial Intelligence (AI), and advancement in your career.\r\n\r\nLearners must have a minimum baseline of programming knowledge (preferably in Python) and statistics in order to be successful in this course. Python prerequisites can be met with an introductory Python course offered through CS50’s Introduction to Programming with Python, and statistics prerequisites can be met via Fat Chance or with Stat110 offered through EduLighht.', '20240421142117.jpg', 150.00, '2', '4', 'INTERMEDIATE', 'Coding', '3', 'MALAY', 'Gain hands-on experience and practice using Python to solve real data science challenges', 'Practice Python programming and coding for modeling, statistics, and storytelling', 'Utilize popular libraries such as Pandas, numPy, matplotlib, and SKLearn', '2024-04-21 06:21:17', '2024-04-21 06:21:17');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(300) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `image`, `name`, `title`, `about`, `created_at`, `updated_at`) VALUES
(1, '20240421134336.jpg', 'Miguel Amigot', 'CTO at ibleducation.com', 'Miguel Amigot is the Chief Technology Officer at ibleducation.com, the AI-driven education company building on ChatGPT and OpenAI serving NVIDIA, Cisco, Tesla, IBM, MIT and the U.S. Department of Defense. As a computer scientist and electrical engineer based in New York City, speaker and course creator, Miguel delivers practical course series focused on live demos and active learning.', '2024-04-21 05:43:36', '2024-04-21 05:43:36'),
(2, '20240421134529.jpg', 'David J. Malan', 'Gordon McKay Professor of the Practice of Computer Science at Harvard University', 'David J. Malan is Gordon McKay Professor of the Practice of Computer Science at Harvard University in the School of Engineering and Applied Sciences as well as a Member of the Faculty of Education in the Graduate School of Education. He teaches Computer Science 50, otherwise known as CS50, which is among Harvard University\'s largest courses, one of Yale University\'s largest courses, and edX\'s largest MOOC. He also teaches at Harvard Business School, Harvard Law School, Harvard Extension School, and Harvard Summer School.', '2024-04-21 05:45:29', '2024-04-21 05:45:29'),
(3, '20240421134605.jpg', 'Colton Ogden', 'Gurney Professor of English and Professor of Comparative Literature at Harvard University', 'James Engell is Gurney Professor of English and Professor of Comparative Literature, also a member of the Committee on the Study of Religion, and a faculty associate of the Harvard University Center for the Environment.  He has also directed dissertations in American Studies, as well as Romance Languages & Literatures (French).', '2024-04-21 05:46:05', '2024-04-21 05:46:05'),
(4, '20240421134809.jpg', 'Arthur Brooks', 'William Henry Bloomberg Professor of the Practice of Public Leadership', 'Arthur C. Brooks is the Parker Gilbert Montgomery Professor of the Practice of Public and Nonprofit Leadership at the Harvard Kennedy School, and Professor of Management Practice at the Harvard Business School, where he teaches courses on leadership, happiness, and social entrepreneurship. He is also a columnist at The Atlantic, where he writes the popular “How to Build a Life” column. Brooks is the author of 13 books, including the 2022 #1 New York Times bestseller From Strength to Strength: Finding Success, Happiness, and Deep Purpose in the Second Half of Life and the forthcoming Build the Life You Want: The Art and Science of Getting Happier with co-author Oprah Winfrey available September 2023. He speaks to audiences all around the world about human happiness, and works to raise well-being within private companies, universities, public agencies, and community organizations.\r\n\r\nBrooks began his career as a classical French hornist, leaving college at 19, touring and recording in the United States and Spain. In his late twenties, while still performing, he returned to school, earning a BA through distance learning. At 31, he left music and earned an MPhil and PhD in public policy analysis from the Rand Graduate School, during which time he worked as an analyst for the Rand Corporation’s Project Air Force, performing military operations research analysis. Brooks then spent the next 10 years as a university professor, primarily at Syracuse University, where he taught economics and nonprofit management, and published 60 peer-reviewed articles and several books, including the textbook “Social Entrepreneurship” (2008). In 2009, Brooks became the president of the American Enterprise Institute (AEI) in Washington, DC, one of the world’s most influential think tanks. Over the following decade, he was selected as one of Fortune Magazine’s “50 World’s Greatest Leaders” and was awarded seven honorary doctorates.\r\n\r\nOriginally from Seattle, Brooks currently lives outside Boston, with his wife Ester Munt-Brooks, who is a native of Barcelona. They have three adult children: Joaquim, Carlos, and Marina.', '2024-04-21 05:48:09', '2024-04-21 05:48:09');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_03_07_181219_add_user_type_to_users_table', 1),
(7, '2024_03_11_140954_create_tutorials_table', 1),
(8, '2024_03_11_200621_add_example__to_tutorials_table', 1),
(9, '2024_03_11_200828_add_question__to_tutorials_table', 1),
(10, '2024_03_11_201007_add_option1__to_tutorials_table', 1),
(11, '2024_03_11_201043_add_option2_to_tutorials_table', 1),
(12, '2024_03_12_201327_create_sessions_table', 1),
(13, '2024_03_20_092837_create_quizzes_table', 1),
(14, '2024_03_20_100344_add_type_to_quizzes_table', 1),
(15, '2024_03_24_141849_create_courses_table', 1),
(16, '2024_04_08_140439_add_instructor_to_courses_table', 1),
(17, '2024_04_08_141235_add_duration_to_courses_table', 1),
(18, '2024_04_08_143729_create_news_table', 1),
(19, '2024_04_08_153402_change_title_column_type_in_news_table', 1),
(20, '2024_04_09_111559_create_instructors_table', 1),
(21, '2024_04_10_141711_create_cart_table', 1),
(22, '2024_04_10_143545_create_cartitem_table', 1),
(23, '2024_04_15_034148_create_order_table', 1),
(24, '2024_04_15_035408_create_orderitem_table', 1),
(25, '2024_04_17_174403_add_additional_columns_to_users_table', 2),
(26, '2024_04_18_124118_create_scolarship_table', 2),
(27, '2024_04_19_172308_add_status_to_users_table', 2),
(28, '2024_04_20_155407_create_applicants_table', 2),
(29, '2024_04_20_172308_add_university_id_to_applicants_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `introduction` text NOT NULL,
  `image` varchar(300) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `title1` varchar(255) DEFAULT NULL,
  `description1` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `category`, `introduction`, `image`, `title`, `description`, `title1`, `description1`, `created_at`, `updated_at`) VALUES
(1, 'Business', 'Tech giant\'s new platform redefines business finance: streamline, grow, thrive.', '20240421131410.jpg', 'Tech Giant Unveils Groundbreaking Financial Platform, Disrupting Business Landscape', 'Breaking ground in the realm of financial technology, a renowned tech giant has recently lifted the veil on its latest innovation - a sophisticated platform designed to redefine the very fabric of modern business operations. With a robust array of features meticulously crafted to meet the evolving needs of enterprises across industries, this groundbreaking solution stands poised to revolutionize the traditional paradigms of financial management.\r\n\r\nBy seamlessly integrating cutting-edge technologies, this platform empowers businesses with unparalleled efficiency and agility, offering a comprehensive suite of tools to optimize financial processes, enhance decision-making, and drive sustainable growth. From advanced analytics capabilities providing actionable insights, to seamless integration with existing systems, businesses can now navigate complex financial landscapes with unprecedented ease and precision.\r\n\r\nMoreover, with a focus on accessibility and user experience, this platform ensures intuitive navigation and seamless adoption, empowering organizations of all sizes to harness the full potential of their financial data. Whether streamlining budgeting and forecasting, optimizing cash flow management, or facilitating real-time collaboration, this transformative solution represents a new era in business finance.\r\n\r\nAs industries continue to evolve and adapt to the demands of a rapidly changing world, this innovative platform emerges as a beacon of progress, ushering in a future where businesses can thrive and succeed amidst uncertainty. Embracing the ethos of innovation and empowerment, it is poised to shape the trajectory of business finance, driving efficiency, resilience, and success in the digital age.', NULL, NULL, '2024-04-21 05:14:10', '2024-04-21 05:14:10'),
(2, 'Developer', 'Tech giant\'s latest release empowers developers worldwide with game-changing tools for innovation.', '20240421131712.jpg', 'Developer Dynamo: Tech Firm Unveils Revolutionary Tools Empowering Coders Everywhere', 'In a landmark move towards enhancing the capabilities of developers globally, a pioneering tech firm has unveiled an expansive suite of revolutionary tools designed to catalyze innovation and streamline the development process. This comprehensive array of resources represents a bold leap forward in empowering developers of all levels, from seasoned professionals to aspiring enthusiasts, with the tools they need to bring their visions to life.\r\n\r\nAt the heart of this groundbreaking release are cutting-edge APIs meticulously crafted to simplify complex tasks, accelerate development cycles, and unlock new possibilities for software creation. These APIs offer seamless integration with a diverse range of platforms and technologies, providing developers with unprecedented flexibility and efficiency in building robust, scalable applications across diverse domains.\r\n\r\nComplementing the APIs are intuitive frameworks engineered to streamline the development workflow, enabling developers to focus their energy on creativity and problem-solving rather than grappling with the intricacies of coding. From rapid prototyping to seamless deployment, these frameworks empower developers to bring their ideas to fruition with speed and precision, fostering a culture of innovation and experimentation within the developer community.\r\n\r\nMoreover, the release of comprehensive documentation, tutorials, and educational resources underscores the tech firm\'s commitment to fostering a vibrant and inclusive developer ecosystem. By providing developers with the knowledge and support they need to succeed, the firm is not only democratizing access to cutting-edge technology but also nurturing the next generation of digital innovators.\r\n\r\nAs the digital landscape continues to evolve at a breakneck pace, the significance of empowering developers with the right tools and resources cannot be overstated. With this groundbreaking release, the tech firm is not only shaping the future of software development but also catalyzing a new era of creativity, collaboration, and innovation across industries.', 'Code Catalyst: Tech Titan Unveils Groundbreaking Developer Tools Empowering Innovators Globally\"', 'In a transformative leap forward for the developer community worldwide, a pioneering tech titan has unleashed a comprehensive suite of groundbreaking tools aimed at empowering developers at every level of expertise. This expansive arsenal of resources represents a paradigm shift in the way developers approach their craft, offering a robust array of capabilities designed to fuel innovation, streamline workflows, and unlock new realms of possibility.\r\n\r\nAt the heart of this revolutionary release are cutting-edge APIs meticulously engineered to simplify complex tasks, accelerate development cycles, and facilitate seamless integration across diverse platforms and technologies. From harnessing the power of artificial intelligence to optimizing cloud computing resources, these APIs provide developers with unparalleled flexibility and efficiency, empowering them to create next-generation applications with ease.\r\n\r\nComplementing the APIs are intuitive frameworks meticulously designed to streamline the development process, providing developers with a cohesive and adaptable toolkit for building robust, scalable solutions. Whether embarking on a new project or optimizing existing codebases, these frameworks empower developers to unleash their creativity and bring their ideas to life with unprecedented speed and precision.\r\n\r\nMoreover, the release is accompanied by a wealth of educational resources, including comprehensive documentation, tutorials, and community forums, fostering a collaborative environment where developers can learn, share insights, and collaborate on projects of mutual interest. By democratizing access to cutting-edge technology and knowledge, the tech titan is paving the way for a new generation of digital innovators to thrive in an increasingly interconnected world.\r\n\r\nAs the pace of technological innovation accelerates and the demand for skilled developers continues to rise, the significance of empowering developers with the right tools and resources cannot be overstated. With this groundbreaking release, the tech titan is not only revolutionizing the way developers work but also catalyzing a new era of creativity, collaboration, and innovation on a global scale.', '2024-04-21 05:17:12', '2024-04-21 05:17:12'),
(3, 'DEVELOPER', 'Discover computer working days software engineering: coding, problem-solving, and tailored solutions.', '20240421132000.jpg', 'How to Become Computer Working Days Software Engineer?', 'Becoming a successful software engineer focused on computer working days typically involves the following steps:\r\n\r\n1. Education: Start by obtaining a degree in computer science, software engineering, or a related field. While a formal education is not always required, it can provide you with a strong foundation in programming concepts, algorithms, data structures, and software development methodologies.\r\n\r\n2. Gain Proficiency in Programming: Master programming languages commonly used in software development, such as Python, Java, C++, or JavaScript. Understanding the intricacies of these languages will be essential for developing efficient and reliable software solutions.\r\n\r\n3. Specialize in Software Development: Focus on building skills specifically related to software development, including software design, testing, debugging, and optimization. Learn about common software development frameworks, libraries, and tools used to streamline the development process.\r\n\r\n4. Understand Business Requirements: Gain a deep understanding of the specific domain you wish to work in, such as finance, healthcare, e-commerce, or any other industry that relies on computer working days software. Understanding business requirements and user needs will help you develop tailored solutions that meet real-world demands.\r\n\r\n5. Learn about Computer Working Days: Familiarize yourself with concepts related to computer working days, such as date and time manipulation, calendar systems, time zones, holidays, and working hours. Understand how to calculate working days between two dates, account for weekends and holidays, and handle exceptions.\r\nPractice Problem-Solving: Engage in coding challenges, hackathons, and personal projects that involve solving problems related to computer working days. This hands-on experience will help you develop your problem-solving skills and gain practical knowledge in this specific area.\r\n\r\n6. Stay Updated: Keep abreast of the latest developments in software engineering, including advancements in programming languages, tools, and techniques. Stay connected with online communities, attend conferences, and participate in continuous learning opportunities to stay ahead in your field.\r\n\r\n7. Build a Portfolio: Create a portfolio showcasing your projects, contributions to open-source initiatives, and any relevant work experience. A strong portfolio will demonstrate your skills and expertise to potential employers or clients.\r\nGain Experience: Seek internships, co-op placements, or entry-level positions to gain practical experience in software development. Working on real-world projects will help you apply your skills, learn from seasoned professionals, and build a network of contacts in the industry.\r\n\r\n8. Continuously Improve: Software engineering is a dynamic field, so make a commitment to lifelong learning and improvement. Stay curious, explore new technologies, and be open to feedback and mentorship opportunities that will help you grow as a software engineer specializing in computer working days software.', NULL, NULL, '2024-04-21 05:20:00', '2024-04-21 05:20:00'),
(4, 'Mass Communication', 'Level up your blogging skills with our content planning guide', '20240421132433.jpg', 'Become a Better Blogger: Content Planning', 'Dive into the world of professional blogging with our comprehensive guide to content planning. In today\'s digital landscape, effective content planning is the cornerstone of a successful blog, serving as the roadmap that guides your creative process and ensures consistency, relevance, and engagement. This in-depth resource will walk you through the essential steps and strategies for crafting an effective content plan tailored to your audience and goals.\r\n\r\nFrom identifying your target audience and defining your niche to conducting keyword research and brainstorming content ideas, you\'ll learn how to lay the foundation for a blog that resonates with readers and drives traffic to your site. We\'ll explore techniques for organizing your content calendar, setting realistic goals, and prioritizing topics based on audience interests and industry trends.\r\n\r\nMoreover, we\'ll delve into the art of storytelling and narrative structure, teaching you how to craft compelling blog posts that captivate your audience and keep them coming back for more. You\'ll discover tips for optimizing your content for search engines, leveraging social media channels to amplify your reach, and measuring the success of your content through analytics and key performance indicators.\r\n\r\nWhether you\'re a seasoned blogger looking to refine your approach or a newcomer eager to make your mark in the blogosphere, this guide will equip you with the knowledge and tools you need to become a better blogger through strategic content planning. Get ready to elevate your blogging skills and take your content to new heights!', 'Mastering Content Planning for Succes', 'From defining your target audience and establishing your unique voice to conducting thorough research and developing a content calendar, you\'ll learn how to lay the foundation for a cohesive and impactful blogging strategy. We\'ll delve into the importance of setting clear goals and objectives for your content, as well as the role of analytics and data-driven insights in optimizing your approach over time.\r\n\r\nMoreover, we\'ll discuss the creative process behind crafting compelling blog posts, including brainstorming ideas, structuring content for maximum impact, and incorporating multimedia elements to enhance reader engagement. You\'ll gain valuable insights into the nuances of effective storytelling and learn how to tailor your content to resonate with your audience\'s interests, preferences, and pain points.\r\n\r\nIn addition, we\'ll explore practical tips and tools for managing your content pipeline, organizing your workflow, and staying consistent in your publishing schedule. Whether you\'re a seasoned blogger looking to refine your approach or a newcomer eager to make a splash in the digital landscape, this guide will equip you with the knowledge and resources you need to succeed in the competitive world of blogging.\r\n\r\nBy mastering the art of content planning, you\'ll not only attract more readers to your blog but also build deeper connections with your audience, establish your authority in your niche, and ultimately achieve your blogging goals. Get ready to elevate your blogging game and unleash your full potential as a content creator with our comprehensive guide to mastering content planning for success.', '2024-04-21 05:24:33', '2024-04-21 05:24:33'),
(5, 'Work Out', 'Enhance your morning workouts with fresh strategies', '20240421133134.jpg', 'How to Keep Workouts Fresh in the Morning', 'Keeping your morning workouts fresh is essential for maintaining motivation and achieving your fitness goals. While it\'s easy to fall into a rut and stick to the same routine day after day, incorporating variety and excitement into your workouts can make all the difference in staying engaged and seeing results.\r\n\r\nOne effective method for keeping your morning workouts fresh is to set clear goals for yourself. By defining what you hope to achieve with your workouts, whether it\'s improving your cardiovascular health, building strength, or increasing flexibility, you can stay motivated and focused on your objectives.', 'Here\'s a method for keeping your morning workouts fresh:', '1. Set Clear Goals: Start by defining your fitness goals and what you hope to achieve with your morning workouts. Whether it\'s increasing endurance, building strength, or improving flexibility, having clear objectives will help you stay motivated and focused.\r\n\r\n2. Mix Up Your Routine: Variety is key to keeping your workouts fresh and exciting. Incorporate a mix of different exercises, such as cardio, strength training, yoga, or HIIT, to keep your body challenged and prevent boredom.\r\n\r\n3. Try New Activities: Don\'t be afraid to step out of your comfort zone and try new activities or workouts. Sign up for a fitness class, explore outdoor activities like hiking or cycling, or experiment with different workout apps or online videos to keep things interesting.\r\n\r\n4. Change Your Environment: If you typically work out at home, consider switching things up by exercising outdoors or joining a gym for a change of scenery. Changing your environment can help keep your workouts feeling fresh and invigorating.\r\n\r\n5. Set a Schedule: Make morning workouts a non-negotiable part of your daily routine by scheduling them into your calendar. Having a consistent schedule will help you stay accountable and ensure that you prioritize your fitness goals.\r\n\r\n6. Listen to Music or Podcasts: Create a motivating playlist or listen to your favorite podcasts or audiobooks while you work out to keep yourself entertained and engaged. Music can help boost your energy levels and make your workouts more enjoyable.\r\n\r\n7. Stay Hydrated and Fueled: Make sure to drink plenty of water and eat a balanced breakfast before your morning workout to fuel your body and keep your energy levels up. Opt for healthy, nutrient-rich foods that will provide sustained energy throughout your workout.\r\n\r\n8. Track Your Progress: Keep track of your workouts, progress, and achievements to stay motivated and see how far you\'ve come. Whether it\'s using a fitness app, journaling, or simply marking your workouts on a calendar, tracking your progress can help you stay committed to your fitness routine.\r\n\r\n9. Stay Flexible: Be flexible with your workout routine and don\'t be too hard on yourself if things don\'t always go as planned. Life can be unpredictable, so be willing to adapt and adjust your workouts as needed to accommodate changes in your schedule or energy levels.\r\n\r\n10. Celebrate Your Successes: Finally, don\'t forget to celebrate your successes and milestones along the way. Whether it\'s reaching a new personal best, mastering a challenging yoga pose, or simply showing up and giving it your all, take pride in your accomplishments and use them as motivation to keep pushing forward.', '2024-04-21 05:29:41', '2024-04-21 05:31:34');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `paymentMethod` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `userId`, `name`, `total`, `paymentMethod`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ali', '200.00', 'E-Wallet', '2024-04-21 07:46:38', '2024-04-21 07:46:38');

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `orderId` bigint(20) UNSIGNED NOT NULL,
  `courseId` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`orderId`, `courseId`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 4, 'Introduction to Cybersecurity', '200.00', '2024-04-21 07:46:38', '2024-04-21 07:46:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `correct` text NOT NULL,
  `wrong1` text NOT NULL,
  `wrong2` text NOT NULL,
  `wrong3` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `type`, `question`, `correct`, `wrong1`, `wrong2`, `wrong3`, `created_at`, `updated_at`) VALUES
(1, 'HTML', 'What does HTML stand for?', 'Hyper Text Markup Language', 'High Tech Multi Layering', 'Home Tool Markup Language', 'Hyperlinking Text Management Language', '2024-04-21 04:37:35', '2024-04-21 04:37:35'),
(3, 'HTML', 'What is the correct HTML tag for inserting an image?', '<img>', '<picture>', '<image>', '<src>', '2024-04-21 04:38:44', '2024-04-21 05:00:34'),
(4, 'HTML', 'Which HTML element is used to define the structure of an HTML document?', '<html>', '<body>', '<head>', '<title>', '2024-04-21 04:39:04', '2024-04-21 04:58:56'),
(5, 'HTML', 'Which attribute is used to specify an alternate text for an image in HTML?', '<alt>', '<image-alt>', '<src-alt>', '<alt-text>', '2024-04-21 04:39:24', '2024-04-21 05:01:17'),
(6, 'HTML', 'Which tag is used to define a list item in HTML?', '<li>', '<list>', '<item>', '<ul>', '2024-04-21 04:39:40', '2024-04-21 05:01:32'),
(7, 'HTML', 'Which tag is used to create a line break in HTML?', '<br>', '<nl>', '<lb>', '<break>', '2024-04-21 04:40:12', '2024-04-21 05:01:47'),
(8, 'HTML', 'What is the correct HTML tag for making text bold?', '<b>', '<strong>', '<bold>', '<big>', '2024-04-21 04:40:36', '2024-04-21 05:02:01'),
(9, 'CSS', 'Which property is used to change the color of text in CSS?', 'color', 'text-color', 'font-color', 'text-style', '2024-04-21 04:42:15', '2024-04-21 04:42:15'),
(10, 'CSS', 'What does CSS stand for?', 'Cascading Style Sheets', 'Creative Style Sheets', 'Computerized Style Syntax', 'Complex Styling Strategies', '2024-04-21 04:42:40', '2024-04-21 04:42:40'),
(11, 'CSS', 'Which property is used to set the background color of an element in CSS?', 'background-color', 'bg-color', 'background-style', 'element-background', '2024-04-21 04:42:57', '2024-04-21 04:42:57'),
(12, 'CSS', 'What is the correct syntax to select an element with the class \"example\" in CSS?', '.example', '#example', 'example.class', '.class.example', '2024-04-21 04:43:40', '2024-04-21 04:43:40'),
(13, 'PHP', 'What does PHP stand for?', 'Hypertext Preprocessor', 'Personal Home Page', 'Preprocessed Hyperlinks Parser', 'Powerful Hosting Platform', '2024-04-21 05:03:09', '2024-04-21 05:03:09'),
(14, 'PHP', 'Which PHP function is used to open a file?', 'fopen()', 'open_file()', 'read_file()', 'create_file()', '2024-04-21 05:03:28', '2024-04-21 05:03:28'),
(15, 'PHP', 'What is the correct way to start a PHP code block?', '<?php and ?>', '<? and ?>', '<?php and <?=', '<? and ?>', '2024-04-21 05:03:46', '2024-04-21 05:03:46'),
(16, 'HTML', 'Which PHP function is used to retrieve data sent through HTTP POST method?', '$_POST[]', '$_GET[]', '$_REQUEST[]', '$_SERVER[]', '2024-04-21 05:04:02', '2024-04-21 05:04:02'),
(17, 'PHP', 'What is the output of the following PHP code: echo strlen(\"Hello World\"); ?', '11', '10', '12', '\"Hello World\"', '2024-04-21 05:04:20', '2024-04-21 05:04:20'),
(18, 'PHP', 'Which PHP superglobal array is used to access information about uploaded files?', '$_FILES[]', '$_DATA[]', '$_UPLOADS[]', '$_FORM[]', '2024-04-21 05:05:19', '2024-04-21 05:05:19'),
(19, 'HTML', 'What is the correct syntax to define a constant in PHP?', 'define(\"CONSTANT_NAME\", \"value\");', 'constant(CONSTANT_NAME, value);', 'const CONSTANT_NAME = \"value\";', 'define(\"value\", CONSTANT_NAME);', '2024-04-21 05:05:35', '2024-04-21 05:05:35'),
(20, 'JAVASCRIPT', 'What does DOM stand for in JavaScript?', 'Document Object Model', 'Data Object Model', 'Document Order Management', 'Dynamic Object Manipulation', '2024-04-21 05:06:54', '2024-04-21 05:06:54'),
(21, 'JAVASCRIPT', 'What is the correct syntax to create a function in JavaScript?', 'function myFunction() {}', 'def myFunction() {}', 'func myFunction() {}', 'create myFunction() {}', '2024-04-21 05:07:16', '2024-04-21 05:07:16'),
(22, 'JAVASCRIPT', 'Which keyword is used to declare a variable in JavaScript?', 'var', 'let', 'const', 'variable', '2024-04-21 05:08:20', '2024-04-21 05:08:20');

-- --------------------------------------------------------

--
-- Table structure for table `scolarship`
--

CREATE TABLE `scolarship` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` int(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `fundType` varchar(255) NOT NULL,
  `academic` varchar(255) NOT NULL,
  `requirement` text NOT NULL,
  `description` text NOT NULL,
  `website` text DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scolarship`
--

INSERT INTO `scolarship` (`id`, `userId`, `title`, `type`, `fundType`, `academic`, `requirement`, `description`, `website`, `file`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'APU Energy Scholarship Programme 2024', 'Result', 'Education', 'All', 'Eligibility:\r\n1. Possess strong leadership skills and active participation in extra-curricular, social or voluntary activities\r\n2. Applicants must have a consistent and outstanding academic achievement record as follows:\r\n\r\nFoundation Studies\r\n1. Obtained a minimum of 8As (combination of A and A+) in the recent SPM examination or at least 8As in the recent IGCSE.\r\n2. Obtained A or A+ in the following core subjects: Bahasa Melayu, English, History and Mathematics (only for SPM).\r\n3. Not exceeding 18 years of age at the enrolment date for the foundation studies.\r\n\r\n*Successful candidates will be sent to Kolej Yayasan UEM (KYUEM) to pursue A-Level Programme as a preparation to further undergraduate studies at our approved universities abroad.\r\n \r\nMaster\'s Degree\r\n1. Obtained a minimum of Second Class Upper Division (UK and Australia University) or where there is a point system, obtained a minimum CGPA of 3.50 for Bachelor\'s Degree\r\n2. Obtained admission at Yayasan Khazanah’s approved universities (Conditional offer can be considered).Those who have applied to the universities but have yet to receive admission are also eligible to apply. In the event that no offer of admission from the university is received during our selection process, please be aware that the scholarship offer will become null and void.\r\n3. Not exceeding 40 years of age as at the enrolment date for the Master\'s programme\r\n4. To provide research outline/ thesis summary (Research or mixed mode)', 'The APU Energy Scholarship is a prestigious award that offers opportunities for bright and high-achieving Malaysians to pursue A-Level studies at APU (as a preparation to further undergraduate studies  at our approved universities abroad) and Postgraduate studies at selected leading universities around the world.\r\n \r\nIn addition, recipients of the APU Energy Scholarship are provided with leadership trainings and job attachments at leading organisations in Malaysia.\r\n\r\nThe trainings, job attachments and exposures, and the facility to gain professional experience at leading corporations in the world represent opportunities that we provide in our quest to nurture our scholars to realise their potential to become Malaysia\'s future business and industry leaders.\r\n\r\nThe duration of the scholarship will be for the full course of study, as stipulated in the offer of admission, subject to APU Scholarship\'s terms and conditions.', 'https://studymalaysia.com/scholarships/khazanah-global-scholarship-2024-a-level-studies-only', NULL, 'Ongoing', '2024-04-21 08:19:32', '2024-04-21 08:19:32'),
(2, 3, 'APU Watan Scholarship Programme', 'Sport', 'Education', 'All', '1. Possess strong leadership skills and active participation in extra-curricular, social or voluntary activities\r\n2. Applicants must have a consistent and outstanding academic achievement record as follows:\r\nFoundation Studies\r\n\r\n1. Obtained a minimum of 8As (combination of A and A+) in the recent SPM examination or at least 8As in the recent IGCSE.\r\n2. Obtained A or A+ in the following core subjects: Bahasa Melayu, English, History and Mathematics (only for SPM).\r\n3. Not exceeding 18 years of age at the enrolment date for the foundation studies.', 'The APU Watan Scholarship is a prestigious award that offers opportunities for talented and high-achieving Malaysians to pursue Undergraduate and Postgraduate studies at selected leading local universities.\r\nThe aim of the APU Watan Scholarship Programme is two-fold:-\r\n\r\nTo train Malaysia\'s brightest talents to transform its GLCs into competitive business locally and internationally.\r\n\r\nTo encourage individuals with excellent academic credentials to lead and participate in research initiatives that will contribute to the advancement of the universities\' reputation in research and innovation.', NULL, 'user_files/LCrB6h1LCqXpshxNxJhMQOX449BEG9j4ultxZFVh.pdf', 'Ongoing', '2024-04-21 08:21:34', '2024-04-21 08:21:34'),
(3, 3, 'APU PUBLIC SCHOLARSHIP 2024', 'All', 'Scholarship', 'All', 'INTRODUCTION\r\nThe APU culture rests on nurturing and developing outstanding individuals through quality education, and providing them challenging – and rewarding – opportunities to grow to their fullest potential.\r\n\r\nApart from the financial aid we provide to cover tuition fees and daily living expenses, we offer our scholars internship opportunities to gain hands-on working experience.\r\n\r\nThe scholarship is open to students who have gained admission or are eligible for admission into their first year full-time undergraduate studies at all public and private universities recognised by the Government of Malaysia.\r\n\r\nFirst year students from these universities are also welcome to apply.\r\n\r\nWe invite you to apply for a scholarship with us if you:\r\n\r\nAttained excellent Sijil Tinggi Persekolahan Malaysia (STPM) or Matriculation results.\r\nAre actively involved in extra-curricular activities.\r\nPossess leadership qualities.\r\nAre enrolling for a full-time undergraduate course.', 'Malaysian citizen.\r\nExcellent academic and co-curricular activities record.\r\nDynamic personality with excellent communication and critical thinking skills.', NULL, NULL, 'Ongoing', '2024-04-21 08:23:05', '2024-04-21 08:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ZUGMyyN8Hz0uudcCOhZN53IDTT55ZJYB5zhejdBq', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMTY2SWRTVXJKYk9PaFk3MnVleThlUVpreDBmSVBVUk1PREhydTMwRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyY291cnNlZGV0YWlsLzQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1713754949);

-- --------------------------------------------------------

--
-- Table structure for table `tutorials`
--

CREATE TABLE `tutorials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `example` text NOT NULL,
  `question` varchar(255) NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tutorials`
--

INSERT INTO `tutorials` (`id`, `name`, `details`, `type`, `example`, `question`, `option1`, `option2`, `created_at`, `updated_at`) VALUES
(1, 'HTML HOME', '.HTML is the standard markup language for Web pages.\r\n\r\n.With HTML you can create your own Website.\r\n\r\n.HTML is easy to learn - You will enjoy it!', 'HTML', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n<title>Page Title</title>\r\n</head>\r\n<body>\r\n\r\n<h1>This is a Heading</h1>\r\n<p>This is a paragraph.</p>\r\n\r\n</body>\r\n</html>', 'What is HTML', 'HTML', 'CSS', '2024-04-21 04:16:13', '2024-04-21 04:19:21'),
(2, 'HTML Introduction', 'What is HTML?\r\n\r\n.HTML stands for Hyper Text Markup Language\r\n\r\n.HTML is the standard markup language for creating Web pages\r\n\r\n.HTML describes the structure of a Web page\r\n\r\n.HTML consists of a series of elements\r\n\r\n.HTML elements tell the browser how to display the content\r\n\r\n.HTML elements label pieces of content such as \"this is a heading\", \"this is a paragraph\", \"this is a link\", etc.', 'HTML', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n<title>Page Title</title>\r\n</head>\r\n<body>\r\n\r\n<h1>My First Heading</h1>\r\n<p>My first paragraph.</p>\r\n\r\n</body>\r\n</html>', 'What is an HTML Element?', '<h1></h1>', 'h1/h1', '2024-04-21 04:21:29', '2024-04-21 04:22:09'),
(3, 'HTML Basic Examples', 'HTML Documents\r\n\r\nAll HTML documents must start with a document type declaration: <!DOCTYPE html>.\r\n\r\nThe HTML document itself begins with <html> and ends with </html>.\r\n\r\nThe visible part of the HTML document is between <body> and </body>.', 'HTML', '<!DOCTYPE html>\r\n<html>\r\n<body>\r\n\r\n<h1>My First Heading</h1>\r\n<p>My first paragraph.</p>\r\n\r\n</body>\r\n</html>', 'What is the <!DOCTYPE> Declaration', '<!DOCTYPE html>', '<DOCTYPE html>', '2024-04-21 04:27:46', '2024-04-21 04:27:46'),
(4, 'HTML Elements', 'HTML Elements\r\n\r\nThe HTML element is everything from the start tag to the end tag:\r\n\r\n<tagname>Content goes here...</tagname>\r\nExamples of some HTML elements:\r\n\r\n<h1>My First Heading</h1>\r\n<p>My first paragraph.</p>', 'HTML', '<!DOCTYPE html>\r\n<html>\r\n<body>\r\n\r\n<h1>My First Heading</h1>\r\n<p>My first paragraph.</p>\r\n\r\n</body>\r\n</html>', 'How to correct end tag for the HTML heading.', '<h1>This is a heading</h1>', '<h1>This is a heading<h1>', '2024-04-21 04:29:20', '2024-04-21 04:29:20'),
(5, 'CSS HOME', '.CSS is the language we use to style an HTML document.\r\n\r\n.CSS describes how HTML elements should be displayed.\r\n\r\n.This tutorial will teach you CSS from basic to advanced.', 'CSS', 'body {\r\n  background-color: lightblue;\r\n}\r\n\r\nh1 {\r\n  color: white;\r\n  text-align: center;\r\n}\r\n\r\np {\r\n  font-family: verdana;\r\n  font-size: 20px;\r\n}', 'What is CSS', 'CSS', 'HTML', '2024-04-21 04:30:44', '2024-04-21 04:30:44'),
(6, 'CSS Introduction', 'What is CSS?\r\n\r\n.CSS stands for Cascading Style Sheets\r\n\r\n.CSS describes how HTML elements are to be displayed on screen, paper, or in other media\r\n\r\n.CSS saves a lot of work. It can control the layout of multiple web pages all at once\r\n\r\n.External stylesheets are stored in CSS files', 'CSS', 'body {\r\n  background-color: lightblue;\r\n}\r\n\r\nh1 {\r\n  color: white;\r\n  text-align: center;\r\n}\r\n\r\np {\r\n  font-family: verdana;\r\n  font-size: 20px;\r\n}', 'How to start Css', '<style></style>', '<style><style>', '2024-04-21 04:32:08', '2024-04-21 04:32:08'),
(7, 'PHP HOME', 'Learn PHP\r\n\r\n.PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages.\r\n\r\n.PHP is a widely-used, free, and efficient alternative to competitors such as Microsoft\'s ASP.', 'PHP', '<!DOCTYPE html>\r\n<html>\r\n<body>\r\n \r\n<?php\r\necho \"My first PHP script!\";\r\n?>\r\n\r\n</body>\r\n</html>', 'Which one is correct to output \"Hello World\".', 'echo   \"Hello World\";', 'Hi \"Hello World\";', '2024-04-21 04:33:23', '2024-04-21 04:33:23'),
(8, 'JavaScript HOME', '.JavaScript is the world\'s most popular programming language.\r\n\r\n.JavaScript is the programming language of the Web.\r\n\r\n.JavaScript is easy to learn.\r\n\r\n.This tutorial will teach you JavaScript from basic to advanced.', 'JAVASCRIPT', '<!DOCTYPE html>\r\n<html>\r\n<body>\r\n\r\n<h2>My First JavaScript</h2>\r\n\r\n<button type=\"button\"\r\nonclick=\"document.getElementById(\'demo\').innerHTML = Date()\">\r\nClick me to display Date and Time.</button>\r\n\r\n<p id=\"demo\"></p>\r\n\r\n</body>\r\n</html>', 'What is JavsScript', 'JavsScript', 'HTML', '2024-04-21 04:34:28', '2024-04-21 04:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_type` char(255) NOT NULL DEFAULT 'P',
  `name` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `user_type`, `name`, `bio`, `birthday`, `country`, `phone`, `website`, `file`, `status`) VALUES
(1, 'Ali', 'Ali@gmail.com', NULL, '$2y$12$SZW10NHsUwAELqk68YmwY.FeqVB8ZaaO9m0jusPtl6469pJDPvoxG', NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-21 03:55:07', '2024-04-21 10:46:58', 'P', NULL, NULL, '2024-04-21', NULL, NULL, NULL, 'user_files/ESWk3nJPvyLwhfUL7uGsUEuYoh6MXTlIaqEBHOlZ.pdf', 1),
(2, 'admin', 'admin2001@gmail.com', NULL, '$2y$12$11ZBWwFHFdRZfo3OiQIRlexpq5wW/0I6wWNMAbs.KwhaT4bJLbtTO', NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-21 04:13:15', '2024-04-21 06:29:25', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 'APU', 'APU@gmail.com', NULL, '$2y$12$a0hBZnv/MTaLpTBeaKliV.nE/anAeO5SnV1RaW5XIdFFumy9zVpJy', NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-21 06:26:34', '2024-04-21 06:26:34', 'U', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(4, 'Abu', 'Abu@gmail.com', NULL, '$2y$12$ObRm.3btovtX5igVaV2o8eOgZvmk6Ee0JACFhFb0PGiq/B6hJXIEu', NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-21 09:01:51', '2024-04-21 09:01:51', 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applicants_scholarshipid_foreign` (`scholarshipId`),
  ADD KEY `applicants_userid_foreign` (`userId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_userid_foreign` (`userId`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cartitem_cartid_foreign` (`cartId`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_userid_foreign` (`userId`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD KEY `orderitem_orderid_foreign` (`orderId`),
  ADD KEY `orderitem_courseid_foreign` (`courseId`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scolarship`
--
ALTER TABLE `scolarship`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tutorials`
--
ALTER TABLE `tutorials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `scolarship`
--
ALTER TABLE `scolarship`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tutorials`
--
ALTER TABLE `tutorials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `applicants_scholarshipid_foreign` FOREIGN KEY (`scholarshipId`) REFERENCES `scolarship` (`id`),
  ADD CONSTRAINT `applicants_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `cartitem_cartid_foreign` FOREIGN KEY (`cartId`) REFERENCES `cart` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem_courseid_foreign` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `orderitem_orderid_foreign` FOREIGN KEY (`orderId`) REFERENCES `order` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
