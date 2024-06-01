-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2023 a las 18:11:01
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enlace` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_acti` int(11) NOT NULL DEFAULT 0,
  `id_tema` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_curso` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `nombre`, `enlace`, `estado_acti`, `id_tema`, `id_user`, `id_curso`, `created_at`, `updated_at`) VALUES
(1, 'T11ASDASD', 'https://es.educaplay.com/recursos-educativos/8193796-los_sentidos_en_guarani.html', 1, 1, 2, 2, '2023-11-22 09:01:01', '2023-11-22 09:01:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id`, `estado`, `fecha`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'P', '2023-11-22', 2, '2023-11-22 09:02:52', '2023-11-22 09:02:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia_detalles`
--

CREATE TABLE `asistencia_detalles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `verificar` int(11) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `asistencia_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asistencia_detalles`
--

INSERT INTO `asistencia_detalles` (`id`, `estado`, `fecha`, `verificar`, `user_id`, `asistencia_id`, `created_at`, `updated_at`) VALUES
(1, 'presente', '2023-11-22', 1, 3, 1, '2023-11-22 09:02:52', '2023-11-22 09:03:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloques`
--

CREATE TABLE `bloques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_b` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bloques`
--

INSERT INTO `bloques` (`id`, `nombre`, `estado_b`, `created_at`, `updated_at`) VALUES
(1, 'BLOQUE CERO', 1, NULL, NULL),
(2, 'BLOQUE ACADEMICO', 1, NULL, NULL),
(3, 'BLOQUE CIERRE', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_curso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_curso` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre_curso`, `estado_curso`, `created_at`, `updated_at`) VALUES
(1, 'TODOS', 1, NULL, NULL),
(2, 'SEXTO A', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_bloques`
--

CREATE TABLE `detalle_bloques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `id_tema` bigint(20) UNSIGNED DEFAULT NULL,
  `id_bloque` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_recurso` bigint(20) UNSIGNED NOT NULL,
  `id_curso` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_bloques`
--

INSERT INTO `detalle_bloques` (`id`, `titulo`, `descripcion`, `archivo`, `imagen`, `video`, `estado`, `id_tema`, `id_bloque`, `id_user`, `id_recurso`, `id_curso`, `created_at`, `updated_at`) VALUES
(1, 'RTRYT', NULL, NULL, '20231122045941.jpg', 'https://www.youtube.com/embed/Hs49jA6FizM?si=-BY6CMj2YtjAwKgM', 1, 1, 2, 2, 1, 2, '2023-11-22 08:59:41', '2023-11-22 08:59:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes`
--

