<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Buku.class.php");
include("includes/Member.class.php");
include("includes/Peminjaman.class.php");

$buku = new Buku($db_host, $db_user, $db_pass, $db_name);
$member = new Member($db_host, $db_user, $db_pass, $db_name);
$peminjaman = new Peminjaman($db_host, $db_user, $db_pass, $db_name);

$buku->open();
$member->open();
$peminjaman->open();

$buku->getBuku();
$member->getMember();
$peminjaman->getPeminjaman();

$dataBuku = null;
$dataMember = null;
$data = null;
$no = 1;

// ADD
if (isset($_POST['add'])) {
    //memanggil add
    $peminjaman->add($_POST);
    header("location:peminjaman.php");
}

// DELETE
if (!empty($_GET['id_hapus'])) {
    $id = $_GET['id_hapus'];

    $peminjaman->delete($id);
    header("location:peminjaman.php");
}

// UPDATE
if (!empty($_GET['id_update'])) {
    $id = $_GET['id_update'];

    $peminjaman->statusPeminjaman($id);
    header("location:peminjaman.php");
}


while (list($id, $judul_buku, $nama, $status) = $peminjaman->getResult()) {
    if ($status == "Sudah") {
        $data .= "<tr>
        <td class='px-4 py-2 border-t text-center'>" . $no++ . "</td>
        <td class='px-4 py-2 border-t border-l text-center'>" . $judul_buku . "</td>
        <td class='px-4 py-2 border-t border-l text-center'>" . $nama . "</td>
        <td class='px-4 py-2 border-t border-l text-center'>" . $status . "</td>
        <td class='px-4 py-3 border-t border-l flex flex-row justify-evenly'> 
            <a href='peminjaman.php?id_hapus=" . $id . "' class='px-2 py-2 rounded-md text-sm bg-red-500 hover:bg-red-600 text-white text-center focus:border-red-500 focus:ring-red-500 focus:ring-1 focus:ring-offset-2'>Hapus</a> 
        </td>
    </tr>";
    }
    else {
        $data .= "<tr>
        <td class='px-4 py-2 border-t text-center'>" . $no++ . "</td>
        <td class='px-4 py-2 border-t border-l text-center'>" . $judul_buku . "</td>
        <td class='px-4 py-2 border-t border-l text-center'>" . $nama . "</td>
        <td class='px-4 py-2 border-t border-l text-center'>" . $status . "</td>
        <td class='px-4 py-3 border-t border-l flex flex-row justify-evenly'> 
            <a href='peminjaman.php?id_hapus=" . $id . "' class='px-2 py-2 rounded-md text-sm bg-red-500 hover:bg-red-600 text-white text-center focus:border-red-500 focus:ring-red-500 focus:ring-1 focus:ring-offset-2'>Hapus</a> 
            <a href='peminjaman.php?id_update=" . $id . "' class='px-2 py-2 rounded-md text-sm bg-slate-100 border hover:bg-slate-600 hover:text-white text-black text-center focus:border-slate-500 focus:ring-slate-500 focus:ring-1 focus:ring-offset-2 duration-100'>Update</a> 
        </td>
    </tr>";
    }
    
}


while (list($id_buku, $judul_buku, $status) = $buku->getResult()) {
    $dataBuku .= "<option value='".$id_buku."'>".$judul_buku."</option>
    ";
}

while (list($nim, $nama) = $member->getResult()) {
    $dataMember .= "<option value='".$nim."'>".$nama."</option>
    ";
}

$member->close();
$buku->close();
$tpl = new Template("templates/peminjaman.html");
$tpl->replace("DATA_TABEL", $data);
$tpl->replace("DATA_BUKU", $dataBuku);
$tpl->replace("DATA_PEMINJAM", $dataMember);
$tpl->write();
?>