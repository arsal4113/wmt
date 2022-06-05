<?php

/**
 * Class User
 */
class User
{
    /**
     * @var PDO
     */
    protected $db;
    /**
     * @var
     */
    protected $url;

    /**
     * User constructor.
     * @param PDO $db
     * @param $url
     */
    public function __construct(PDO $db, $url)
    {
        $this->db = $db;
        $this->url = $url;
    }

    /**
     * @param $allInfos
     * @return Exception|PDOEception|string
     */
    public function insertUserDb($allInfos)
    {
        $sql = "SELECT * from users where account_owner='" . $allInfos['accOwner'] . "' AND iban='" . $allInfos['iban'] . "';";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return "x";
        } else {

            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO users
    (name,last_name,telephone,street,house_number,zip_code,city,account_owner,iban)
    VALUES
    ('" . $allInfos['name'] . "','" . $allInfos['lastName'] . "','" . $allInfos['telephone'] . "','" . $allInfos['street'] . "'," . $allInfos['houseNumber'] . ",'" . $allInfos['zipCode'] . "','" . $allInfos['city'] . "','" . $allInfos['accOwner'] . "','" . $allInfos['iban'] . "');";
                $this->db->exec($sql);
                return $this->db->lastInsertId();
            } catch (PDOEception $e) {
                return $e;
            }
        }
    }

    /**
     * @param $id
     * @param $accOwner
     * @param $iban
     * @return mixed|string
     */
    public function sendOutRequest($id, $accOwner, $iban)
    {
        $postData = array(
            'customerId' => $id,
            'iban' => $iban,
            'owner' => $accOwner
        );
        $ch = curl_init($this->url);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type:application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData),
            CURLOPT_SSL_VERIFYPEER => false
        ));
        $response = curl_exec($ch);
        if ($response === FALSE) {
            die(curl_error($ch));
        }
        $responseData = json_decode($response, TRUE);
        if (isset($responseData['paymentDataId'])) {
            $this->addESResponse($responseData['paymentDataId'], $id);
            return $responseData['paymentDataId'];
        } else {
            return "1";
        }
    }

    /**
     * @param $pDataId
     * @param $id
     * @return Exception|PDOEception|string
     */
    public function addESResponse($pDataId, $id)
    {
        try {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "update users set paymentDataID='" . $pDataId . "' where id=" . $id . ";";
            $this->db->exec($sql);
            return $this->db->lastInsertId();
        } catch (PDOEception $e) {
            return $e;
        }
    }

}
