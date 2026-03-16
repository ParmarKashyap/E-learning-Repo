
-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `marks` int(11) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `assignment_id`, `student_id`, `file_name`, `marks`, `submitted_at`) VALUES
(1, 4, 7, '1772452526_Form_6_English.pdf', NULL, '2026-03-02 11:55:26'),
(2, 3, 7, '1772452545_ConfirmationPage-260110051338 CMAT.pdf', NULL, '2026-03-02 11:55:45'),
(3, 5, 10, '1772819987_Android Practical till 10-1-2026.pdf', NULL, '2026-03-06 17:59:47'),
(4, 4, 10, '1772820012_Project Submission dates schedule - BCA - 6B- 2026.pdf', NULL, '2026-03-06 18:00:12'),
(5, 3, 10, '1772820033_Resumee.pdf', NULL, '2026-03-06 18:00:33');
