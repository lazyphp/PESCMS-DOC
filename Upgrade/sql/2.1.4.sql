CREATE PROCEDURE CreateOrCheckColumn()
BEGIN
    DECLARE _count INT;

    SELECT COUNT(*)
    INTO _count
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_NAME = 'pes_doc'
    AND COLUMN_NAME = 'doc_attr';

    IF _count = 0 THEN
        ALTER TABLE pes_doc ADD COLUMN doc_attr VARCHAR(255) NOT NULL;
    END IF;
END;

CALL CreateOrCheckColumn();
DROP PROCEDURE CreateOrCheckColumn;