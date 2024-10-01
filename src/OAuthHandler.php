<?php

require_once 'Database.php';

class OAuthHandler
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAuthorizationUrl($email)
    {
        $authUri = 'https://login.microsoftonline.com/' . getenv('TENANT') . '/oauth2/v2.0/authorize?' .
            'client_id=' . getenv('CLIENT_ID') .
            '&scope=' . getenv('SCOPE') .
            '&redirect_uri=' . urlencode(getenv('REDIRECT_URI')) .
            '&response_type=code' .
            '&state=' . urlencode($email);

        return $authUri;
    }

    public function handleCallback($code, $email)
    {
        $token = $this->fetchAccessToken($code);
        if ($token) {
            $this->storeToken($email, $token);
        }
    }

    private function fetchAccessToken($code)
    {
        $url = 'https://login.microsoftonline.com/' . getenv('TENANT') . '/oauth2/v2.0/token';
        $postData = [
            'client_id' => getenv('CLIENT_ID'),
            'client_secret' => getenv('CLIENT_SECRET'),
            'code' => $code,
            'redirect_uri' => getenv('REDIRECT_URI'),
            'grant_type' => 'authorization_code'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        return $result['access_token'] ?? null;
    }

    private function storeToken($email, $token)
    {
        // Verificar si el correo ya existe
        $existingUser = $this->db->fetch('SELECT * FROM login365 WHERE correo = ?', [$email]);

        if ($existingUser) {
            // Actualizar el token si el correo ya existe
            $this->db->execute('UPDATE login365 SET token = ?, created_at = GETDATE() WHERE correo = ?', [$token, $email]);
        } else {
            // Insertar el token y el correo
            $this->db->execute('INSERT INTO login365 (correo, token) VALUES (?, ?)', [$email, $token]);
        }
    }
}
