<?php
require "database.php";
class backend{
public function dologin($user,$pass){
    return self::login($user,$pass);
}
public function doregister($userid,$fullname,$user,$pass,$address,$email){
    return self::register($userid,$fullname,$user,$pass,$address,$email);
}
private function register($userid,$fullname,$user,$pass,$address,$email){
    try {
        if($this->checkIfVallidreg($userid,$fullname,$user,$pass,$address,$email)){
            $db = new database();
            if($db->getStatus()){
                $stmt = $db->getCon()->prepare("call sp_reg(?,?,?,?,?,?)");
                $stmt->bindValue(1,$userid);
                $stmt->bindValue(2,$fullname);
                $stmt->bindValue(3,$user);
                $stmt->bindValue(4,md5($pass));
                $stmt->bindValue(5,$address);
                $stmt->bindValue(6,$email);
                $stmt->execute();
                $result = $stmt->fetchAll();
                if(!$result){
                    $db->closeConnection();
                    return "200";
                }else{
                    $db->closeConnection();
                    return "404";
                }
            }
        }
    } catch (PDOException $th) {
        return $th->getMessage();
    }
}
private function login($user,$pass){
    try {
        if($this->checkIfVallid($user,$pass)){
            $db = new database();
            if($db->getStatus()){
                $tmp = md5($pass);
                $stmt=$db->getCon()->prepare("call sp_login(?,?)");
                $stmt->bindValue(1,$user);
                $stmt->bindValue(2,$tmp);
                $stmt->execute();
                $result = $stmt->fetch();
                if($result){
                    $_SESSION['userid'] = $result['userid'];
            $_SESSION['username'] = $user;
            $_SESSION['password'] = $tmp;
            $_SESSION['role'] = $result['user_role'];
            if($result['user_role']==1){
                $db->closeConnection();
                
                return 1;
            }else if($result['user_role']==2){
                $db->closeConnection();
                
                return 2;
            }else{
                $db->closeConnection();

                return "404";
            }
                }else{
                $db->closeConnection();
                return "403";
                }
                
            }
        }
    } catch (PDOException $th) {
        return $th->getMessage();
    }
}
private function getId(){
    try {
        $db = new database();
        if ($db->getStatus()) {
            $stmt = $db->getCon()->prepare("call sp_login(?,?)");
            $stmt->bindValue(1,$_SESSION['username']);
            $stmt->bindValue(2,$_SESSION['password']);
            $stmt->execute();
            $tmp = null;
            while ($row = $stmt->fetch()) {
                $tmp = $row['userid'];
            }
            $db->closeConnection();
            return $tmp;
        }
    } catch (PDOException $th) {
        echo $th;
    }        
}
private function checkIfVallid($user, $pass)
    {
        if ($user != "" && $pass != "")
            return true;
        else
            return false;
    }
    private function checkIfVallidreg($userid,$fullname,$user, $pass,$address,$email)
        {
            if ($userid !="" && $fullname !="" && $user != "" && $pass != "" && $address != "" && $email != "")
                return true;
            else
                return false;
        }
}

?>