-- ============================================================
-- BHW Monthly Accomplishment Report System
-- Database: MySQL (XAMPP compatible)
-- Run this in phpMyAdmin or MySQL CLI
-- ============================================================

CREATE DATABASE IF NOT EXISTS bhw_report_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE bhw_report_db;

-- ============================================================
-- TABLE 1: users
-- One account per BHW
-- ============================================================
CREATE TABLE IF NOT EXISTS users (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(100)  NOT NULL UNIQUE,
    password_hash VARCHAR(255)  NOT NULL,
    full_name     VARCHAR(150)  NOT NULL,
    barangay      VARCHAR(150)  NOT NULL,
    area          VARCHAR(150)  NOT NULL,
    role          ENUM('bhw','admin') DEFAULT 'bhw',
    created_at    TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
-- TABLE 2: reports
-- One report per BHW per year
-- ============================================================
CREATE TABLE IF NOT EXISTS reports (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    user_id       INT           NOT NULL,
    year          SMALLINT      NOT NULL,
    bhw_name      VARCHAR(150)  NOT NULL,
    barangay      VARCHAR(150)  NOT NULL,
    area          VARCHAR(150)  NOT NULL,
    created_at    TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_report (user_id, year),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ============================================================
-- TABLE 3: accomplishment_data
-- Monthly numeric values per category row per report
-- ============================================================
CREATE TABLE IF NOT EXISTS accomplishment_data (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    report_id   INT           NOT NULL,
    row_key     VARCHAR(60)   NOT NULL,
    jan         SMALLINT      DEFAULT 0,
    feb         SMALLINT      DEFAULT 0,
    mar         SMALLINT      DEFAULT 0,
    apr         SMALLINT      DEFAULT 0,
    may         SMALLINT      DEFAULT 0,
    jun         SMALLINT      DEFAULT 0,
    jul         SMALLINT      DEFAULT 0,
    aug         SMALLINT      DEFAULT 0,
    sep         SMALLINT      DEFAULT 0,
    oct         SMALLINT      DEFAULT 0,
    nov         SMALLINT      DEFAULT 0,
    `dec`       SMALLINT      DEFAULT 0,
    row_total   SMALLINT GENERATED ALWAYS AS
                (jan+feb+mar+apr+may+jun+jul+aug+sep+oct+nov+`dec`) STORED,
    UNIQUE KEY uq_row (report_id, row_key),
    FOREIGN KEY (report_id) REFERENCES reports(id) ON DELETE CASCADE
);

-- ============================================================
-- TABLE 4: family_planning_methods
-- Checkbox state per report
-- ============================================================
CREATE TABLE IF NOT EXISTS family_planning_methods (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    report_id       INT         NOT NULL UNIQUE,
    fp_pills        TINYINT(1)  DEFAULT 0,
    fp_injectables  TINYINT(1)  DEFAULT 0,
    fp_btl          TINYINT(1)  DEFAULT 0,
    fp_vasectomy    TINYINT(1)  DEFAULT 0,
    fp_implant      TINYINT(1)  DEFAULT 0,
    fp_condom       TINYINT(1)  DEFAULT 0,
    fp_cm           TINYINT(1)  DEFAULT 0,
    fp_bbt          TINYINT(1)  DEFAULT 0,
    fp_stm          TINYINT(1)  DEFAULT 0,
    fp_sdm          TINYINT(1)  DEFAULT 0,
    FOREIGN KEY (report_id) REFERENCES reports(id) ON DELETE CASCADE
);

-- ============================================================
-- INDEXES
-- ============================================================
CREATE INDEX IF NOT EXISTS idx_reports_user      ON reports(user_id);
CREATE INDEX IF NOT EXISTS idx_reports_year      ON reports(year);
CREATE INDEX IF NOT EXISTS idx_reports_barangay  ON reports(barangay);
CREATE INDEX IF NOT EXISTS idx_acc_report        ON accomplishment_data(report_id);

-- ============================================================
-- VIEWS
-- ============================================================

DROP VIEW IF EXISTS vw_monthly_totals;
CREATE VIEW vw_monthly_totals AS
SELECT
    report_id,
    SUM(jan) AS jan, SUM(feb) AS feb, SUM(mar) AS mar,
    SUM(apr) AS apr, SUM(may) AS may, SUM(jun) AS jun,
    SUM(jul) AS jul, SUM(aug) AS aug, SUM(sep) AS sep,
    SUM(oct) AS oct, SUM(nov) AS nov, SUM(`dec`) AS `dec`,
    SUM(row_total) AS yearly_total
FROM accomplishment_data
GROUP BY report_id;

DROP VIEW IF EXISTS vw_category_totals;
CREATE VIEW vw_category_totals AS
SELECT
    report_id,
    SUM(CASE WHEN row_key IN ('maternal_1_1','maternal_1_2','maternal_1_3','maternal_1_4')
        THEN row_total ELSE 0 END) AS maternal_care,
    SUM(CASE WHEN row_key IN ('delivery_2_1a','delivery_2_1b')
        THEN row_total ELSE 0 END) AS delivery,
    SUM(CASE WHEN row_key IN ('postpartum_3_1')
        THEN row_total ELSE 0 END) AS post_partum,
    SUM(CASE WHEN row_key IN ('childcare_4_1')
        THEN row_total ELSE 0 END) AS childcare,
    SUM(CASE WHEN row_key IN ('nip_5_1','nip_5_2','nip_5_3','nip_5_4')
        THEN row_total ELSE 0 END) AS immunization,
    SUM(CASE WHEN row_key IN ('nutrition_6_1','nutrition_6_2a','nutrition_6_2b','nutrition_6_3a','nutrition_6_3b','nutrition_6_4')
        THEN row_total ELSE 0 END) AS nutrition,
    SUM(CASE WHEN row_key IN ('fp_7_1','fp_7_2','fp_7_3')
        THEN row_total ELSE 0 END) AS family_planning
FROM accomplishment_data
GROUP BY report_id;
