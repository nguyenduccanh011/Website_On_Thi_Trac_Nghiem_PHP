ALTER TABLE `exams`
ADD COLUMN `title` varchar(255) NOT NULL,
ADD COLUMN `description` text NOT NULL,
ADD COLUMN `duration` int(11) NOT NULL,
ADD COLUMN `total_marks` int(11) NOT NULL,
ADD COLUMN `subject` varchar(255) NOT NULL;
