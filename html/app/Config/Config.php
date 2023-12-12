<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class Config extends BaseConfig
{
    // imágenes
    public string $img_logonavbar    = "public/ui/images/logo_navbar.png";
    public string $img_background    = "public/ui/images/bg-home.jpg";
    public string $img_x             = "public/ui/images/x.jpg";
    public string $img_logomail      = "public/email/images/logo_header.png";

    // email
    public string $email_dir         = "public/emails";
    public string $email_contacto    = "";

    // encrypt
    public string $enc_encryptmethod = "";
    public string $enc_secretkey     = "";
    public string $enc_secretiv      = "";

    // upload
    public string $upload_dir     = "public/uploads";  // writable/uploads;
    public int    $upload_maxsize = 2;
    public string $upload_ext     = "jpg,jpeg,png";
    public int    $upload_quality = 85;

}
?>
