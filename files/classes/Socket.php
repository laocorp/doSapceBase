<?php
class Socket {
    public static function Connection() {
        $host = "127.0.0.1";
        $port = 4401;
        $socket = @fsockopen("tcp://".$host."", $port, $errno, $errstr);

        if ($socket){
          return $socket;
        } else {
          return;
        }
    }

    public static function Get($Action, $Parameters) {
      $socket = Socket::Connection();

      if ($socket) {
        $json = json_encode(array('Action' => $Action, 'Parameters' => $Parameters));
        fwrite($socket, $json);
        $response = fread($socket, 1024);
        fclose($socket);
        return $response === "True" ? true : ($response === "False" ? false : $response);
      } else return $Parameters['Return'];
    }

    public static function Send($Action, $Parameters) {
      $socket = Socket::Connection();

      if ($socket) {
        $json = json_encode(array('Action' => $Action, 'Parameters' => $Parameters));
        fwrite($socket, $json);
        fclose($socket);
      }
    }
}
?>
