
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','teacher','student') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_role` enum('admin','teacher','student') NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `email`, `mobile`, `password`, `role`, `created_at`, `user_role`) VALUES
(1, 'Merritt Wiggins', 'Male', 'suzekibuba@mailinator.com', NULL, '$2y$10$6Up6vdT.9lX.d9ZvjuvJyuQVQ1J9Q8noLeT8UWfl5kY8T9vLj4kKu', 'student', '2026-02-25 21:10:37', 'student'),
(2, 'Anastasia Velez', 'Female', 'taja@mailinator.com', NULL, '$2y$10$YCsqp.sVqkndDT.PAEJgb.S6b4vhMXpIto2EEoZ1NiIdc5IstLErS', 'student', '2026-02-25 21:15:20', 'student'),
(3, 'Amy Dorsey', 'Male', 'venavog@mailinator.com', '+1 (838) 603-52', '$2y$10$m5bDA.PrErbTXZRg7ox7yO/mlNEQ.IJHKPWNxCfaaIQTraSlWpL2m', 'teacher', '2026-02-25 21:20:15', 'student'),
(4, 'Jamalia Morton', 'Male', 'kashyap06@gmail.com', '+1 (612) 266-57', '$2y$10$lqaFmXumkm5CTnDPNyjsMurOe6xb2.5mMGKKR4xjSTRgMX1tXNU0.', 'student', '2026-02-25 22:33:51', 'student'),
(5, 'Gisela Matthews', 'Male', 'kashu111@gmail.com', '+1 (642) 647-57', '$2y$10$BNoMqZJFqGUpQGZvppeCCeXkrCorX4ssrEieraPoNrxWLBpzMXuci', 'student', '2026-02-26 10:13:59', 'student'),
(6, 'vishal', 'Male', 'vishal2511@gmail.com', '9632587412', '$2y$10$UOEZiuKCdoQQjaJZyBpaauTBVoqwz0Sy7cwRLNj3M4yhlPpy2BO/a', 'teacher', '2026-02-26 11:40:56', 'student'),
(7, 'karishma', 'Female', 'karishma2511@gmail.com', '9632587412', '$2y$10$N83k2iHPmGVSeBwYrOMyg.maCzOVWk4rhslIzTtDbvOnVeTwtbywW', 'student', '2026-02-26 11:55:49', 'student'),
(8, 'Admin User', NULL, 'Kashyap111@gmail.com', NULL, '$2y$10$i11GM/BPefblgHwHatYUpumLkAzOlGhGz1m6q.Jpjd0dup5udAWbO', 'admin', '2026-02-26 12:09:08', 'student'),
(9, 'Kiara Parker', 'Male', 'caxumihotu@mailinator.com', '+1 (214) 428-37', '$2y$10$6a/kPEWUieol/2Y6rJri/eZc4oGjQMGbTCUsRpUcYe9I5bquf0Wd6', 'teacher', '2026-02-27 16:25:54', 'student'),
(10, 'Parmar Vrushti Kanjibhai', 'Female', 'vrushti1182@gmail.com', '7990535501', '$2y$10$fZkoPjf19aYDcqwjM2octufeOP2X8ObmvboYwLzFBQ920ibad9eZS', 'student', '2026-03-06 16:39:08', 'student');
