
-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `due_date` date NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `teacher_id`, `title`, `description`, `due_date`, `file_name`, `created_at`) VALUES
(3, 6, 'Sit impedit aut ip', 'Et voluptas voluptat', '2025-08-30', '1772449951_ConfirmationPage-260110051338 CMAT.pdf', '2026-03-02 11:12:31'),
(4, 6, 'Voluptas aut sit en', 'Impedit voluptatem', '2024-09-19', '1772451158_Form_6_English.pdf', '2026-03-02 11:32:38'),
(5, 6, 'Project Submission dates schedule', 'Here Attaches a project submission Time-Table for Project. So Kindly follow. before due date everyone can submit their project after i can not accept your project.', '2026-03-10', '1772530913_Project Submission dates schedule - BCA - 6B- 2026.pdf', '2026-03-03 09:41:53');
