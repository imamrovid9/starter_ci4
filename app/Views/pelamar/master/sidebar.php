<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Lowongan</li>
                <!-- . user()->username -->
                <li>
                    <a href="<?= base_url('/pelamar'); ?>">
                        <i class="dripicons-meter"></i>
                        <span>List Lowongan</span>
                    </a>
                </li>

                <li class="menu-title">Profile</li>
                <li>
                    <a href="<?= base_url('/pelamar/profile/' . user()->username . ''); ?>">
                        <i class=" fa fa-user"></i>
                        <span> Profile </span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->