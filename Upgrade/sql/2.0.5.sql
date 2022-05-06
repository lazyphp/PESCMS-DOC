
ALTER TABLE `pes_article_content_history` ADD `history_version` VARCHAR(32) NOT NULL AFTER `article_description`;


ALTER TABLE `pes_article_content_history` ADD `history_version_listsort` INT NOT NULL COMMENT '历史版本排序值' AFTER `history_version`;
