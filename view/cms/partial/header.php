<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo $this->asset('css/cms.css'); ?>">
</head>
<body>
    <div class="cms">
        <header class="cmsHeader">
            <button class="cmsPageTitle cmsMenuToggle" id="cmsMenuToggle">MENU<?php echo !empty( $this->_PAGE_TITLE ) ? ' → '. $this->_PAGE_TITLE : ''; ?></button>
        </header>
        <div class="cmsBody">
            <div class="cmsContent">
                <?php require_once VIEW_CMS_PARTIAL_PATH.DS.'message.php'; ?>