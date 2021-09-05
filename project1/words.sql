-- Adminer 4.7.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `words`;
CREATE TABLE `words` (
  `noun` varchar(20) DEFAULT NULL,
  `verb` varchar(20) DEFAULT NULL,
  `adjective` varchar(20) DEFAULT NULL,
  `adverb` varchar(20) DEFAULT NULL,
  `whole_story` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `words` (`noun`, `verb`, `adjective`, `adverb`, `whole_story`) VALUES
('',	'',	'',	'',	''),
('beehive',	'hop',	'green',	'slowly',	'Once upon a time,in a land far, far away lived a fairy \n                    princess with a very green story to tell.  Day after\n                    day she would she would slowly share her story with all \n                    who would listen.  Soon, the whole kingdom knew her green story.  She knew that she would soon have to hop into the wilderness with her beloved pet beehive. In the end\n                     she lived happily ever after!'),
('beehive',	'fishing',	'filthy',	'quickly',	'Once upon a time,in a land far, far away lived a fairy \n                    princess with a very filthy story to tell.  Day after\n                    day she would she would quickly share her story with all \n                    who would listen.  Soon, the whole kingdom knew her filthy story.  She knew that she would soon have to fishing into the wilderness with her beloved pet beehive. In the end\n                     she lived happily ever after!'),
('bunny',	'die',	'sharp',	'keenly',	'Once upon a time,in a land far, far away lived a fairy \n                    princess with a very sharp story to tell.  Day after\n                    day she would she would keenly share her story with all \n                    who would listen.  Soon, the whole kingdom knew her sharp story.  She knew that she would soon have to die into the wilderness with her beloved pet bunny. In the end\n                     she lived happily ever after!'),
('bunny',	'die',	'sharp',	'keenly',	'Once upon a time,in a land far, far away lived a fairy \n                    princess with a very sharp story to tell.  Day after\n                    day she would she would keenly share her story with all \n                    who would listen.  Soon, the whole kingdom knew her sharp story.  She knew that she would soon have to die into the wilderness with her beloved pet bunny. In the end\n                     she lived happily ever after!'),
('bunny',	'die',	'sharp',	'keenly',	'Once upon a time,in a land far, far away lived a fairy \n                    princess with a very sharp story to tell.  Day after\n                    day she would she would keenly share her story with all \n                    who would listen.  Soon, the whole kingdom knew her sharp story.  She knew that she would soon have to die into the wilderness with her beloved pet bunny. In the end\n                     she lived happily ever after!'),
('groundhog',	'fight',	'funny',	'quickly',	'Once upon a time,in a land far, far away lived a fairy \n                    princess with a very funny story to tell.  Day after\n                    day she would she would quickly share her story with all \n                    who would listen.  Soon, the whole kingdom knew her funny story.  She knew that she would soon have to fight into the wilderness with her beloved pet groundhog. In the end\n                     she lived happily ever after!'),
('garden',	'sweep',	'evil',	'slowly',	'Once upon a time,in a land far, far away lived a fairy \n                    princess with a very evil story to tell.  Day after\n                    day she would she would slowly share her story with all \n                    who would listen.  Soon, the whole kingdom knew her evil story.  She knew that she would soon have to sweep into the wilderness with her beloved pet garden. In the end\n                     she lived happily ever after!')
ON DUPLICATE KEY UPDATE `noun` = VALUES(`noun`), `verb` = VALUES(`verb`), `adjective` = VALUES(`adjective`), `adverb` = VALUES(`adverb`), `whole_story` = VALUES(`whole_story`);

-- 2020-02-24 02:48:02
