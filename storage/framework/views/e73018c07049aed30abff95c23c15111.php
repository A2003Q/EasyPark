<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ParkEasy | My Profile</title>

  <link rel="stylesheet" href="<?php echo e(asset('landing/css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('landing/css/style.css')); ?>">
  <!-- font css -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: #f5f7fa;
    }

    /* Background with animated overlay */
    .profile-bg {
      min-height: 100vh;
      position: relative;
      padding: 140px 0 60px;
    }
    
    .profile-bg::before {
      content: "";
      position: fixed;
      inset: 0;
      background-image: url("<?php echo e(asset('landing/images/login-bg.jpg')); ?>");
      background-size: cover;
      background-position: center;
      filter: blur(3px) brightness(0.9);
      transform: scale(1.0);
      z-index: -2;
    }
    
    .profile-bg::after {
      content: "";
      position: fixed;
      inset: 0;
      background: linear-gradient(135deg, rgba(58, 58, 94, 0.75) 0%, rgba(88, 88, 124, 0.65) 50%, rgba(58, 58, 94, 0.75) 100%);
      z-index: -1;
    }

    /* Floating shapes animation */
    .profile-bg .shape {
      position: fixed;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.05);
      z-index: -1;
      animation: float 20s infinite ease-in-out;
    }

    .profile-bg .shape1 {
      width: 300px;
      height: 300px;
      top: 10%;
      left: 5%;
      animation-delay: 0s;
    }

    .profile-bg .shape2 {
      width: 200px;
      height: 200px;
      bottom: 15%;
      right: 10%;
      animation-delay: 5s;
    }

    .profile-bg .shape3 {
      width: 150px;
      height: 150px;
      top: 50%;
      right: 20%;
      animation-delay: 10s;
    }

    @keyframes float {
      0%, 100% {
        transform: translate(0, 0) scale(1);
      }
      25% {
        transform: translate(30px, -30px) scale(1.1);
      }
      50% {
        transform: translate(-20px, 20px) scale(0.9);
      }
      75% {
        transform: translate(20px, 30px) scale(1.05);
      }
    }

    /* Enhanced Box Design with glass effect */
    .box {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 30px;
      box-shadow: 
        0 25px 70px rgba(0, 0, 0, 0.12),
        0 10px 40px rgba(58, 58, 94, 0.08),
        inset 0 1px 0 rgba(255, 255, 255, 0.8);
      border: 1px solid rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(20px);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      overflow: hidden;
      position: relative;
    }

    .box::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(58, 58, 94, 0.03) 0%, transparent 70%);
      animation: rotate 30s linear infinite;
      pointer-events: none;
    }

    @keyframes rotate {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    .box:hover {
      box-shadow: 
        0 30px 80px rgba(0, 0, 0, 0.15),
        0 15px 50px rgba(58, 58, 94, 0.12),
        inset 0 1px 0 rgba(255, 255, 255, 0.9);
      transform: translateY(-5px);
    }

    /* Typography with gradient */
    .tab-title {
      background: linear-gradient(135deg, #3a3a5e 0%, #5a5a7e 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      font-weight: 800;
      font-size: 26px;
      margin-bottom: 8px;
      letter-spacing: -0.8px;
    }

    .section-subtitle {
      color: #6c6c86;
      font-size: 14px;
      font-weight: 500;
    }

    .muted {
      color: #6c6c86;
      font-weight: 600;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 8px;
    }

    /* Enhanced Pill Badge with glow */
    .pill {
      display: inline-block;
      padding: 10px 20px;
      border-radius: 999px;
      background: linear-gradient(135deg, #3a3a5e 0%, #4a4a6e 100%);
      color: #fff;
      font-weight: 700;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      box-shadow: 
        0 4px 15px rgba(58, 58, 94, 0.4),
        0 0 20px rgba(58, 58, 94, 0.2);
      position: relative;
      overflow: hidden;
    }

    .pill::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
      transform: rotate(45deg);
      animation: shine 3s infinite;
    }

    @keyframes shine {
      0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
      100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
    }

    /* Layout */
    .profile-layout {
      display: flex;
      gap: 28px;
      align-items: flex-start;
      position: relative;
    }

    /* Creative Sidebar Design */
    .profile-sidebar {
      width: 320px;
      position: sticky;
      top: 160px;
      height: fit-content;
      max-height: calc(100vh - 180px);
      overflow: hidden;
    }

    .profile-sidebar .box {
      border-radius: 35px;
    }

    .sidebar-inner {
      max-height: calc(100vh - 220px);
      overflow-y: auto;
      padding-right: 5px;
    }

    .sidebar-inner::-webkit-scrollbar {
      width: 5px;
    }

    .sidebar-inner::-webkit-scrollbar-track {
      background: transparent;
    }

    .sidebar-inner::-webkit-scrollbar-thumb {
      background: linear-gradient(180deg, #3a3a5e 0%, #6c6c86 100%);
      border-radius: 10px;
    }

    /* User Avatar with 3D effect */
    .side .account-header {
      text-align: center;
      padding: 30px 20px;
      position: relative;
      margin-bottom: 25px;
    }

    .side .account-header::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 60%;
      height: 2px;
      background: linear-gradient(90deg, transparent, #3a3a5e, transparent);
    }

    .side .user-avatar {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      background: linear-gradient(135deg, #3a3a5e 0%, #5a5a7e 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 15px;
      font-size: 36px;
      color: white;
      font-weight: 700;
      box-shadow: 
        0 10px 30px rgba(58, 58, 94, 0.4),
        0 0 0 8px rgba(58, 58, 94, 0.1),
        0 0 0 16px rgba(58, 58, 94, 0.05);
      position: relative;
      animation: pulse 3s infinite;
    }

    @keyframes pulse {
      0%, 100% {
        box-shadow: 
          0 10px 30px rgba(58, 58, 94, 0.4),
          0 0 0 8px rgba(58, 58, 94, 0.1),
          0 0 0 16px rgba(58, 58, 94, 0.05);
      }
      50% {
        box-shadow: 
          0 15px 40px rgba(58, 58, 94, 0.5),
          0 0 0 12px rgba(58, 58, 94, 0.15),
          0 0 0 24px rgba(58, 58, 94, 0.08);
      }
    }

    .side .user-avatar::before {
      content: '';
      position: absolute;
      inset: -3px;
      border-radius: 50%;
      background: linear-gradient(135deg, #3a3a5e, #6c6c86);
      z-index: -1;
      opacity: 0.5;
      filter: blur(10px);
    }

    .side .user-name {
      font-size: 20px;
      font-weight: 700;
      color: #3a3a5e;
      margin-bottom: 5px;
      letter-spacing: -0.3px;
    }

    .side .user-email {
      font-size: 13px;
      color: #6c6c86;
      opacity: 0.8;
    }

    /* Creative Tab Links */
    .side .tab-link {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 16px 18px;
      border-radius: 18px;
      font-weight: 600;
      font-size: 15px;
      color: #3a3a5e;
      text-decoration: none;
      cursor: pointer;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      margin-bottom: 8px;
      position: relative;
      overflow: hidden;
    }

    .side .tab-link::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      width: 5px;
      height: 100%;
      background: linear-gradient(180deg, #3a3a5e 0%, #5a5a7e 100%);
      transform: scaleY(0);
      transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .side .tab-link::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(58, 58, 94, 0.08) 0%, rgba(90, 90, 126, 0.05) 100%);
      opacity: 0;
      transition: opacity 0.4s ease;
      border-radius: 18px;
    }

    .side .tab-link:hover {
      transform: translateX(8px);
      color: #3a3a5e;
    }

    .side .tab-link:hover::after {
      opacity: 1;
    }

    .side .tab-link.active {
      background: linear-gradient(135deg, #3a3a5e 0%, #4a4a6e 100%);
      color: #fff;
      box-shadow: 
        0 8px 25px rgba(58, 58, 94, 0.35),
        0 0 0 1px rgba(255, 255, 255, 0.1) inset;
      transform: translateX(8px) scale(1.02);
    }

    .side .tab-link.active::before {
      transform: scaleY(1);
    }

    .side .tab-link.active::after {
      opacity: 0;
    }

    .side .tab-icon {
      font-size: 22px;
      width: 28px;
      text-align: center;
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }

    .side .breeze-info {
      margin-top: 25px;
      padding: 18px;
      background: linear-gradient(135deg, #f7f8fc 0%, #eef0f7 100%);
      border-radius: 16px;
      border: 1px solid rgba(58, 58, 94, 0.1);
      position: relative;
      overflow: hidden;
    }

    .side .breeze-info::before {
      content: '⚙️';
      position: absolute;
      font-size: 60px;
      right: -10px;
      bottom: -15px;
      opacity: 0.08;
    }

    .side .breeze-info .muted {
      font-size: 10px;
      margin-bottom: 10px;
    }

    .side .breeze-info b {
      color: #3a3a5e;
      font-size: 13px;
      font-weight: 700;
    }

    /* Tabs with smooth animation */
    .profile-tab {
      display: none;
      animation: slideUp 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .profile-tab.active {
      display: block;
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Creative Profile Header */
    .profile-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 35px;
      padding-bottom: 28px;
      position: relative;
    }

    .profile-header::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 2px;
      background: linear-gradient(90deg, #3a3a5e 0%, transparent 100%);
    }

    .profile-header-left h1 {
      font-size: 30px;
      font-weight: 800;
      background: linear-gradient(135deg, #3a3a5e 0%, #5a5a7e 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 6px;
      letter-spacing: -1px;
    }

    /* Creative Info Grid with hover effects */
    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 24px;
    }

    .info-item {
      padding: 28px;
      background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
      border-radius: 22px;
      border: 2px solid transparent;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }

    .info-item::before {
      content: '';
      position: absolute;
      inset: 0;
      border-radius: 22px;
      padding: 2px;
      background: linear-gradient(135deg, #3a3a5e, #6c6c86);
      -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
      -webkit-mask-composite: xor;
      mask-composite: exclude;
      opacity: 0;
      transition: opacity 0.4s ease;
    }

    .info-item:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0 15px 40px rgba(58, 58, 94, 0.15);
    }

    .info-item:hover::before {
      opacity: 1;
    }

    .info-item .muted {
      display: block;
      margin-bottom: 10px;
      position: relative;
      z-index: 1;
    }

    .info-item .info-value {
      font-size: 17px;
      font-weight: 600;
      color: #3a3a5e;
      word-break: break-word;
      position: relative;
      z-index: 1;
    }

    /* Creative Reservation Cards */
    .reservation-card {
      padding: 25px;
      margin-bottom: 20px;
      background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
      border-radius: 24px;
      border: 2px solid #eef0f7;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }

    .reservation-card::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      width: 6px;
      height: 100%;
      background: linear-gradient(180deg, #3a3a5e 0%, #5a5a7e 100%);
      box-shadow: 0 0 15px rgba(58, 58, 94, 0.5);
    }

    .reservation-card::after {
      content: '🚗';
      position: absolute;
      font-size: 80px;
      right: -15px;
      bottom: -15px;
      opacity: 0.04;
    }

    .reservation-card:hover {
      border-color: #3a3a5e;
      box-shadow: 0 12px 35px rgba(58, 58, 94, 0.15);
      transform: translateX(10px);
    }

    .reservation-card .parking-name {
      font-size: 20px;
      font-weight: 700;
      color: #3a3a5e;
      margin-bottom: 15px;
      position: relative;
      z-index: 1;
    }

    .reservation-card .reservation-details {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      font-size: 13px;
      color: #6c6c86;
      position: relative;
      z-index: 1;
    }

    .reservation-card .reservation-details .detail-item {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px 14px;
      background: rgba(58, 58, 94, 0.05);
      border-radius: 12px;
      transition: all 0.3s ease;
    }

    .reservation-card .reservation-details .detail-item:hover {
      background: rgba(58, 58, 94, 0.1);
      transform: scale(1.05);
    }

    .reservation-card .reservation-details .detail-item span {
      font-weight: 700;
      color: #3a3a5e;
    }

    /* Creative Subscription Card */
    .subscription-card {
      padding: 40px;
      background: linear-gradient(135deg, #3a3a5e 0%, #4a4a6e 50%, #3a3a5e 100%);
      border-radius: 28px;
      color: white;
      box-shadow: 
        0 20px 50px rgba(58, 58, 94, 0.4),
        0 0 0 1px rgba(255, 255, 255, 0.1) inset;
      margin-bottom: 28px;
      position: relative;
      overflow: hidden;
    }

    .subscription-card::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
      animation: rotate 25s linear infinite;
    }

    .subscription-card::after {
      content: '💎';
      position: absolute;
      font-size: 150px;
      right: -30px;
      top: -30px;
      opacity: 0.08;
    }

    .subscription-card .subscription-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 35px;
      padding-bottom: 25px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.15);
      position: relative;
      z-index: 1;
    }

    .subscription-card .plan-name {
      font-size: 36px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 2px;
      text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .subscription-card .status-badge {
      padding: 10px 20px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 999px;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .subscription-card .subscription-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
      gap: 20px;
      position: relative;
      z-index: 1;
    }

    .subscription-card .sub-item {
      background: rgba(255, 255, 255, 0.12);
      padding: 20px;
      border-radius: 18px;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.15);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }

    .subscription-card .sub-item::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, transparent 100%);
      opacity: 0;
      transition: opacity 0.4s ease;
    }

    .subscription-card .sub-item:hover {
      background: rgba(255, 255, 255, 0.2);
      transform: translateY(-8px) scale(1.05);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .subscription-card .sub-item:hover::before {
      opacity: 1;
    }

    .subscription-card .sub-item .label {
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 1px;
      opacity: 0.85;
      margin-bottom: 8px;
    }

    .subscription-card .sub-item .value {
      font-size: 22px;
      font-weight: 800;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    /* Creative Progress Bar */
    .progress-wrapper {
      margin-top: 30px;
      position: relative;
      z-index: 1;
    }

    .progress-label {
      display: flex;
      justify-content: space-between;
      font-size: 13px;
      margin-bottom: 10px;
      opacity: 0.95;
      font-weight: 600;
    }

    .progress-bar-custom {
      height: 14px;
      background: rgba(0, 0, 0, 0.2);
      border-radius: 999px;
      overflow: hidden;
      backdrop-filter: blur(10px);
      box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.2);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .progress-bar-fill {
      height: 100%;
      background: linear-gradient(90deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 1) 100%);
      border-radius: 999px;
      transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 
        0 0 20px rgba(255, 255, 255, 0.6),
        inset 0 1px 0 rgba(255, 255, 255, 0.8);
      position: relative;
      overflow: hidden;
    }

    .progress-bar-fill::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
      animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
      0% { transform: translateX(-100%); }
      100% { transform: translateX(100%); }
    }

    /* No Subscription State */
    .no-subscription {
      text-align: center;
      padding: 80px 40px;
      position: relative;
    }

    .no-subscription::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(58, 58, 94, 0.02) 0%, rgba(108, 108, 134, 0.02) 100%);
      border-radius: 24px;
    }

    .no-subscription .icon {
      font-size: 80px;
      margin-bottom: 25px;
      opacity: 0.4;
      filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
      animation: bounce 2s infinite;
    }

    @keyframes bounce {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-10px);
      }
    }

    .no-subscription .title {
      font-size: 26px;
      font-weight: 700;
      color: #3a3a5e;
      margin-bottom: 15px;
      position: relative;
      z-index: 1;
    }

    .no-subscription .description {
      color: #6c6c86;
      font-size: 15px;
      margin-bottom: 35px;
      line-height: 1.6;
      position: relative;
      z-index: 1;
    }

    /* Creative Button */
    .btn-custom {
      display: inline-block;
      padding: 16px 40px;
      background: linear-gradient(135deg, #3a3a5e 0%, #4a4a6e 100%);
      color: white;
      font-weight: 700;
      font-size: 15px;
      border-radius: 999px;
      text-decoration: none;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border: none;
      cursor: pointer;
      box-shadow: 
        0 8px 25px rgba(58, 58, 94, 0.4),
        0 0 0 1px rgba(255, 255, 255, 0.1) inset;
      position: relative;
      overflow: hidden;
    }

    .btn-custom::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, transparent 100%);
      opacity: 0;
      transition: opacity 0.4s ease;
    }

    .btn-custom:hover {
      background: linear-gradient(135deg, #2d2d48 0%, #3d3d58 100%);
      transform: translateY(-5px) scale(1.05);
      box-shadow: 
        0 15px 40px rgba(58, 58, 94, 0.5),
        0 0 0 1px rgba(255, 255, 255, 0.2) inset;
      color: white;
    }

    .btn-custom:hover::before {
      opacity: 1;
    }

    .btn-custom:active {
      transform: translateY(-2px) scale(1.02);
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 60px 30px;
      color: #6c6c86;
      position: relative;
    }

    .empty-state::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(58, 58, 94, 0.02) 0%, transparent 100%);
      border-radius: 24px;
    }

    .empty-state .icon {
      font-size: 60px;
      margin-bottom: 20px;
      opacity: 0.3;
      filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.05));
      animation: float 3s infinite ease-in-out;
    }

    .empty-state .message {
      font-size: 16px;
      font-weight: 500;
      position: relative;
      z-index: 1;
    }

    /* Responsive */
    @media (max-width: 992px) {
      .profile-layout {
        flex-direction: column;
      }

      .profile-sidebar {
        width: 100%;
        position: relative;
        top: auto;
        max-height: none;
      }

      .side .account-header {
        padding: 25px 20px;
      }

      .tab-title, .profile-header-left h1 {
        font-size: 24px;
      }

      .subscription-card .plan-name {
        font-size: 28px;
      }

      .info-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 576px) {
      .profile-bg {
        padding: 100px 0 40px;
      }

      .box {
        border-radius: 22px;
      }

      .tab-title, .profile-header-left h1 {
        font-size: 22px;
      }

      .subscription-card {
        padding: 25px;
      }

      .subscription-card .subscription-grid {
        grid-template-columns: 1fr;
      }

      .no-subscription {
        padding: 50px 25px;
      }
    }
  </style>
