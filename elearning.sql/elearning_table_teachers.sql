
-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `qualification` varchar(150) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `qualification`, `experience`, `email`, `about`, `photo`) VALUES
(1, 'Rahul Sharma', 'MCA, M.Sc IT', '6 Years', 'rahul@gmail.com', 'Expert in PHP and Web Development', 'Screenshot 2025-09-29 223647.png'),
(2, 'Neha Patel', 'M.Tech Computer Science', '8 Years', 'neha@gmail.com', 'Specialist in JavaScript and Frontend', 'Screenshot 2025-09-07 214636.png'),
(3, 'Parmar Kashyap', 'M.Tech', '5 Year', NULL, 'With five years of dual expertise in the tech industry and education, Kashyap Parmar is an M.Tech professional dedicated to bridging the gap between theory and practice. A versatile expert with a passion for innovation, he excels in delivering high-impact technical solutions while mentoring the next generation of tech talent.', 'Screenshot 2025-09-29 223647.png'),
(4, 'Graham Nichols', 'Reprehenderit vel q', 'Et ut dolore autem e', NULL, 'Voluptate dicta mole', 'Screenshot 2026-01-31 180551.png'),
(5, 'Graham Nichols', 'Reprehenderit vel q', 'Et ut dolore autem e', NULL, 'Voluptate dicta mole', 'Screenshot 2026-01-31 180551.png'),
(6, 'Parmar Kashyap', 'M.Tech', '5 Year', NULL, '5 of Experience in big tech company in delhi. and now as a HOD Of It Department in Our University.', '250kb photo.png');
