
-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'active',
  `price` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `teacher_id`, `title`, `description`, `image`, `created_at`, `status`, `price`) VALUES
(1, NULL, 'CLOUD COMPUTING ', 'This is a reference material of cloud computing for the exam purpose.', 'Reference Material CLOUD COMPUTING BCA and BSCIT SEM 6  pdf.pdf', '2026-02-27 19:06:12', 'active', 0.00),
(2, NULL, 'CLOUD COMPUTING ', 'This is a reference material of cloud computing for the exam purpose.', 'Reference Material CLOUD COMPUTING BCA and BSCIT SEM 6  pdf.pdf', '2026-02-27 19:10:02', 'active', 0.00),
(3, NULL, 'CLOUD COMPUTING ', 'This is a reference material of cloud computing for the exam purpose.', 'Reference Material CLOUD COMPUTING BCA and BSCIT SEM 6  pdf.pdf', '2026-02-27 19:10:21', 'active', 0.00),
(4, NULL, 'CLOUD COMPUTING ', 'This is a reference material of cloud computing for the exam purpose.', 'Reference Material CLOUD COMPUTING BCA and BSCIT SEM 6  pdf.pdf', '2026-02-27 19:10:30', 'active', 0.00),
(5, NULL, 'CLOUD COMPUTING ', 'This is a reference material of cloud computing for the exam purpose.', 'Reference Material CLOUD COMPUTING BCA and BSCIT SEM 6  pdf.pdf', '2026-02-27 19:10:53', 'active', 0.00),
(6, NULL, 'CLOUD COMPUTING ', 'This is a reference material of cloud computing for the exam purpose.', 'Reference Material CLOUD COMPUTING BCA and BSCIT SEM 6  pdf.pdf', '2026-02-27 19:12:54', 'active', 0.00),
(7, NULL, 'Claude Computing', 'This is Claude Computing Assignment for ch 1 to 3.', 'cloud computing assignment 1 2 and 3.pdf', '2026-02-27 19:15:53', 'active', 0.00),
(8, NULL, 'Claude Computing', 'This is Claude Computing Assignment for ch 1 to 3.', 'cloud computing assignment 1 2 and 3.pdf', '2026-02-27 19:16:12', 'active', 0.00),
(9, NULL, 'Android With Kotlin Full Material', 'This material only for reference. Android With Kotlin Fully Material.', 'Android  material(ch-1 to 5 merge) vishal final.pdf', '2026-02-27 19:18:25', 'active', 0.00),
(10, NULL, 'Android Ch 1 Assignment', 'Android Assignment of Ch 1. Last date of Submission 3-06-2026', 'Assignment Unit-1 (ANDROID).pdf', '2026-02-27 19:22:13', 'active', 0.00),
(11, NULL, 'Android Ch 1 Assignment', 'Android Assignment of Ch 1. Last date of Submission 3-06-2026', 'Assignment Unit-1 (ANDROID).pdf', '2026-02-27 19:22:17', 'active', 0.00),
(12, NULL, 'Android Ch 1 Assignment', 'Android Assignment of Ch 1. Last date of Submission 3-06-2026', 'Assignment Unit-1 (ANDROID).pdf', '2026-02-27 19:23:26', 'active', 0.00),
(13, NULL, 'full-stack', 'This roadmap has been prepared for students who aspire to build a strong and successful career in Full-Stack Development.', 'full-stack.pdf', '2026-03-03 12:48:38', 'active', 0.00),
(14, 6, 'Cloud Computing', 'This is course material of cloud computing.', '', '2026-03-06 11:03:35', 'active', 0.00),
(15, 6, 'Git & GitHub', 'In this video, you will learn the basics of Git and GitHub. Git is a version control system that helps developers manage code, and GitHub is a platform to store and share projects online. This tutorial is perfect for beginners.', '', '2026-03-06 16:49:04', 'active', 0.00),
(16, NULL, 'Android', 'This comprehensive Android Development course is designed to equip learners with the skills to build fully functional mobile applications for Android devices. The course covers the fundamentals of Java/Kotlin programming, user interface design, and Android Studio environment. Students will learn to work with layouts, activities, fragments, and navigation components, as well as integrate APIs, databases, and multimedia features into their apps. By the end of the course, learners will have hands-on experience in creating responsive, interactive, and real-world Android applications ready for deployment on the Google Play Store.', 'Android  material(ch-1 to 5 merge) vishal.pdf', '2026-03-07 04:05:47', 'active', 0.00);
