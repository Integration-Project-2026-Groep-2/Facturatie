-- Minimal operational seed data for first bootstrap.
--
-- IMPORTANT:
-- 1) This file is imported only when the DB volume is empty.
-- 2) Change the admin password immediately after first login.
-- 3) Keep this file free of personal/production business data.

-- Admin groups expected by default admin users.
INSERT INTO `admin_group` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrators', '2022-12-01 12:00:00', '2022-12-01 12:00:00'),
(2, 'Support', '2022-12-01 12:00:00', '2022-12-01 12:00:00')
ON DUPLICATE KEY UPDATE
`name` = VALUES(`name`),
`updated_at` = VALUES(`updated_at`);

-- System cron admin and default administrator account.
-- Default admin login: admin@ehb.be / Fossbilling123
INSERT INTO `admin` (`id`, `role`, `admin_group_id`, `email`, `pass`, `salt`, `name`, `signature`, `protected`, `status`, `api_token`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'cron', 1, '9NhAw3LI@vx2V7i6p.com', '$2y$12$0ODsI4GLipjIjfywlavqY.M/xCuuZm1uuH5ATdyEgvQQ0Eezn2MuO', NULL, 'System Cron Job', '', 1, 'active', NULL, NULL, '2026-03-05 08:55:06', '2026-03-05 08:55:06'),
(2, 'admin', 1, 'admin@ehb.be', '$2y$12$h4jskKtekS8oGNb1.V6G6uJtrcjO1DVst1hwTAgZEbDIGXPLF6yzS', NULL, 'Administrator', '', 1, 'active', NULL, NULL, '2026-03-05 16:31:56', '2026-03-24 22:01:00')
ON DUPLICATE KEY UPDATE
`role` = VALUES(`role`),
`admin_group_id` = VALUES(`admin_group_id`),
`email` = VALUES(`email`),
`pass` = VALUES(`pass`),
`name` = VALUES(`name`),
`status` = VALUES(`status`),
`updated_at` = VALUES(`updated_at`);

-- Patch marker and basic company identity defaults.
INSERT INTO `setting` (`param`, `value`, `public`, `category`, `hash`, `created_at`, `updated_at`) VALUES
('last_patch', '45', 0, NULL, NULL, '2024-01-04 12:00:00', '2024-01-04 12:00:00'),
('company_name', 'Company Name', 0, NULL, NULL, '2022-12-01 12:00:00', '2022-12-01 12:00:00'),
('company_email', 'company@email.com', 0, NULL, NULL, '2022-12-01 12:00:00', '2022-12-01 12:00:00'),
('company_signature', 'FOSSBilling.org - Client Management, Invoicing and Support Software', 0, NULL, NULL, '2022-12-01 12:00:00', '2022-12-01 12:00:00'),
('company_logo', 'themes/huraga/assets/img/logo.png', 0, NULL, NULL, '2022-12-01 12:00:00', '2022-12-01 12:00:00'),
('company_logo_dark', 'themes/huraga/assets/img/logo_white.svg', 0, NULL, NULL, '2022-12-01 12:00:00', '2022-12-01 12:00:00'),
('company_favicon', 'themes/huraga/assets/favicon.ico', 0, NULL, NULL, '2022-12-01 12:00:00', '2022-12-01 12:00:00'),
('invoice_starting_number', '1', 0, NULL, NULL, '2022-12-01 12:00:00', '2022-12-01 12:00:00'),
('invoice_number_padding', '5', 0, NULL, NULL, '2022-12-01 12:00:00', '2022-12-01 12:00:00'),
('invoice_series', 'PRO', 0, NULL, NULL, '2022-12-01 12:00:00', '2022-12-01 12:00:00'),
('invoice_series_paid', 'INV', 0, NULL, NULL, '2022-12-01 12:00:00', '2022-12-01 12:00:00')
ON DUPLICATE KEY UPDATE
`value` = VALUES(`value`),
`public` = VALUES(`public`),
`updated_at` = VALUES(`updated_at`);

-- Activate core modules expected by client/admin templates.
INSERT INTO `extension` (`id`, `type`, `name`, `status`, `version`) VALUES
(1, 'mod', 'company', 'installed', '1.0.0'),
(2, 'mod', 'client', 'installed', '1.0.0'),
(3, 'mod', 'invoice', 'installed', '1.0.0'),
(4, 'mod', 'order', 'installed', '1.0.0'),
(5, 'mod', 'currency', 'installed', '1.0.0'),
(6, 'mod', 'support', 'installed', '1.0.0'),
(7, 'mod', 'profile', 'installed', '1.0.0')
ON DUPLICATE KEY UPDATE
`type` = VALUES(`type`),
`name` = VALUES(`name`),
`status` = VALUES(`status`),
`version` = VALUES(`version`);

-- Ensure a default active currency exists.
INSERT INTO `currency` (`id`, `title`, `code`, `is_default`, `conversion_rate`, `format`, `price_format`, `created_at`, `updated_at`) VALUES
(2, 'Euro', 'EUR', 1, 1.000000, 'EUR {{price}}', '3', '2026-03-17 14:58:30', '2026-03-17 15:15:00')
ON DUPLICATE KEY UPDATE
`title` = VALUES(`title`),
`code` = VALUES(`code`),
`is_default` = VALUES(`is_default`),
`conversion_rate` = VALUES(`conversion_rate`),
`format` = VALUES(`format`),
`price_format` = VALUES(`price_format`),
`updated_at` = VALUES(`updated_at`);

-- Create default helpdesk mailbox used by support module screens.
INSERT INTO `support_helpdesk` (`id`, `name`, `email`, `close_after`, `can_reopen`, `signature`, `created_at`, `updated_at`) VALUES
(1, 'General', 'info@yourdomain.com', 24, 0, 'It is always a pleasure to help.\nHave a Nice Day !', '2022-12-01 12:00:00', '2022-12-01 12:00:00')
ON DUPLICATE KEY UPDATE
`name` = VALUES(`name`),
`email` = VALUES(`email`),
`close_after` = VALUES(`close_after`),
`can_reopen` = VALUES(`can_reopen`),
`signature` = VALUES(`signature`),
`updated_at` = VALUES(`updated_at`);
