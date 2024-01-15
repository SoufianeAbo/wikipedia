<?php if (isset($_SESSION['id'])) { ?>
    <?php if ($_SESSION['role'] == 'auteur') { ?>
        <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 border-r border-gray-200 sm:translate-x-0 bg-gray-800 border-gray-700" aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="../dashboardWikis.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="ms-3"><i class="fa-solid fa-globe mr-2"></i>Wikis</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    <?php } else { ?>
        <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 border-r border-gray-200 sm:translate-x-0 bg-gray-800 border-gray-700" aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="../dashboardWikis.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="ms-3"><i class="fa-solid fa-globe mr-2"></i>Wikis</span>
                        </a>
                    </li>
                    <li>
                        <a href="../tags.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="ms-3"><i class="fa-solid fa-tags mr-2"></i>Tags</span>
                        </a>
                    </li>
                    <li>
                        <a href="../dashboardAdmin.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="ms-3"><i class="fa-solid fa-list mr-2"></i>Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="../statistics.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <span class="ms-3"><i class="fa-solid fa-cat mr-2"></i>Statistics</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    <?php } ?>
<?php } else { ?>
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 border-r border-gray-200 sm:translate-x-0 bg-gray-800 border-gray-700" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="../dashboardWikis.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <span class="ms-3"><i class="fa-solid fa-globe mr-2"></i>Wikis</span>
                    </a>
                </li>
                <li>
                    <a href="../index.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <span class="ms-3"><i class="fa-solid fa-user mr-2"></i>Register</span>
                    </a>
                </li>

            </ul>
        </div>
    </aside>
<?php } ?>