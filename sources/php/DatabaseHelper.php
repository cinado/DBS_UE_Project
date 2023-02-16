<?php

class DatabaseHelper
{
    const username = 'matrnr'; // use a + your matriculation number
    const password = 'your_pswd'; // use your oracle db password
    const con_string = 'oracle19.cs.univie.ac.at:1521/orclcdb';

    protected $conn;

    public function __construct()
    {
        try {
            $this->conn = @oci_connect(
                DatabaseHelper::username,
                DatabaseHelper::password,
                DatabaseHelper::con_string,
                'AL32UTF8'
            );

            //check if the connection object is != null
            if (!$this->conn) {
                // die(String(message)): stop PHP script and output message:
                die("DB error: Connection can't be established!");
            }

        } catch (Exception $e) {
            die("DB error: {$e->getMessage()}");
        }
    }

    // Used to clean up
    public function __destruct()
    {
        // clean up
        @oci_close($this->conn);
    }

    public function selectArtikel()
    {
        $sql = "SELECT * FROM Artikel ORDER BY id ASC";
        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);

        return $res;
    }

    /*public function selectOrtPlzTable()
    {
        $sql = "SELECT * FROM OrtPlzTable ORDER BY id ASC";
        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);

        return $res;
    }*/

    public function selectWirdGelagertIn()
    {
        $sql = "SELECT * FROM WirdGelagertIn";
        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);

        return $res;
    }

    public function selectLagerhalle()
    {
        $sql = "SELECT * FROM Lagerhalle";
        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);

        return $res;
    }

    public function searchLagerhalle($logistikzentrumid, $lagerhallennummer)
    {
        $sql = "SELECT * FROM Lagerhalle WHERE logistikzentrumid = {$logistikzentrumid} AND lagerhallennummer = {$lagerhallennummer}";
        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);

        return $res;
    }

    public function searchLogistikzentrum($id)
    {
        $sql = "SELECT * FROM Logistikzentrum WHERE id = {$id} ORDER BY id ASC";
        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);

        return $res;
    }

    public function selectLogistikzentrum()
    {
        $sql = "SELECT * FROM Logistikzentrum ORDER BY id ASC";
        $statement = @oci_parse($this->conn, $sql);

        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);

        return $res;
    }

    public function addArtikel($artikelnummer, $produktbezeichnung, &$success)
    {
        $sql = "INSERT INTO Artikel (artikelnummer, produktbezeichnung) VALUES('{$artikelnummer}','{$produktbezeichnung}')";
        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);

        $res = $this->selectArtikel();
        oci_free_statement($statement);
        return end($res);
    }

    public function addLogistikzentrum($name, $ort, $plz, $strasse, $hausnummer, &$success)
    {
        $sql = "INSERT INTO Logistikzentrum (name, ort, plz, strasse, hausnummer) VALUES('{$name}', '{$ort}','{$plz}', '{$strasse}', '{$hausnummer}')";
        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);

        $res = $this->selectLogistikzentrum();
        oci_free_statement($statement);
        return end($res);
    }

    public function searchArtikel($id, $artikelnummer, $produktbezeichnung)
    {
        $sql = "SELECT * FROM Artikel";
        $where = "";

        if (!$this->isEmpty($id)) {
            $where .= "id = {$id} AND ";
        }
        if (!$this->isEmpty($artikelnummer)) {
            $where .= "artikelnummer = {$artikelnummer} AND ";
        }
        if (!$this->isEmpty($produktbezeichnung)) {
            $where .= "produktbezeichnung = '{$produktbezeichnung}' AND ";
        }

        $where = rtrim($where, " AND ");
        $sql .= " WHERE {$where} ORDER BY id ASC";

        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);

        return $res;
    }

    public function searchLogistikzentrumNew($id, $name, $ort, $plz, $strasse, $hausnummer)
    {
        $sql = "SELECT * FROM Logistikzentrum";
        $where = "";

        if (!$this->isEmpty($id)) {
            $where .= "id = {$id} AND ";
        }
        if (!$this->isEmpty($name)) {
            $where .= "name = '{$name}' AND ";
        }
        if (!$this->isEmpty($ort)) {
            $where .= "ort = '{$ort}' AND ";
        }
        if (!$this->isEmpty($plz)) {
            $where .= "plz = '{$plz}' AND ";
        }

        if (!$this->isEmpty($strasse)) {
            $where .= "strasse = '{$strasse}' AND ";
        }

        if (!$this->isEmpty($hausnummer)) {
            $where .= "hausnummer = '{$hausnummer}' AND ";
        }


        $where = rtrim($where, " AND ");
        $sql .= " WHERE {$where} ORDER BY id ASC";

        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        @oci_fetch_all($statement, $res, 0, 0, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);

        return $res;
    }

    public function updateArtikel($id, $artikelnummer, $produktbezeichnung)
    {
        $sql = "UPDATE Artikel";
        $update = "";

        if (!$this->isEmpty($artikelnummer)) {
            $update .= "artikelnummer = {$artikelnummer} , ";
        }
        if (!$this->isEmpty($produktbezeichnung)) {
            $update .= "produktbezeichnung = '{$produktbezeichnung}' , ";
        }

        $update = rtrim($update, " , ");
        $sql .= " SET {$update} WHERE id = {$id}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);
        oci_commit($this->conn);
        oci_free_statement($statement);

        $res = $this->searchArtikel($id, null, null);

        return $res;
    }

    public function updateLogistikzentrum($id, $name, $ort, $plz, $strasse, $hausnummer)
    {
        $sql = "UPDATE Logistikzentrum";
        $update = "";

        if (!$this->isEmpty($name)) {
            $update .= "name = '{$name}' , ";
        }
        if (!$this->isEmpty($ort)) {
            $update .= "ort = '{$ort}' , ";
        }
        if (!$this->isEmpty($plz)) {
            $update .= "plz = '{$plz}' , ";
        }
        if (!$this->isEmpty($strasse)) {
            $update .= "strasse = '{$strasse}' , ";
        }
        if (!$this->isEmpty($hausnummer)) {
            $update .= "hausnummer = '{$hausnummer}' , ";
        }

        $update = rtrim($update, " , ");
        $sql .= " SET {$update} WHERE id = {$id}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);
        oci_commit($this->conn);
        oci_free_statement($statement);

        $res = $this->searchLogistikzentrumNew($id, null, null, null, null, null);

        return $res;
    }

    public function deleteArtikel($id)
    {
        $this->removeArtikelInWirdGelagertIn($id);
        $this->removeArtikelInWirdGeliefertVon($id);

        $sql = "DELETE FROM Artikel WHERE id = '{$id}'";
        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        $numRows = oci_num_rows($statement);
        oci_free_statement($statement);
        return ($numRows > 0) && $success;
    }

    public function deleteLogistikzentrum($id)
    {
        //DeleteLagerhalle and wirgelagertIn
        //Delete Mitarbeiter
        $this->removeLagerhalle($id);
        $this->removeMitarbeiter($id);

        $sql = "DELETE FROM Logistikzentrum WHERE id = '{$id}'";
        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement) && oci_commit($this->conn);
        $numRows = oci_num_rows($statement);
        oci_free_statement($statement);
        return ($numRows > 0) && $success;
    }

    public function removeMitarbeiter($id)
    {
        $sql = "DELETE FROM Mitarbeiter WHERE logistikzentrumid = {$id}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);
        oci_commit($this->conn);
        oci_free_statement($statement);
    }

    public function removeLagerhalle($id)
    {
        $this->removeLagerhalleFromWirdGerlagertIn($id);
        $sql = "DELETE FROM Lagerhalle WHERE logistikzentrumid = {$id}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);
        oci_commit($this->conn);
        oci_free_statement($statement);
    }

    public function removeLagerhalleFromWirdGerlagertIn($id)
    {
        $sql = "DELETE FROM WirdGelagertIn WHERE zentrumid = {$id}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);
        oci_commit($this->conn);
        oci_free_statement($statement);
    }

    public function removeArtikelInWirdGelagertIn($id)
    {
        $sql = "DELETE FROM WirdGelagertIn WHERE artikelidentifier = {$id}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);
        oci_commit($this->conn);
        oci_free_statement($statement);
    }

    public function removeArtikelInWirdGeliefertVon($id)
    {
        $sql = "DELETE FROM WirdGeliefertVon WHERE artikelid = {$id}";

        $statement = oci_parse($this->conn, $sql);
        oci_execute($statement);
        oci_commit($this->conn);
        oci_free_statement($statement);
    }

    public function getArtikelStatistics($id)
    {
        $sql = "BEGIN artikel_statistics(:a_artikel_id, :total_number, :logistikzentrum_count); END;";
        $statement = oci_parse($this->conn, $sql);

        oci_bind_by_name($statement, ":a_artikel_id", $id);
        oci_bind_by_name($statement, ":total_number", $totalNumber, 64);
        oci_bind_by_name($statement, ":logistikzentrum_count", $logistikzentrumCount, 64);

        oci_execute($statement);
        oci_commit($this->conn);
        oci_free_statement($statement);

        return array(
            "ID" => $id,
            "TOTALNUMBER" => $totalNumber,
            "LOGISTIKZENTRUMCOUNT" => $logistikzentrumCount
        );
    }

    public function isEmpty($value)
    {
        return ($value === null || trim($value) === '');
    }
}