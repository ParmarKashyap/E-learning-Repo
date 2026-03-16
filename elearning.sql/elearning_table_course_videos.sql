
-- --------------------------------------------------------

--
-- Table structure for table `course_videos`
--

CREATE TABLE `course_videos` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `video_file` varchar(255) DEFAULT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_videos`
--

INSERT INTO `course_videos` (`id`, `course_id`, `title`, `video_file`, `uploaded_by`, `created_at`) VALUES
(1, 14, 'full video lecture of  cloud computing.', 'Naah_-__Harrdy_Sandhu_Feat._Nora_Fatehi___Jaani___B_Praak__Official_Music_Video-.mp4', 6, '2026-03-06 11:05:23'),
(2, 15, 'In this video, you will learn the basics of Git and GitHub. Git is a version control system that helps developers manage code, and GitHub is a platform to store and share projects online. This tutorial is perfect for beginners.', '01. What is Git & Github_.mp4', 6, '2026-03-06 17:08:11'),
(3, 15, 'This video explains how Git works and why developers use GitHub. If you are starting your journey in programming or web development, learning Git and GitHub is very important.', '02. Creating a Github Account.mp4', 6, '2026-03-06 17:08:42'),
(4, 15, 'Learn step by step how to use Git and GitHub for project management. In this tutorial, you will understand basic commands and how to upload your code to GitHub.', '03. Using Github.mp4', 6, '2026-03-06 17:09:02'),
(5, 15, 'Git and GitHub are essential tools for every developer. In this video, we will understand the fundamentals of version control and how GitHub helps in collaboration.', '04. Using Git.mp4', 6, '2026-03-06 17:09:31'),
(6, 15, 'This beginner-friendly tutorial will help you understand Git installation, basic commands, and GitHub usage. Perfect for students and developers starting with version control.', '05. Configuring Git.mp4', 6, '2026-03-06 17:10:00'),
(7, 15, 'In this video, you will learn how to create repositories, push code, and manage projects using GitHub. This is a must-learn skill for developers.', '06. Git with VSCode.mp4', 6, '2026-03-06 17:10:30'),
(8, 15, 'Git and GitHub are widely used in the software development industry. In this video, we will explore how developers track code changes using Git.', '07. Clone command.mp4', 6, '2026-03-06 17:11:29'),
(9, 15, 'If you want to become a professional developer, learning Git and GitHub workflow is very important. This video explains the process in a simple way.', '08. Status command.mp4', 6, '2026-03-06 17:11:56'),
(10, 15, 'This video covers important concepts of Git version control and GitHub repositories. You will understand how developers store and manage code online.', '09. Add & Commit Commands.mp4', 6, '2026-03-06 17:12:19'),
(11, 15, 'Welcome to this Git and GitHub tutorial. In this video, we will learn how to manage code, track changes, and collaborate using GitHub.', '10. Push command.mp4', 6, '2026-03-06 17:12:43');
