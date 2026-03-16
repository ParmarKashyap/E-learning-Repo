
-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `target_role` enum('student','teacher','both') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `priority` enum('normal','important') DEFAULT 'normal',
  `expiry_date` date DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `attachment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `message`, `target_role`, `created_at`, `priority`, `expiry_date`, `is_active`, `attachment`) VALUES
(1, 'EXAM FORM ( BCA/BSCIT SEM-4 REGULAR +ATKT)', 'EXAM FORM ( BCA/BSCIT SEM-4 REGULAR +ATKT)\r\n\r\n????વિદ્યાર્થીમિત્રો.????\r\n\r\n✨આપની સેમેસ્ટર-4 ની યુનિવર્સીટીની પરીક્ષા માટેના  EXAM FORM ભરવાની પ્રક્રિયા તારીખ 05-3-2026 થી શરુ થવા જઈ રહેલ છે.✨\r\n✨ આ EXAM FORM ની પૂરી વિગત નીચે મુજબ છે.\r\n✨તારીખ:- 5/3/2026✨ \r\n✨ક્લાસ:-BCA 4-A & BSCIT-4\r\n\r\n✨તારીખ:- 6/3/2026✨ \r\n✨ક્લાસ:-BCA 4-B ROLL NO:-1 TO 50✨\r\n\r\n✨તારીખ:- 7/3/26  BCA 4-B ROLL NO:-51 TO 133✨ \r\n\r\n✨તારીખ:- 9/3/26✨\r\n✨ક્લાસ:-ATKT SEM -4 BCA & BSCIT-4\r\n✨સમય:- સવારે 11 થી બપોરે 1 વાગ્યા સુધી. ✨\r\n\r\n ✨EXAM FORM FEES :-800 RS. (BCA),  855 RS. (BSCIT) ✨\r\n✨સ્થળ:- સ્થળ: શ્રી એચ.એન.શુકલ કોલેજ,\r\n       ૨-વૈશાલી નગર,\r\n રાજકોટ.\r\n✨ખાસ વિધાર્થી મિત્રો આ EXAM FORM ભરવા માટે  ભૂલ્યા વગર સમયસર પધારજો.\r\n__________ \r\n\"SHREE H.N.SHUKLA COLLEGE OF I.T. & MGMT.\"\r\n\r\nMR. MEHUL MAHETA\r\n(H.O.D. I.T. DEPARTMENT)\r\n_________\r\nSHREE H.N.SHUKLA GROUP OF COLLEGES', 'student', '2026-03-03 12:09:09', 'important', '2026-03-09', 1, '1772539749_Exam_Form_Fillup.jpeg'),
(2, '???? Staff Meeting Regarding Academic Planning', 'Dear Teachers,\r\n\r\nThis is to inform all teaching staff that a meeting has been scheduled to discuss academic planning, syllabus completion strategy, and upcoming examination guidelines.\r\n\r\nYour presence is mandatory as important decisions regarding curriculum management, student performance tracking, and institutional policies will be finalized during this meeting.\r\n\r\nPlease ensure punctuality and come prepared with your subject progress reports.\r\n\r\nThank you for your cooperation.\r\n\r\nRegards,\r\nTrustee\r\nManagement Committee\r\n\r\nDisplay To: Teacher\r\nPriority: High\r\nExpiry Date: (Set as per meeting date, e.g., 15-03-2026)', 'teacher', '2026-03-03 12:22:41', 'important', '2026-03-15', 1, NULL);
