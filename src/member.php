<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Member.class.php");

$member = new Member($db_host, $db_user, $db_pass, $db_name);
$member->open();
$member->getMember();

// ADD
if (isset($_POST['add'])) {
    //memanggil add
    $member->add($_POST);
    header("location:member.php");
}

// DELETE
if (!empty($_GET['id_hapus'])) {
    //memanggil add
    $id = $_GET['id_hapus'];

    $member->delete($id);
    header("location:member.php");
}

$data = null;
$no = 1;


while (list($nim, $nama, $jurusan) = $member->getResult()){
    $data .= "<tr>
        <td class='px-4 py-2 border-t text-center'>" . $no++ . "</td>
        <td class='px-4 py-2 border-t border-l text-center'>" . $nim . "</td>
        <td class='px-4 py-2 border-t border-l text-center'>" . $nama . "</td>
        <td class='px-4 py-2 border-t border-l text-center'>" . $jurusan . "</td>
        <td class='px-4 py-3 border-t border-l flex flex-row justify-evenly'> 
            <a href='member.php?id_hapus=" . $nim . "' class='px-2 py-2 rounded-md text-sm bg-red-500 hover:bg-red-600 text-white text-center focus:border-red-500 focus:ring-red-500 focus:ring-1 focus:ring-offset-2'>Hapus</a> 
            <a href='detail.php?id_update=" . $nim . "' class='px-2 py-2 rounded-md text-sm bg-slate-100 border hover:bg-slate-600 hover:text-white text-black text-center focus:border-slate-500 focus:ring-slate-500 focus:ring-1 focus:ring-offset-2 duration-100'>Update</a> 
        </td>
    </tr>";
}




$member->close();
$tpl = new Template("templates/member.html");
$tpl->replace("DATA_TABEL", $data);
$tpl->write();


?>