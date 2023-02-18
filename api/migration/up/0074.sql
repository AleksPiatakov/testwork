CREATE TABLE `cached`
(
    `key`        varchar(128) NOT NULL UNIQUE,
    `value`      text         NOT NULL,
    `expiration` bigint       NULL
) ENGINE = MyISAM
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;