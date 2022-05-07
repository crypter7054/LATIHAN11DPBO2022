<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Member.class.php");

$member = new Member($db_host, $db_user, $db_pass, $db_name);
$member->open();

$data = null;

if (isset($_GET['id_update'])) {
    $id = $_GET['id_update'];
    
    $member->getMemberUpdate($id);
    $row = $member->getResult();

    $data .= '<div class="rounded-lg px-[7.5rem] py-4 text-center">
        <p class="text-sm">' . $row['nim'] . '</p>
        <p class="text-lg font-medium">' . $row['nama'] . '</p>
        <p class="text-lg font-normal">' . $row['jurusan'] . '</p>
        </div>
        <div class="mt-5 w-1/2 pb-8">
        <a href="update.php?id_ubah=' . $row['nim'] . '" > <button type="button" class="inline-flex justify-center py-2 px-4 w-full border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
        Ubah Data
        </button>
        </a></div>';

}



$member->close();
$tpl = new Template("templates/detail.html");
$tpl->replace("DATA_MEMBER", $data);
$tpl->write();


?>