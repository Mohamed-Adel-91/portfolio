-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 06, 2025 at 11:32 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'My Career Journey Through Code', '<span style=\"color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">From Public Prosecution of Cairo Traffic to Backend Development</span><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><span style=\"color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">I didn’t start in tech. I started in government. But my passion for logic, structure, and creating real solutions led me to learn Computer Sciences Basics then go deeper to Laravel and PHP from the ground up, while working a full-time job in Public Prosecution of Cairo Traffic. for 3 years of learning journey Every spare hour became a line of code, every weekend a step closer to becoming a full-stack or backend developer.</span><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><span style=\"color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">Over the past year, I’ve helped build dashboards, CMS platforms, and scalable APIs for real-world clients in Egypt and the Gulf. I focus on clean architecture, efficient databases, and writing code that’s built to last.</span><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><span style=\"color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">What sets me apart?</span><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><span style=\"color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">- I understand business constraints, because I’ve worked outside of tech and in a government career.</span><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><span style=\"color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">- I prioritize clarity, communication, and maintainable systems.</span><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><span style=\"color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">- I deliver on time, even with limited resources.</span><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><span style=\"color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">Selected Highlights:</span><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><span style=\"color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">- Reduced API response time for websites used by 5,000+ users/month.</span><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><span style=\"color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">- Delivered 8+ fully functional CMS systems customized to different business needs.</span><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><span style=\"color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">- Reduced admin panel loading time by 50% using Laravel optimization techniques.</span><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><span style=\"color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">- Implemented reusable modules to reduce future dev time by 30% across projects.</span><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><span style=\"color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">- Integrated complex permission systems across user roles using Spatie &amp; Laravel Policies.</span><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><span style=\"color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">Top Skill:</span><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><span style=\"color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">Turning complex backend logic into reliable, testable, and scalable Laravel applications.</span><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><br style=\"box-sizing: inherit; font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; color: rgba(0, 0, 0, 0.9); font-size: 14px;\"><span style=\"color: rgba(0, 0, 0, 0.9); font-family: -apple-system, system-ui, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, &quot;Fira Sans&quot;, Ubuntu, Oxygen, &quot;Oxygen Sans&quot;, Cantarell, &quot;Droid Sans&quot;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Lucida Grande&quot;, Helvetica, Arial, sans-serif; font-size: 14px;\">Let’s connect. I’m always open to new projects or collaborations where backend excellence matters.</span>', '1764678207o2zQcTTlsiELMMXMjFOE.png', '2025-12-01 18:49:41', '2025-12-02 12:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `profile_picture`, `created_at`, `updated_at`) VALUES
(1, 'Mohamed', 'Adel', 'mohamed101291@gmail.com', '$2y$10$YRLFmLLB6EdPfOSue9abg.ZLKrcdxKAa49kDZpVKtPdQfSNMiS8KO', '01067000662', 'images/profile.png', '2025-12-01 17:32:33', '2025-12-01 17:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `industry` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `industry`, `location`, `logo`, `website`, `created_at`, `updated_at`) VALUES
(1, 'Icon Creations', NULL, NULL, NULL, NULL, '2025-12-06 17:22:29', '2025-12-06 17:22:29'),
(2, 'Public Prosecution Service of Egypt - Ministry of Justice', NULL, NULL, NULL, NULL, '2025-12-06 17:22:29', '2025-12-06 17:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `contact_requests`
--

CREATE TABLE `contact_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply_status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_requests`
--

INSERT INTO `contact_requests` (`id`, `first_name`, `last_name`, `email`, `subject`, `message`, `reply_status`, `created_at`, `updated_at`) VALUES
(1, '‪Mohamed', 'Adel‬‏', 'mohamed101291@gmail.com', 'gfdjnsh', 'tdyue', '1', '2025-12-01 19:07:34', '2025-12-03 08:33:44');

-- --------------------------------------------------------

--
-- Table structure for table `contact_requests_replay`
--

CREATE TABLE `contact_requests_replay` (
  `id` bigint UNSIGNED NOT NULL,
  `contact_request_id` bigint UNSIGNED NOT NULL,
  `reply_message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_requests_replay`
--

INSERT INTO `contact_requests_replay` (`id`, `contact_request_id`, `reply_message`, `created_at`, `updated_at`) VALUES
(1, 1, 'thanks', '2025-12-03 08:33:44', '2025-12-03 08:33:44'),
(2, 1, 'thanks 2', '2025-12-03 08:34:30', '2025-12-03 08:34:30');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` bigint UNSIGNED NOT NULL,
  `university_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_at` date DEFAULT NULL,
  `end_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `university_id`, `type`, `title`, `sub_title`, `description`, `image`, `icon`, `start_at`, `end_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bachelor\'s', 'Faculty of Commerce', 'Accounting and Business Adminstration', NULL, NULL, NULL, '2008-09-01', '2012-05-01', '2025-12-03 08:38:02', '2025-12-06 23:01:46'),
(2, 2, 'Online Course', 'Computerized Accounting & Fentech', 'Fentech', NULL, NULL, NULL, '2012-01-01', '2012-03-01', '2025-12-03 08:53:06', '2025-12-06 18:07:41'),
(3, 3, 'Nanodgree', 'Advanced full-stack Web Development', 'Web Development', NULL, NULL, NULL, '2022-11-01', '2023-04-01', '2025-12-03 09:33:51', '2025-12-03 09:33:51'),
(4, 3, 'Online Course', 'Web Development Challenger', 'Web Development', NULL, 'education/1765062148rBkBVwrEdzM8209Eua2c.jpg', NULL, '2022-07-01', '2022-10-01', '2025-12-03 09:36:43', '2025-12-06 23:02:28'),
(5, 3, 'Nanodegree', 'Android Basics Nanodegree by Google', 'Android Basics', NULL, 'education/1765062081IdEoZQ602EosRlhjN1qL.jpg', NULL, '2019-07-01', '2020-02-01', '2025-12-03 09:38:36', '2025-12-06 23:01:21'),
(6, 4, 'Course', 'CS50’s Introduction to Computer Science', 'Computer Science', 'Skills: Algorithms · C (Programming Language) · JavaScript · GitHub · Git · Python (Programming Language) · Dynamic Random-Access Memory (DRAM) · Databases · HTML5 · emoj · Data Structures · Flask', 'education/1765062162DwQMqKWS1LGoNjkzSVhf.jpg', NULL, '2022-12-01', '2023-12-01', '2025-12-03 09:48:47', '2025-12-06 23:02:42'),
(7, 5, 'Nanodegree', 'Software Engineering - BackEnd Development', 'Software Engineering', NULL, NULL, NULL, '2023-06-01', '2024-09-01', '2025-12-03 09:51:43', '2025-12-03 09:52:10'),
(8, 6, 'Diploma', 'Data Science and AI Diploma', 'Data Science', 'Machine Learning & Artificial Intelligence Diploma – AMIT Learning (6 Months)\r\n\r\nA comprehensive hands-on program covering the full data science and AI lifecycle. The diploma included intensive training in Python for Data Science, SQL, data analysis, data visualization, and real-world machine learning workflows. I gained practical experience with NumPy, Pandas, Matplotlib, Seaborn, Scikit-learn, TensorFlow, Keras, and PyTorch.\r\n\r\nThe curriculum covered:\r\n\r\nData Science fundamentals and the difference between Data Science & Data Engineering\r\n\r\nPython programming for AI and scientific computing\r\n\r\nDatabases and SQL for data extraction\r\n\r\nData cleaning, preprocessing, and exploratory data analysis (EDA)\r\n\r\nData visualization and dashboarding\r\n\r\nMachine Learning algorithms (regression, classification, clustering)\r\n\r\nModel evaluation, optimization, and deployment concepts\r\n\r\nDeep Learning using Keras, TensorFlow, and PyTorch\r\n\r\nNeural networks, CNNs, RNNs, and advanced DL concepts\r\n\r\nAI project workflows and MLOps fundamentals\r\n\r\nGraduation Projects:\r\n\r\nCOVID-19 predictive analysis\r\n\r\nMedical diagnostics using ML\r\n\r\nFinancial data analysis and forecasting\r\n\r\nThe diploma included continuous mentorship, instructor support, and a ticketing system for troubleshooting and guidance to ensure full mastery of all modules.', NULL, NULL, '2025-12-19', '2026-07-31', '2025-12-03 09:58:48', '2025-12-03 09:58:48'),
(9, 7, 'Course', 'Huawei Cloud Developer – HCCDA Tech Essentials', 'Huawei Cloud Development', 'Skills: HCCDA · Cloud Computing · Cloud Computing IaaS · Huawei Cloud Services · Cloud Architecture Basics · Virtual Private Cloud (VPC) · Elastic Cloud Server (ECS) · Object Storage Service (OBS) · Identity and Access Management (IAM) · Data Security & Encryption Basics · Networking & Security Groups · Database Services (RDS, TaurusDB) · API & Service Integration · Networking Fundamentals (CIDR, Subnets, Routing, SNAT) · Infrastructure as a Service (IaaS) · Platform as a Service (PAAS) · Software as a Service (SaaS)', 'education/1764760603BhAv4cegubYjMOjrrBLb.jpeg', NULL, '2025-09-01', '2025-10-31', '2025-12-03 11:16:43', '2025-12-06 18:00:20'),
(10, 8, 'Course', 'Cybersecurity Awareness', 'Cybersecurity', NULL, 'education/176506228479q9o7GJA5vumITOrYyc.jpg', NULL, '2025-11-15', '2025-11-30', '2025-12-06 23:04:44', '2025-12-06 23:04:44');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `work_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_at` date DEFAULT NULL,
  `end_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`id`, `company_id`, `work_type`, `title`, `sub_title`, `description`, `image`, `icon`, `start_at`, `end_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Part-time', 'Back-end Developer', 'On-Site', 'At Icon Creations, I played a pivotal role in developing robust backend systems and dynamic dashboards for esteemed clients like Orascom and Knowledge Net. My responsibilities included designing RESTful APIs, optimizing databases, and ensuring seamless integration with front-end teams. I focused on enhancing system performance, CMS content management system and managing deployments, which contributed to delivering exceptional client solutions.', 'experience/17647617423gslRGhg9AeNaNScfo8j.png', NULL, '2023-11-01', NULL, '2025-12-03 11:27:13', '2025-12-03 11:35:42'),
(2, 2, 'Full-time', 'ERP Systems Administration & Head of Criminal Registry Operations', 'On-Site', '• Oversaw all reports and violations received by the Public Prosecution, ensuring accurate documentation and timely processing.  \r\n• Managed the ERP systems for the Agouza Traffic Prosecution, enhancing operational efficiency.  \r\n• Issued clearance certificates, contributing to a streamlined workflow and improved public service delivery.', 'experience/17647617260YcVyacrUQspiHNH5tYf.png', NULL, '2019-11-01', NULL, '2025-12-03 11:35:26', '2025-12-03 11:37:50'),
(3, 2, 'Full-time', 'IT & Data Entry Supervisor', 'On-Site', '• Supervised the IT and data entry operations for recording traffic violations at the Public Prosecution Service of Egypt.  \r\n• Enhanced data accuracy and efficiency by implementing streamlined processes and training staff.  \r\n• Collaborated with cross-functional teams to ensure compliance with legal standards and improve reporting systems.', 'experience/1764763785nsPVzJN47dYwmAKOys5R.png', NULL, '2018-03-01', '2019-11-01', '2025-12-03 12:09:45', '2025-12-03 12:14:41'),
(4, 2, 'Full-time', 'Data Entry Specialist', 'On-Site', '• Recorded and processed over 1,000 traffic violation reports daily for the Public Prosecution Service of Egypt.  \r\n• Ensured accuracy and compliance with legal standards, contributing to the efficiency of the Ministry of Justice.  \r\n• Collaborated with law enforcement agencies to streamline data entry processes, enhancing overall workflow.', 'experience/1764764768ejz21BwvFXUzP0w2eOd8.png', NULL, '2017-01-01', '2018-03-01', '2025-12-03 12:26:08', '2025-12-03 12:26:08'),
(5, 2, 'Full-time', 'Prosecutor\'s Secretary - Secretary to the Head of the Giza Traffic Prosecutions', 'On-Site', '• Provided comprehensive administrative support to the Head of the Giza Traffic Prosecution, ensuring efficient office operations.  \r\n• Managed case files and documentation, facilitating timely processing and adherence to legal protocols.  \r\n• Coordinated communication between various departments, enhancing collaboration and information flow within the Public Prosecution Service.', 'experience/1764764892Gq1179IwO26BmSxfaGVL.png', NULL, '2015-09-05', '2017-01-01', '2025-12-03 12:28:12', '2025-12-03 12:28:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iframe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `sub_title`, `image`, `iframe`, `created_at`, `updated_at`) VALUES
(1, 'Career Expo Event', 'Career Expo Event', '1765061880nNNmYfwlghGZPVZ6czau.jpeg', NULL, '2025-12-06 22:58:00', '2025-12-06 22:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `intro`
--

CREATE TABLE `intro` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv_pdf` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `intro`
--

INSERT INTO `intro` (`id`, `name`, `title`, `image`, `cv_pdf`, `created_at`, `updated_at`) VALUES
(1, 'Mohamed Nouh', 'Software Developer', '1764613412dji2Ia3HZ1P1nTkuNmhm.png', '17650599916brpK24szLOKDK3l4lNp.pdf', '2025-12-01 17:36:55', '2025-12-06 22:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_06_155035_create_settings_table', 1),
(6, '2024_03_23_162327_create_contact_requests_table', 1),
(7, '2024_03_24_162327_create_contact_requests_replay_table', 1),
(8, '2024_04_29_172920_create_admins_table', 1),
(9, '2024_09_21_202011_create_about_table', 1),
(10, '2024_09_21_202011_create_intro_table', 1),
(11, '2024_09_21_202059_create_education_table', 1),
(12, '2024_09_21_202143_create_experience_table', 1),
(13, '2024_09_21_202222_create_projects_table', 1),
(14, '2024_09_21_202229_create_portfolio_table', 1),
(15, '2024_09_21_202239_create_gallery_table', 1),
(16, '2024_09_21_202618_create_resume_table', 1),
(17, '2024_09_21_202640_create_skills_table', 1),
(18, '2025_05_08_183903_create_messages_table', 1),
(19, '2025_05_14_155920_add_columns_to_settings_table', 1),
(20, '2025_05_10_000000_create_companies_table', 2),
(21, '2025_05_10_000100_create_universities_table', 2),
(22, '2025_05_10_000200_update_experience_table_add_company_id', 2),
(23, '2025_05_10_000300_update_education_table_add_university_id', 2),
(24, '2025_05_10_000500_update_skills_table_add_logo', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `project_id`, `title`, `sub_title`, `image`, `created_at`, `updated_at`) VALUES
(1, 3, 'Dashboard', 'Login page', '1765061558JESY1BhOTBfH4JofNm4t.png', '2025-12-06 22:52:38', '2025-12-06 22:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lunched_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `image`, `url`, `lunched_at`, `created_at`, `updated_at`) VALUES
(1, 'Netflex Clone', 'Single Landing Page HTML & CSS Native', '1764765256ltWDe3LoIoqTcaiYPPbN.png', 'https://mohamed-adel-91.github.io/Netflex_clone/', '2023-08-23', '2025-12-03 12:34:16', '2025-12-06 22:48:10'),
(2, 'Game Hub', 'Game Hub is website created by React.js with typescript', '1765061391J09FxxWTYWKyybqcgNkK.png', 'https://game-hub-hazel-two.vercel.app/', '2023-12-18', '2025-12-06 22:49:51', '2025-12-06 22:49:51'),
(3, 'Orascom Services', 'Orascom Services CMS Dashboard', '1765061486hP0ybzGx2QvOQNC5QwlL.png', 'https://dev-iconcreations.com/2024/Orascom-website/public/en', '2024-06-10', '2025-12-06 22:51:26', '2025-12-06 22:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

CREATE TABLE `resume` (
  `id` bigint UNSIGNED NOT NULL,
  `head_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BwhgQ7idY1GGJzQad0GQJJh31i5gxqT7gzhOaK61', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiODhzNTVKTExTYnZTc0pyd2R0YVpBZU5lVGtZOXNMTEluV3B1YVlmZyI7czo2OiJsb2NhbGUiO3M6MjoiZW4iO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkL3Byb2plY3RzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1765063877);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slogan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whats_up` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `messenger` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `customers` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `activity_terms` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `google_play` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_store` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ad_link_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ad_link_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `email`, `slogan`, `address`, `phone1`, `phone2`, `whats_up`, `facebook`, `messenger`, `twitter`, `instagram`, `youtube`, `linkedin`, `github`, `meta_title`, `meta_description`, `meta_tags`, `customers`, `created_at`, `updated_at`, `activity_terms`, `google_play`, `app_store`, `ad_link_1`, `ad_link_2`) VALUES
(1, 'mohamed101291@gmail.com', 'Realize your dream with us', 'Orabi st., Agouza , Giza , Egypt', '+201208333047', '+201067000662', '+201208333047', 'https://www.facebook.com/mohamed.adel.101291/', 'https://m.me/mohamed.adel.101291/', 'https://x.com/MohamedTaha1012', 'https://instagram.com/example', 'https://www.youtube.com/channel/UCkGudCvAEYSVVFW8uFEkeyQ', 'https://www.linkedin.com/in/mohamed-adel-nouh/', 'https://github.com/Mohamed-Adel-91', 'Welcome to Our Website', 'We provide top-tier services to meet your needs.', 'web, services, company, example', 50, NULL, '2025-12-02 11:36:32', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `progress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `type`, `progress`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'HTML', 'frontend', '95', 'skills/1765046484kUR1migGDZZYGb12jQfQ.svg', '2025-12-06 18:41:24', '2025-12-06 20:20:50'),
(2, 'CSS', 'frontend', '70', 'skills/1765047651FjWZSEL5bMetl3Fae44p.svg', '2025-12-06 19:00:51', '2025-12-06 19:00:51'),
(3, 'Bootstrap', 'frontend', '80', 'skills/1765047680sj3hW4bbRI7EWk3ShoPQ.svg', '2025-12-06 19:01:20', '2025-12-06 19:01:20'),
(4, 'JavaScript', 'backend', '75', 'skills/1765049775CFiKPkZABcFR5TcnjiLa.svg', '2025-12-06 19:02:08', '2025-12-06 19:36:15'),
(5, 'PHP', 'backend', '80', 'skills/1765047764VeLQeALdxymg7VBjLuqz.svg', '2025-12-06 19:02:44', '2025-12-06 19:02:44'),
(6, '.ENV', 'devops', '70', 'skills/1765047831ub60kBQmtLnEYposGvry.svg', '2025-12-06 19:03:51', '2025-12-06 19:03:51'),
(7, 'Laravel', 'backend', '90', 'skills/1765047859aYQyiL7BdNoU1Yc3j3zP.svg', '2025-12-06 19:04:19', '2025-12-06 19:04:19'),
(8, 'Git', 'general', '80', 'skills/1765047897emByU7XwpGQv3vdncFre.svg', '2025-12-06 19:04:57', '2025-12-06 19:04:57'),
(9, 'GitHub', 'tools', '90', 'skills/1765053434Ch6uEG7uxgtSi34jCkhw.svg', '2025-12-06 19:05:23', '2025-12-06 20:40:31'),
(10, 'MySQL', 'database', '75', 'skills/1765047985Ha4zaDF3TyOz9C4cyaZ4.svg', '2025-12-06 19:06:25', '2025-12-06 21:43:31'),
(11, 'phpMyAdmin', 'tools', '80', 'skills/1765048035DMIGwipkveP4JcKxoA1z.svg', '2025-12-06 19:07:15', '2025-12-06 19:07:15'),
(12, 'Node.js', 'backend', '40', 'skills/1765048208c9ZRqHccz2uRPOyIt9pG.svg', '2025-12-06 19:10:08', '2025-12-06 22:18:31'),
(13, 'Huawei Cloud Services', 'devops', '60', 'skills/1765049658sc4ugZHkyXFHTRd9ZJp7.svg', '2025-12-06 19:34:18', '2025-12-06 19:34:18'),
(14, 'Sass', 'frontend', '60', 'skills/1765049834VZqyZ8Xn7cvjb74bMcMR.svg', '2025-12-06 19:37:14', '2025-12-06 19:37:14'),
(15, 'tailwind-CSS', 'frontend', '50', 'skills/1765049884aqNljlYLJ9yIVdoWgTMS.svg', '2025-12-06 19:38:04', '2025-12-06 19:38:04'),
(16, 'React.js', 'frontend', '40', 'skills/1765049916hYw4puUtAbZ6t5QF4OR7.svg', '2025-12-06 19:38:36', '2025-12-06 19:38:36'),
(17, 'MongoDB', 'database', '30', 'skills/1765049983mPeOp0Q4vqLgxoJxcufF.svg', '2025-12-06 19:39:43', '2025-12-06 21:43:50'),
(18, 'Digital Ocean', 'devops', '60', 'skills/1765050346YDfitPgWiBRQD0LCvQyk.svg', '2025-12-06 19:45:46', '2025-12-06 19:45:46'),
(19, 'Hostinger', 'devops', '75', 'skills/1765050388bjgoI4bCYYyQ7RxMRQym.svg', '2025-12-06 19:46:28', '2025-12-06 19:46:28'),
(20, 'Python', 'data_science_and_analytics', '50', 'skills/1765050413k2GP87CAihrBewCReejp.svg', '2025-12-06 19:46:53', '2025-12-06 21:37:20'),
(21, 'Jest', 'testing', '50', 'skills/17650504647na0aEyKUWNwTRdLozcU.svg', '2025-12-06 19:47:44', '2025-12-06 19:47:44'),
(22, 'Jasmine', 'testing', '50', 'skills/1765050490FwLD641n7AWfZvuKmvdT.svg', '2025-12-06 19:48:10', '2025-12-06 19:48:10'),
(23, 'PHP Unit', 'testing', '60', 'skills/17650507759zlbbQ3ofgOm9Io7xaXq.svg', '2025-12-06 19:52:55', '2025-12-06 20:29:51'),
(24, 'Docker', 'devops', '30', 'skills/1765050940HyuCeRZGsdX7ED9Kfa82.svg', '2025-12-06 19:55:40', '2025-12-06 19:55:40'),
(25, 'Linux', 'general', '60', 'skills/1765053571ktMzrWUn9ASoEhejBa83.svg', '2025-12-06 20:39:31', '2025-12-06 20:39:31'),
(26, 'Terminal', 'general', '60', 'skills/1765053658PaxPVybnOM1J0Bik3B48.svg', '2025-12-06 20:40:58', '2025-12-06 20:40:58'),
(27, 'cpanel', 'tools', '70', 'skills/1765053760oR6yGNoDwGhahDQvl4cL.svg', '2025-12-06 20:42:40', '2025-12-06 20:42:40'),
(28, 'VScode', 'tools', '80', 'skills/1765053889Qw1TZRQtD7Ssc6kcQ4na.svg', '2025-12-06 20:44:49', '2025-12-06 20:44:49'),
(29, 'Express.js', 'backend', '30', 'skills/1765053990ZGxyMdHR8yAqU1exKF8Z.svg', '2025-12-06 20:46:30', '2025-12-06 20:46:30'),
(30, 'JWT', 'backend', '70', 'skills/1765054138KKBTon5sjdExEDUfVk07.svg', '2025-12-06 20:48:58', '2025-12-06 20:48:58'),
(31, 'Postgresql', 'database', '40', 'skills/1765055562NE1wjDzl3ODMAj5ZzQ0G.svg', '2025-12-06 21:12:42', '2025-12-06 21:43:40'),
(32, 'SQLite', 'database', '50', 'skills/1765055615duWOWxD1L92PZ6ZR75lD.svg', '2025-12-06 21:13:35', '2025-12-06 21:44:00'),
(33, 'C++', 'backend', '10', 'skills/1765055680sLMHCALTwZZe9sXeBu1s.svg', '2025-12-06 21:14:40', '2025-12-06 21:14:40'),
(34, 'Work Agile', 'personal_skills', '90', 'skills/1765055940AQMB6yEACUdV8E7oPFS7.jpg', '2025-12-06 21:19:00', '2025-12-06 21:19:00'),
(35, 'Power PI', 'data_science_and_analytics', '20', 'skills/1765057133pblp6aHo7nG6DtI1YOrq.png', '2025-12-06 21:38:53', '2025-12-06 21:38:53'),
(36, 'Microsoft Excel', 'data_science_and_analytics', '80', 'skills/1765057217055uW69JgLYn1x9VMgqb.png', '2025-12-06 21:40:17', '2025-12-06 21:40:17'),
(37, 'C', 'backend', '10', 'skills/1765057315BgDIF2YdOvmrnOddoKRR.svg', '2025-12-06 21:41:55', '2025-12-06 21:41:55'),
(38, 'Leadership', 'personal_skills', '80', 'skills/1765057861RCHmE48CiuhxWrwR2qhR.png', '2025-12-06 21:51:01', '2025-12-06 21:51:01'),
(39, 'Innovation', 'personal_skills', '70', 'skills/1765057980xQVsVM80l5o9VLawc8hp.png', '2025-12-06 21:53:00', '2025-12-06 21:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`id`, `name`, `country`, `city`, `logo`, `website`, `created_at`, `updated_at`) VALUES
(1, 'Ain Shams University', NULL, NULL, NULL, NULL, '2025-12-06 17:22:29', '2025-12-06 17:22:29'),
(2, 'Lane Community College', NULL, NULL, NULL, NULL, '2025-12-06 17:22:29', '2025-12-06 17:22:29'),
(3, 'Udacity', NULL, NULL, NULL, NULL, '2025-12-06 17:22:29', '2025-12-06 17:22:29'),
(4, 'Edx by Harvard University', NULL, NULL, NULL, NULL, '2025-12-06 17:22:29', '2025-12-06 17:22:29'),
(5, 'ALX by Helberton School', NULL, NULL, NULL, NULL, '2025-12-06 17:22:29', '2025-12-06 17:22:29'),
(6, 'AMIT - Licensed by the Ministry of Communications and Information Technology', NULL, NULL, NULL, NULL, '2025-12-06 17:22:29', '2025-12-06 17:22:29'),
(7, 'Huawei Cloud', NULL, NULL, NULL, NULL, '2025-12-06 17:22:29', '2025-12-06 17:22:29'),
(8, 'HP-Life', NULL, NULL, NULL, NULL, '2025-12-06 23:03:13', '2025-12-06 23:03:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_name_unique` (`name`);

--
-- Indexes for table `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_requests_replay`
--
ALTER TABLE `contact_requests_replay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_requests_replay_contact_request_id_foreign` (`contact_request_id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `education_university_id_foreign` (`university_id`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experience_company_id_foreign` (`company_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intro`
--
ALTER TABLE `intro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portfolio_project_id_foreign` (`project_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `universities_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_requests`
--
ALTER TABLE `contact_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_requests_replay`
--
ALTER TABLE `contact_requests_replay`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `intro`
--
ALTER TABLE `intro`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `resume`
--
ALTER TABLE `resume`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_requests_replay`
--
ALTER TABLE `contact_requests_replay`
  ADD CONSTRAINT `contact_requests_replay_contact_request_id_foreign` FOREIGN KEY (`contact_request_id`) REFERENCES `contact_requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_university_id_foreign` FOREIGN KEY (`university_id`) REFERENCES `universities` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `experience_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD CONSTRAINT `portfolio_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
