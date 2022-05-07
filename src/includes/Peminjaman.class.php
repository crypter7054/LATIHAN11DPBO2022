<?php

class Peminjaman extends DB{

    function getPeminjaman()
    {
        $query = "SELECT peminjaman.id, buku.judul_buku, member.nama, peminjaman.status FROM peminjaman 
        INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
        INNER JOIN member ON peminjaman.nim = member.nim";
        return $this->execute($query);
    }

    function add($data)
    {
        $buku = $data['tbuku'];
        $peminjam = $data['tpeminjam'];
        // $buku = 'inibuku';
        // $peminjam = 'inipeminjam';
        $status = "Belum";

        $query = "insert into peminjaman values ('', '$buku', '$peminjam', '$status')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($id)
    {

        $query = "delete FROM peminjaman WHERE id = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function statusPeminjaman($id)
    {

        $status = "Sudah";
        $query = "update peminjaman set status = '$status' where id = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
}
?>