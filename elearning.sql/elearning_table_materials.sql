
-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `teacher_id`, `title`, `description`, `file_name`, `uploaded_at`) VALUES
(8, 6, 'College Id Card', 'Take your College Id Card from admin Office due to 30/03/2026. after we not responsible for any misusing. ', '1772448677_College Id Card.jpeg', '2026-03-02 10:51:17'),
(9, 6, 'Asp.Net CH-1', 'The ASP.NET material has been uploaded. Please read it carefully. If you have any questions or doubts, you may ask them during the extra lecture.\r\n', '1772819426_FINAL CHAPTER-1.pdf', '2026-03-06 17:50:26'),
(10, 6, 'Cloud Computing', 'The latest Cloud Computing documents are uploaded. Go through them in detail and note any questions for the next session.', '1772819671_Reference Material CLOUD COMPUTING BCA and BSCIT SEM 6  pdf.pdf', '2026-03-06 17:54:31'),
(11, 6, 'Machine Learning', 'Machine Learning study materials are now accessible. Please examine them in detail and bring any queries to the extra lecture for discussion.', '1772819709_Understanding-Clustering-Algorithms-in-Machine-Learning.pptx', '2026-03-06 17:55:09');