CREATE TABLE `examenes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_eval` int(11) NOT NULL DEFAULT 0,
  `id_tema` bigint(20) UNSIGNED NOT NULL,
  `id_trimestre` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_curso` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `examenes`
--

INSERT INTO `examenes` (`id`, `nombre`, `estado_eval`, `id_tema`, `id_trimestre`, `id_user`, `id_curso`, `created_at`, `updated_at`) VALUES
(1, 'VC1', 1, 1, 1, 2, 2, '2023-11-22 09:02:07', '2023-11-22 09:02:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_materia` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `descripcion`, `estado_materia`, `created_at`, `updated_at`) VALUES
(1, 'GUARANI', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2012_11_17_202001_create_permission_tables', 1),
(2, '2012_12_10_114307_create_bloques_table', 1),
(3, '2012_12_15_114409_create_trimestres_table', 1),
(4, '2013_12_10_112826_create_cursos_table', 1),
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2022_12_10_114813_create_recursos_table', 1),
(9, '2022_12_10_115036_create_materias_table', 1),
(10, '2022_12_10_115128_create_temas_table', 1),
(11, '2022_12_10_115210_create_examenes_table', 1),
(12, '2022_12_10_115439_create_preguntas_table', 1),
(13, '2022_12_10_115549_create_respuestas_table', 1),
(14, '2022_12_10_115651_create_detalle_bloques_table', 1),
(15, '2022_12_10_115933_create_asistencias_table', 1),
(16, '2022_12_10_120006_create_asistencia_detalles_table', 1),
(17, '2022_12_10_120035_create_notas_table', 1),
(18, '2022_12_10_120238_create_actividades_table', 1),
(19, '2022_12_10_120419_create_tables_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 7),
(5, 'App\\Models\\User', 3),
(5, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nota_res` int(11) NOT NULL,
  `id_examen` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin.permisos.index', 'Listado de Roles y Permisos vista Admin', 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(2, 'admin.cursos.index', 'Listado de Cursos vista Admin', 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(3, 'admin.materias.index', 'Listado de Materias vista Admin', 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(4, 'admin.usuarios.index', 'Listado de Usuarios vista Admin', 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(5, 'director.profesores.index', 'Listado de Profesores vista Director', 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(6, 'secretaria.estudiantes.index', 'Listado de estudiantes vista Secretaria', 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(7, 'estudiante.asistencias.index', 'Asistencias vista Alumno', 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(8, 'estudiante.respuesta.index', 'Dashboard vista Estudiante ', 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(9, 'profesor.actividades.index', 'Listado de actividades vista Profesor ', 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(10, 'profesor.asistencias.index', 'Listado de Asistencias vista Profesor', 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(11, 'profesor.bloques.index', 'Listado de Recursos de Bloques vista Profesor', 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(12, 'profesor.dash.index', 'Dasboard vista Profesor ', 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(13, 'profesor.estudiantes.index', 'Listado de estudiantes vista Profesor', 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(14, 'profesor.evaluaciones.index', 'Listado de evaluaciones vista profesor', 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(15, 'profesor.preguntes.index', 'Listado de preguntas vista Profesor', 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(16, 'profesor.reportes.index', 'Listado de reportes vista Profesor ', 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(17, 'profesor.temas.index', 'Listado de temas vista Profesor ', 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detalle_pre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_examen` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `detalle_pre`, `id_examen`, `created_at`, `updated_at`) VALUES
(1, 'ASDASDA', 1, '2023-11-22 09:02:43', '2023-11-22 09:02:43'),
(2, 'ASDASDASD', 1, '2023-11-22 09:02:43', '2023-11-22 09:02:43'),
(3, 'DASDASDA', 1, '2023-11-22 09:02:43', '2023-11-22 09:02:43'),
(4, 'ASDASDASD', 1, '2023-11-22 09:02:43', '2023-11-22 09:02:43'),
(5, 'ASDASD', 1, '2023-11-22 09:02:43', '2023-11-22 09:02:43'),
(6, 'ASDASDASD', 1, '2023-11-22 09:02:43', '2023-11-22 09:02:43'),
(7, 'ASDASDASD', 1, '2023-11-22 09:02:43', '2023-11-22 09:02:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'RETROALIMENTACION', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `respuesta` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eval` int(11) NOT NULL,
  `id_pregunta` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `respuesta`, `eval`, `id_pregunta`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 'zczxczxc', 1, 1, 3, '2023-11-22 09:04:43', '2023-11-22 09:04:43'),
(2, 'zxczxczxc', 1, 2, 3, '2023-11-22 09:04:43', '2023-11-22 09:04:43'),
(3, 'zxczxczxc', 1, 3, 3, '2023-11-22 09:04:43', '2023-11-22 09:04:43'),
(4, 'zxczxc', 1, 4, 3, '2023-11-22 09:04:43', '2023-11-22 09:04:43'),
(5, 'zxczxc', 1, 5, 3, '2023-11-22 09:04:43', '2023-11-22 09:04:43'),
(6, 'zxczxczxc', 1, 6, 3, '2023-11-22 09:04:43', '2023-11-22 09:04:43'),
(7, 'zxczxczxc', 1, 7, 3, '2023-11-22 09:04:43', '2023-11-22 09:04:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_rol` int(11) DEFAULT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `estado_rol`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', 1, 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(3, 'PROFESOR', 1, 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(5, 'ESTUDIANTE', 1, 'web', '2023-11-22 08:50:57', '2023-11-22 08:50:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 5),
(8, 5),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tables`
--

CREATE TABLE `tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(11) NOT NULL,
  `eval` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tables`
--

INSERT INTO `tables` (`id`, `user`, `eval`, `estado`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 0, '2023-11-22 09:04:43', '2023-11-22 09:04:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detalle_tema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recurso` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `curso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_tema` int(11) NOT NULL,
  `id_materia` bigint(20) UNSIGNED NOT NULL,
  `id_bloque` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`id`, `titulo`, `detalle_tema`, `recurso`, `curso`, `estado_tema`, `id_materia`, `id_bloque`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 'T1', 'T1', 'RESULTADOS FINALES PET 01_2023.pdf', '2', 1, 1, 2, 2, '2023-11-22 08:58:59', '2023-11-22 08:58:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trimestres`
--

CREATE TABLE `trimestres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_t` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `trimestres`
--

INSERT INTO `trimestres` (`id`, `descripcion`, `estado_t`, `created_at`, `updated_at`) VALUES
(1, 'PRIMER TRIMESTRE', 1, NULL, NULL),
(2, 'SEGUNDO TRIMESTRE', 1, NULL, NULL),
(3, 'TERCER TRIMESTRE', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `id_rol` bigint(20) UNSIGNED NOT NULL,
  `id_curso` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre_user`, `apellido_user`, `genero`, `direccion`, `email`, `email_verified_at`, `password`, `remember_token`, `estado_user`, `id_rol`, `id_curso`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'M', 'Indefinido', 'admin@gmail.com', NULL, '$2y$10$NAM/vTdFSCuqG0eU7AUUdevaA7wfThtIZynsaHbEJWPw2Y/pFvKVe', NULL, '1', 1, 1, '2023-11-22 08:50:57', '2023-11-22 08:50:57'),
(2, 'PROFESOR1', 'PROFESOR1', 'F', 'INDEFINIDOS', 'profesor@gmail.com', NULL, '$2y$10$1PbCacdapKUXQw3S2LTucuhfzW12ZxKyR7asD1PL0r9WZ80/GtEfO', NULL, '1', 3, 2, '2023-11-22 08:50:57', '2023-11-24 21:00:42'),
(3, 'ESTUDIANTE0000000000000000', 'ESTUDIANTE0000000000000000', 'M', 'INDEFINIDO000000000000000000000000', 'estudiante@gmail.com', NULL, '$2y$10$FZUWU8.lpcNgOQmKShwmcuCvoWmwlW60wN29hgZcz5x5UdFpWysH6', NULL, '1', 5, 2, '2023-11-22 08:50:57', '2023-11-24 21:02:14'),
(5, 'ASDAS', 'ASDASD', 'M', 'ASDASDA', 'charonsoliz22@gmail.com', NULL, '$2y$10$Aaz6dKZ3De7C3PopzJ3sf.A7pjj/dQ9UexAawNnPp8lj7dXefKDp.', NULL, '1', 5, 2, '2023-11-24 20:47:04', '2023-11-24 20:47:04'),
(7, 'ASDASASD', 'ASDASDASD', 'F', 'ASDASDASD', 'profesorwewewe@gmail.com', NULL, '$2y$10$vBlwv62earK9Pq0sbXO9iuf19.MfGWqpeolY1O/W3vnpS8D.pGwfe', NULL, '1', 3, 2, '2023-11-24 21:01:38', '2023-11-24 21:01:38');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actividades_id_tema_foreign` (`id_tema`),
  ADD KEY `actividades_id_user_foreign` (`id_user`),
  ADD KEY `actividades_id_curso_foreign` (`id_curso`);

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asistencias_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `asistencia_detalles`
--
ALTER TABLE `asistencia_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asistencia_detalles_user_id_foreign` (`user_id`),
  ADD KEY `asistencia_detalles_asistencia_id_foreign` (`asistencia_id`);

--
-- Indices de la tabla `bloques`
--
ALTER TABLE `bloques`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_bloques`
--
ALTER TABLE `detalle_bloques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_bloques_id_tema_foreign` (`id_tema`),
  ADD KEY `detalle_bloques_id_bloque_foreign` (`id_bloque`),
  ADD KEY `detalle_bloques_id_user_foreign` (`id_user`),
  ADD KEY `detalle_bloques_id_recurso_foreign` (`id_recurso`),
  ADD KEY `detalle_bloques_id_curso_foreign` (`id_curso`);

--
-- Indices de la tabla `examenes`
--
ALTER TABLE `examenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examenes_id_tema_foreign` (`id_tema`),
  ADD KEY `examenes_id_trimestre_foreign` (`id_trimestre`),
  ADD KEY `examenes_id_user_foreign` (`id_user`),
  ADD KEY `examenes_id_curso_foreign` (`id_curso`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notas_id_examen_foreign` (`id_examen`),
  ADD KEY `notas_id_user_foreign` (`id_user`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preguntas_id_examen_foreign` (`id_examen`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `respuestas_id_pregunta_foreign` (`id_pregunta`),
  ADD KEY `respuestas_id_user_foreign` (`id_user`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `temas_id_materia_foreign` (`id_materia`),
  ADD KEY `temas_id_bloque_foreign` (`id_bloque`);

--
-- Indices de la tabla `trimestres`
--
ALTER TABLE `trimestres`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_rol_foreign` (`id_rol`),
  ADD KEY `users_id_curso_foreign` (`id_curso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `asistencia_detalles`
--
ALTER TABLE `asistencia_detalles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `bloques`
--
ALTER TABLE `bloques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_bloques`
--
ALTER TABLE `detalle_bloques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `examenes`
--
ALTER TABLE `examenes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `trimestres`
--
ALTER TABLE `trimestres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_id_curso_foreign` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `actividades_id_tema_foreign` FOREIGN KEY (`id_tema`) REFERENCES `temas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `actividades_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD CONSTRAINT `asistencias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `asistencia_detalles`
--
ALTER TABLE `asistencia_detalles`
  ADD CONSTRAINT `asistencia_detalles_asistencia_id_foreign` FOREIGN KEY (`asistencia_id`) REFERENCES `asistencias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asistencia_detalles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_bloques`
--
ALTER TABLE `detalle_bloques`
  ADD CONSTRAINT `detalle_bloques_id_bloque_foreign` FOREIGN KEY (`id_bloque`) REFERENCES `bloques` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_bloques_id_curso_foreign` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_bloques_id_recurso_foreign` FOREIGN KEY (`id_recurso`) REFERENCES `recursos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_bloques_id_tema_foreign` FOREIGN KEY (`id_tema`) REFERENCES `temas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_bloques_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `examenes`
--
ALTER TABLE `examenes`
  ADD CONSTRAINT `examenes_id_curso_foreign` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `examenes_id_tema_foreign` FOREIGN KEY (`id_tema`) REFERENCES `temas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `examenes_id_trimestre_foreign` FOREIGN KEY (`id_trimestre`) REFERENCES `trimestres` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `examenes_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_id_examen_foreign` FOREIGN KEY (`id_examen`) REFERENCES `examenes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notas_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_id_examen_foreign` FOREIGN KEY (`id_examen`) REFERENCES `examenes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_id_pregunta_foreign` FOREIGN KEY (`id_pregunta`) REFERENCES `preguntas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respuestas_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `temas_id_bloque_foreign` FOREIGN KEY (`id_bloque`) REFERENCES `bloques` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `temas_id_materia_foreign` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_curso_foreign` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_id_rol_foreign` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