</head>
<body>

<?php echo $__env->make('landing.partials.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="profile-bg">
  <div class="shape shape1"></div>
  <div class="shape shape2"></div>
  <div class="shape shape3"></div>

  <div class="container user-page-wrap">

    <div class="profile-layout">

      
      <div class="box p-4 side profile-sidebar">
        <div class="sidebar-inner">
          <div class="account-header">
            <div class="user-avatar">
              <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

            </div>
            <div class="user-name"><?php echo e($user->name); ?></div>
            <div class="user-email"><?php echo e($user->email); ?></div>
          </div>

          <a class="tab-link active" data-target="tab-info">
            <span class="tab-icon">👤</span>
            <span>Profile Info</span>
          </a>
          <a class="tab-link" data-target="tab-res">
            <span class="tab-icon">🅿️</span>
            <span>Reservations</span>
          </a>
          <a class="tab-link" data-target="tab-sub">
            <span class="tab-icon">💳</span>
            <span>Subscription</span>
          </a>

          <div class="breeze-info">
            <div class="muted">Edit account details in Breeze:</div>
            <div><b>/profile</b></div>
          </div>
        </div>
      </div>

      
      <div style="flex:1;">

        
        <div id="tab-info" class="box p-5 mb-4 profile-tab active">
          <div class="profile-header">
            <div class="profile-header-left">
              <h1>Profile Information</h1>
              <p class="section-subtitle">Manage your personal account details</p>
            </div>
            <span class="pill"><?php echo e(strtoupper($user->role ?? 'user')); ?></span>
          </div>

          <div class="info-grid">
            <div class="info-item">
              <label class="muted">Full Name</label>
              <div class="info-value"><?php echo e($user->name); ?></div>
            </div>
            <div class="info-item">
              <label class="muted">Email Address</label>
              <div class="info-value"><?php echo e($user->email); ?></div>
            </div>
          </div>
        </div>

        
        <div id="tab-res" class="box p-5 mb-4 profile-tab">
          <div class="profile-header">
            <div class="profile-header-left">
              <h1>My Reservations</h1>
              <p class="section-subtitle">View and manage your parking reservations</p>
            </div>
          </div>

          <?php $__empty_1 = true; $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="reservation-card">
              <div class="parking-name">
                <?php echo e($r->parking->name ?? 'Parking'); ?>

              </div>
              <div class="reservation-details">
                <div class="detail-item">
                  <span>📍 Spot:</span> <?php echo e($r->spot->spot_number ?? '-'); ?>

                </div>
                <div class="detail-item">
                  <span>🕐 From:</span> <?php echo e($r->start_time); ?>

                </div>
                <div class="detail-item">
                  <span>🕐 To:</span> <?php echo e($r->end_time); ?>

                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-state">
              <div class="icon">🅿️</div>
              <div class="message">No reservations yet. Start booking your parking spots!</div>
            </div>
          <?php endif; ?>
        </div>

        
        <div id="tab-sub" class="box p-5 profile-tab">
          <div class="profile-header">
            <div class="profile-header-left">
              <h1>My Subscription</h1>
              <p class="section-subtitle">Manage your subscription plan and usage</p>
            </div>
          </div>

          <?php if($subscription): ?>
            <div class="subscription-card">
              <div class="subscription-header">
                <div class="plan-name"><?php echo e(strtoupper($subscription->plan)); ?></div>
                <div class="status-badge"><?php echo e(strtoupper($subscription->status)); ?></div>
              </div>

              <div class="subscription-grid">
                <div class="sub-item">
                  <div class="label">Price</div>
                  <div class="value"><?php echo e($subscription->price); ?> JOD</div>
                </div>

                <div class="sub-item">
                  <div class="label">Hours Limit</div>
                  <div class="value"><?php echo e($subscription->hours_limit); ?></div>
                </div>

                <div class="sub-item">
                  <div class="label">Hours Used</div>
                  <div class="value"><?php echo e($subscription->hours_used); ?></div>
                </div>

                <div class="sub-item">
                  <div class="label">Days Limit</div>
                  <div class="value"><?php echo e($subscription->days_limit); ?></div>
                </div>

                <div class="sub-item">
                  <div class="label">Days Used</div>
                  <div class="value"><?php echo e($subscription->days_used); ?></div>
                </div>

                <div class="sub-item">
                  <div class="label">Start Date</div>
                  <div class="value">
                    <?php echo e(\Carbon\Carbon::parse($subscription->start_date)->format('M d, Y')); ?>

                  </div>
                </div>

                <div class="sub-item">
                  <div class="label">End Date</div>
                  <div class="value">
                    <?php echo e(\Carbon\Carbon::parse($subscription->end_date)->format('M d, Y')); ?>

                  </div>
                </div>
              </div>

              <?php if($subscription->hours_limit > 0): ?>
              <div class="progress-wrapper">
                <div class="progress-label">
                  <span>Hours Usage</span>
                  <span><?php echo e($subscription->hours_used); ?> / <?php echo e($subscription->hours_limit); ?></span>
                </div>
                <div class="progress-bar-custom">
                  <div class="progress-bar-fill" style="width: <?php echo e(($subscription->hours_used / $subscription->hours_limit) * 100); ?>%"></div>
                </div>
              </div>
              <?php endif; ?>

              <?php if($subscription->days_limit > 0): ?>
              <div class="progress-wrapper">
                <div class="progress-label">
                  <span>Days Usage</span>
                  <span><?php echo e($subscription->days_used); ?> / <?php echo e($subscription->days_limit); ?></span>
                </div>
                <div class="progress-bar-custom">
                  <div class="progress-bar-fill" style="width: <?php echo e(($subscription->days_used / $subscription->days_limit) * 100); ?>%"></div>
                </div>
              </div>
              <?php endif; ?>
            </div>
          <?php else: ?>
            <div class="no-subscription">
              <div class="icon">💳</div>
              <div class="title">No Active Subscription</div>
              <div class="description">Subscribe to one of our plans to enjoy exclusive parking benefits and save time!</div>
              <a href="/subscriptions" class="btn-custom">Explore Subscription Plans</a>
            </div>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </div>
</div>


<?php if(session('success')): ?>
<script>
Swal.fire({
  icon: 'success',
  title: 'Success',
  text: <?php echo json_encode(session('success'), 15, 512) ?>,
  confirmButtonColor: '#3a3a5e',
  confirmButtonText: 'Great!'
});
</script>
<?php endif; ?>

<?php if(session('error')): ?>
<script>
Swal.fire({
  icon: 'error',
  title: 'Oops',
  text: <?php echo json_encode(session('error'), 15, 512) ?>,
  confirmButtonColor: '#3a3a5e',
  confirmButtonText: 'Try Again'
});
</script>
<?php endif; ?>

<script src="<?php echo e(asset('landing/js/bootstrap.bundle.min.js')); ?>"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const links = document.querySelectorAll('.tab-link');
  const tabs = document.querySelectorAll('.profile-tab');

  links.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      
      // Remove active class from all links
      links.forEach(l => l.classList.remove('active'));
      // Add active class to clicked link
      this.classList.add('active');

      // Hide all tabs
      tabs.forEach(t => t.classList.remove('active'));
      
      // Show target tab
      const target = this.dataset.target;
      const targetTab = document.getElementById(target);
      if (targetTab) {
        targetTab.classList.add('active');
      }
    });
  });
});
</script>

</body>
</html>


<?php /**PATH C:\Users\DELL\Downloads\Parking-Finder2-stage4-auth-flow\resources\views/user/profile/index.blade.php ENDPATH**/ ?>