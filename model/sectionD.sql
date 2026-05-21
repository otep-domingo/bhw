CREATE TABLE IF NOT EXISTS d_oral (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    record_id   INT UNSIGNED          NOT NULL COMMENT 'Parent form / survey record',
    indicator   VARCHAR(500)          NOT NULL COMMENT 'Row label / indicator name',
    male   		DECIMAL(15,2)         DEFAULT NULL,
    female   	DECIMAL(15,2)         DEFAULT NULL,
    total       DECIMAL(15,2)         DEFAULT NULL,
    remarks     TEXT                  DEFAULT NULL,
    created_at  DATETIME              NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at  DATETIME              NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_record_id (record_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;