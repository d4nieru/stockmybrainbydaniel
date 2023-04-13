-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 12 avr. 2023 à 22:21
-- Version du serveur : 8.0.30
-- Version de PHP : 8.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stockmybrain`
--

-- --------------------------------------------------------

--
-- Structure de la table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint UNSIGNED NOT NULL,
  `reason_for_the_meeting` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_date` date NOT NULL,
  `meeting_time` time NOT NULL,
  `videoconference_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `host_of_the_meeting_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `appointments`
--

INSERT INTO `appointments` (`id`, `reason_for_the_meeting`, `meeting_date`, `meeting_time`, `videoconference_link`, `is_active`, `host_of_the_meeting_id`, `created_at`, `updated_at`) VALUES
(1, 'UNGROSTEST', '2023-04-12', '18:59:00', 'https://meet.jit.si/UNGROSTEST?config.disableDeepLinking=true&config.toolbar.hide=true', 0, 1, '2023-04-12 14:55:55', '2023-04-12 15:01:52');

-- --------------------------------------------------------

--
-- Structure de la table `appointment_user`
--

CREATE TABLE `appointment_user` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `appointment_id` bigint UNSIGNED DEFAULT NULL,
  `workspace_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `appointment_user`
--

INSERT INTO `appointment_user` (`id`, `user_id`, `appointment_id`, `workspace_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '2023-04-12 14:55:55', '2023-04-12 14:55:55');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_12_22_233245_create_workspaces_table', 1),
(7, '2022_12_22_233348_create_user_workspace_table', 1),
(8, '2022_12_27_103544_create_tasks_table', 1),
(9, '2023_01_12_100538_create_task_workspace_table', 1),
(10, '2023_03_31_195242_create_appointments_table', 1),
(11, '2023_03_31_203840_create_appointment_user_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `importance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `task_workspace`
--

CREATE TABLE `task_workspace` (
  `id` bigint UNSIGNED NOT NULL,
  `task_id` bigint UNSIGNED DEFAULT NULL,
  `workspace_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `admin`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'DLF', 'a@a.com', 0, NULL, '$2y$10$HCxRpqxfU8Quwu13VE2rjufkyn2wUiDad7WFKyYQ5n31ctMLW6j/S', NULL, NULL, NULL, NULL, '2023-04-12 14:52:22', '2023-04-12 14:52:22'),
(2, 'FLD', 'b@b.com', 0, NULL, '$2y$10$TZwhbPTZ6ZPQmo51W628Y.DOKqef./CqfsYBoliOv.f6UAMts3Nsy', NULL, NULL, NULL, NULL, '2023-04-12 14:52:25', '2023-04-12 14:52:25');

-- --------------------------------------------------------

--
-- Structure de la table `user_workspace`
--

CREATE TABLE `user_workspace` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `workspace_id` bigint UNSIGNED DEFAULT NULL,
  `ownership` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `user_workspace`
--

INSERT INTO `user_workspace` (`id`, `user_id`, `workspace_id`, `ownership`, `admin`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2023-04-12 14:55:18', '2023-04-12 14:55:18'),
(2, 2, 1, 0, 0, '2023-04-12 14:55:33', '2023-04-12 14:55:33');

-- --------------------------------------------------------

--
-- Structure de la table `workspaces`
--

CREATE TABLE `workspaces` (
  `id` bigint UNSIGNED NOT NULL,
  `workspace_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `workspace_cover_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `workspace_cover_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `workspaces`
--

INSERT INTO `workspaces` (`id`, `workspace_name`, `workspace_cover_name`, `workspace_cover_path`, `created_at`, `updated_at`) VALUES
(1, 'AZERTY', NULL, NULL, '2023-04-12 14:55:18', '2023-04-12 14:55:18');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `appointment_user`
--
ALTER TABLE `appointment_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_user_user_id_foreign` (`user_id`),
  ADD KEY `appointment_user_appointment_id_foreign` (`appointment_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `task_workspace`
--
ALTER TABLE `task_workspace`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_workspace_task_id_foreign` (`task_id`),
  ADD KEY `task_workspace_user_id_foreign` (`user_id`),
  ADD KEY `task_workspace_workspace_id_foreign` (`workspace_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `user_workspace`
--
ALTER TABLE `user_workspace`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_workspace_user_id_foreign` (`user_id`),
  ADD KEY `user_workspace_workspace_id_foreign` (`workspace_id`);

--
-- Index pour la table `workspaces`
--
ALTER TABLE `workspaces`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `appointment_user`
--
ALTER TABLE `appointment_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `task_workspace`
--
ALTER TABLE `task_workspace`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user_workspace`
--
ALTER TABLE `user_workspace`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `workspaces`
--
ALTER TABLE `workspaces`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appointment_user`
--
ALTER TABLE `appointment_user`
  ADD CONSTRAINT `appointment_user_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointment_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `task_workspace`
--
ALTER TABLE `task_workspace`
  ADD CONSTRAINT `task_workspace_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_workspace_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_workspace_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_workspace`
--
ALTER TABLE `user_workspace`
  ADD CONSTRAINT `user_workspace_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_workspace_workspace_id_foreign` FOREIGN KEY (`workspace_id`) REFERENCES `workspaces` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
