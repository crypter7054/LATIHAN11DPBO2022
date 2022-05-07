<?php

class Member extends DB{
    
    // method untuk READ/get data member
    function getMember()
    {
        $query = "SELECT * FROM member ORDER BY 'date added' ASC";
        return $this->execute($query);
    }

    // get
    function getMemberUpdate($nim)
    {
        
        $query = "SELECT * FROM member WHERE nim = $nim";
        return $this->execute($query);
    }


    // method untuk CREATE/add data member
    function add($data)
    {
        $nim = $data['tnim'];
        $nama = $data['tnama'];
        $jurusan = $data['tjurusan'];

        $query = "insert into member values ('$nim', '$nama', '$jurusan')";

        // Mengeksekusi query
        return $this->execute($query);
    }


    // method untuk DELETE/delete data member
    function delete($nim)
    {
        $query = "delete FROM member WHERE nim = $nim";

        // Mengeksekusi query
        return $this->execute($query);
    }


    // method untuk UPDATE/update data nama member
    function update($nim, $data){

        $nama = $data['tnama'];
        $jurusan = $data['tjurusan'];

        $query = "UPDATE member SET
        nama = '$nama',
        jurusan = '$jurusan'
        WHERE nim = $nim;";

        return $this->executeAffected($query);

    }

}

?>