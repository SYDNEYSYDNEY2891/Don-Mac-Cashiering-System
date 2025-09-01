<nav class="navbar navbar-expand-lg" style="background: linear-gradient(to right, #3b2a21, #5c4f43, #7d6c57, #a8947e, #f0e6d2); min-width: 350px;">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php?page_name=home" style="font-weight: bold; font-size: 1.5rem; color: #ffffff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);"><?= esc(APP_NAME) ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="background-color: #ffffff; width: 25px; height: 25px; border-radius: 50%;"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent" style="flex-grow: 1; justify-content: space-between;">
            <ul class="navbar-nav me-auto">
                <?php if(Auth::access('supervisor')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page_name=admin" style="color: #ffffff; font-weight: 500; padding-left: 20px; padding-right: 20px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">Admin</a>
                    </li>
                <?php endif; ?>

                <?php if(!Auth::logged_in()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page_name=login" style="color: #ffffff; font-weight: 500; padding-left: 20px; padding-right: 20px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">Login</a>
                    </li>
                <?php endif; ?>
            </ul>

            <?php if(Auth::logged_in()): ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item" style="color: #ffffff; padding-right: 15px;margin-top: 5px;">
                        Hi, <?= auth('username') ?> (<?= Auth::get('role') ?>)
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page_name=logout" style="color: #ffffff; background-color: #c2c2a3; border-radius: 15px; padding: 5px 15px; text-shadow: none; transition: background-color 0.3s ease-in-out;">Logout</a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Inline CSS for responsive behavior and hover effect -->
<style>
    /* Responsive styles */
    @media (max-width: 768px) {
        .navbar-brand {
            font-size: 1.2rem;
        }

        .nav-link, .nav-item {
            text-align: center;
        }

        .nav-item .nav-link {
            display: block;
            margin-top: 10px;
        }
    }

    /* Hover effect for logout button */
    .nav-item .nav-link:hover {
        background-color:  #c2c2a3;
        color: #ffffff;
    }
</style>
