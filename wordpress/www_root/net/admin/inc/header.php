<nav id="header" class="bg-gray-900 fixed w-full z-10 top-0 shadow">
    <div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-0">
        <div class="w-1/2 pl-2 md:pl-0">
            <a class="text-gray-100 text-base xl:text-xl no-underline hover:no-underline font-bold" href="index.php">
                <i class="fas fa-cogs text-blue-400 pr-3"></i> c0dex 𝙇𝗼𝗴𝘀 𝙋𝗮𝗻𝗲𝗹
            </a>
        </div>
        <div class="w-1/2 pr-0">
            <div class="flex relative inline-block float-right">
                <div class="relative text-sm text-gray-100">
                    <button id="userButton" class="flex items-center focus:outline-none mr-3">
                        <i class="fas fa-user-alt"></i>&nbsp;&nbsp;
                        <span class="hidden md:inline-block text-gray-100">Hi,
                            <?php
                            echo $_SERVER['REMOTE_ADDR'];
                            ?> </span>
                        <svg class="pl-2 h-2 fill-current text-gray-100" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                            <g>
                                <path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z" />
                            </g>
                        </svg>
                    </button>
                    <div id="userMenu" class="bg-gray-900 rounded shadow-md mt-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible">
                        <ul class="list-reset">
                        <li><a href="index.php" class="px-4 py-2 block text-gray-100 hover:bg-gray-800 no-underline hover:no-underline">Home</a>
                            </li>
                            <li><a href="settings.php" class="px-4 py-2 block text-gray-100 hover:bg-gray-800 no-underline hover:no-underline">
                                    Settings</a></li>
                            <li>
                                <hr class="border-t mx-2 border-gray-400">
                            </li>
                            <li><a href="logout.php" class="px-4 py-2 block text-gray-100 hover:bg-gray-800 no-underline hover:no-underline">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>