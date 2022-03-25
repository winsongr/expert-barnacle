<?php
require 'db.php';
$data = json_decode(file_get_contents('php://input') , true);

if (isset($data['fb_id']))
{
    if ($data['fb_id'] != '')
    {
        $fb_id = strip_tags(mysqli_real_escape_string($con, $data['fb_id']));

        $usercheck = $con->query("select * from user where fb_id='" . $fb_id . "'");
        if ($usercheck->num_rows != 0)
        {
            $user = $usercheck->fetch_assoc();
            if ($user['status'] != 1)
            {
                $returnArr = array(
                    "ResponseCode" => "401",
                    "Result" => "false",
                    "ResponseMsg" => "Your Status Deactivate!!!"
                );
                echo json_encode($returnArr);
                exit(0);
            }
            $dc = $con->query("select * from area_db where name='" . $user['area'] . "'");
            $vb = $dc->fetch_assoc();
            $returnArr = array(
                "user" => $user,
                "d_charge" => $vb['dcharge'],
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Login successfully!"
            );
            echo json_encode($returnArr);
            exit(0);
        }
        else
        {

            $name = strip_tags(mysqli_real_escape_string($con, $data['name'] ?? ''));
            $email = strip_tags(mysqli_real_escape_string($con, $data['email'] ?? ''));
            $mobile = strip_tags(mysqli_real_escape_string($con, $data['mobile'] ?? ''));
            $ccode = strip_tags(mysqli_real_escape_string($con, $data['ccode'] ?? ''));
            $imei = strip_tags(mysqli_real_escape_string($con, $data['imei'] ?? ''));
            $password = strip_tags(mysqli_real_escape_string($con, $data['password'] ?? ''));
            $refercode = strip_tags(mysqli_real_escape_string($con, $data['refercode'] ?? ''));
            $fb_id = strip_tags(mysqli_real_escape_string($con, $data['fb_id'] ?? ''));

            if ($refercode != '')
            {
                $c_refer = $con->query("select * from user where code=" . $refercode . "")->num_rows;
                if ($c_refer != 0)
                {
                    $timestamp = date("Y-m-d H:i:s");
                    $prentcode = generate_random();
                    $wallet = $con->query("select * from setting")
                        ->fetch_assoc();
                    $fin = $wallet['signupcredit'];
                    $con->query("insert into user(`name`,`imei`,`email`,`mobile`,`rdate`,`password`,`ccode`,`code`,`refercode`,`wallet`)values('" . $name . "','" . $imei . "','" . $email . "','" . $mobile . "','" . $timestamp . "','" . $password . "','" . $ccode . "'," . $prentcode . "," . $refercode . "," . $fin . ")");
                    $last_id = $con->insert_id;
                    $con->query("insert into wallet_report(`uid`,`message`,`status`,`amt`)values(" . $last_id . ",'Sign up Credit Added!!','Credit'," . $fin . ")");
                    $returnArr = array(
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "ResponseMsg" => "Registration successfully!"
                    );
                }
                else
                {
                    $returnArr = array(
                        "ResponseCode" => "401",
                        "Result" => "false",
                        "ResponseMsg" => "Refer Code Not Found Please Try Again!!"
                    );
                }
            }
            else
            {
                $timestamp = date("Y-m-d H:i:s");
                $prentcode = generate_random();
                $con->query("insert into user(`name`,`imei`,`email`,`mobile`,`rdate`,`password`,`ccode`,`code`,`fb_id`)values('" . $name . "','" . $imei . "','" . $email . "','" . $mobile . "','" . $timestamp . "','" . $password . "','" . $ccode . "'," . $prentcode . ",'" . $fb_id . "')");

                $usercheck = $con->query("select * from user where fb_id='" . $fb_id . "'");
                if ($usercheck->num_rows != 0)
                {
                    $user = $usercheck->fetch_assoc();
                    if ($user['status'] != 1)
                    {
                        $returnArr = array(
                            "ResponseCode" => "401",
                            "Result" => "false",
                            "ResponseMsg" => "Your Status Deactivate!!!"
                        );
                        echo json_encode($returnArr);
                        exit(0);
                    }
                    $dc = $con->query("select * from area_db where name='" . $user['area'] . "'");
                    $vb = $dc->fetch_assoc();
                    $returnArr = array(
                        "user" => $user,
                        "d_charge" => $vb['dcharge'],
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "ResponseMsg" => "Login successfully!"
                    );
                    echo json_encode($returnArr);
                    exit(0);
                } 
            }

            echo json_encode($returnArr);
            exit(0);
        }
    }else{

        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"FB Id required!");

        echo json_encode($returnArr);
    }
}
if (isset($data['google_id']))
{
    if ($data['google_id'] != '')
    {
        $google_id = strip_tags(mysqli_real_escape_string($con, $data['google_id']));

        $usercheck = $con->query("select * from user where google_id='" . $google_id . "'");
        if ($usercheck->num_rows != 0)
        {
            $user = $usercheck->fetch_assoc();
            if ($user['status'] != 1)
            {
                $returnArr = array(
                    "ResponseCode" => "401",
                    "Result" => "false",
                    "ResponseMsg" => "Your Status Deactivate!!!"
                );
                echo json_encode($returnArr);
                exit(0);
            }
            $dc = $con->query("select * from area_db where name='" . $user['area'] . "'");
            $vb = $dc->fetch_assoc();
            $returnArr = array(
                "user" => $user,
                "d_charge" => $vb['dcharge'],
                "ResponseCode" => "200",
                "Result" => "true",
                "ResponseMsg" => "Login successfully!"
            );
            echo json_encode($returnArr);
            exit(0);
        }
        else
        {

            $name = strip_tags(mysqli_real_escape_string($con, $data['name'] ?? ''));
            $email = strip_tags(mysqli_real_escape_string($con, $data['email'] ?? ''));
            $mobile = strip_tags(mysqli_real_escape_string($con, $data['mobile'] ?? ''));
            $ccode = strip_tags(mysqli_real_escape_string($con, $data['ccode'] ?? ''));
            $imei = strip_tags(mysqli_real_escape_string($con, $data['imei'] ?? ''));
            $password = strip_tags(mysqli_real_escape_string($con, $data['password'] ?? ''));
            $refercode = strip_tags(mysqli_real_escape_string($con, $data['refercode'] ?? ''));
            $google_id = strip_tags(mysqli_real_escape_string($con, $data['google_id'] ?? ''));

            if ($refercode != '')
            {
                $c_refer = $con->query("select * from user where code=" . $refercode . "")->num_rows;
                if ($c_refer != 0)
                {
                    $timestamp = date("Y-m-d H:i:s");
                    $prentcode = generate_random();
                    $wallet = $con->query("select * from setting")
                        ->fetch_assoc();
                    $fin = $wallet['signupcredit'];
                    $con->query("insert into user(`name`,`imei`,`email`,`mobile`,`rdate`,`password`,`ccode`,`code`,`refercode`,`wallet`)values('" . $name . "','" . $imei . "','" . $email . "','" . $mobile . "','" . $timestamp . "','" . $password . "','" . $ccode . "'," . $prentcode . "," . $refercode . "," . $fin . ")");
                    $last_id = $con->insert_id;
                    $con->query("insert into wallet_report(`uid`,`message`,`status`,`amt`)values(" . $last_id . ",'Sign up Credit Added!!','Credit'," . $fin . ")");
                    $returnArr = array(
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "ResponseMsg" => "Registration successfully!"
                    );
                }
                else
                {
                    $returnArr = array(
                        "ResponseCode" => "401",
                        "Result" => "false",
                        "ResponseMsg" => "Refer Code Not Found Please Try Again!!"
                    );
                }
            }
            else
            {
                $timestamp = date("Y-m-d H:i:s");
                $prentcode = generate_random();
                $con->query("insert into user(`name`,`imei`,`email`,`mobile`,`rdate`,`password`,`ccode`,`code`,`google_id`)values('" . $name . "','" . $imei . "','" . $email . "','" . $mobile . "','" . $timestamp . "','" . $password . "','" . $ccode . "'," . $prentcode . ",'" . $google_id . "')");

                $usercheck = $con->query("select * from user where google_id='" . $google_id . "'");
                if ($usercheck->num_rows != 0)
                {
                    $user = $usercheck->fetch_assoc();
                    if ($user['status'] != 1)
                    {
                        $returnArr = array(
                            "ResponseCode" => "401",
                            "Result" => "false",
                            "ResponseMsg" => "Your Status Deactivate!!!"
                        );
                        echo json_encode($returnArr);
                        exit(0);
                    }
                    $dc = $con->query("select * from area_db where name='" . $user['area'] . "'");
                    $vb = $dc->fetch_assoc();
                    $returnArr = array(
                        "user" => $user,
                        "d_charge" => $vb['dcharge'],
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "ResponseMsg" => "Login successfully!"
                    );
                    echo json_encode($returnArr);
                    exit(0);
                } 
            }

            echo json_encode($returnArr);
            exit(0);
        }
    }else{

        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Google Id required!");

        echo json_encode($returnArr);
    }
}




function generate_random()
{
    require 'db.php';
    $six_digit_random_number = mt_rand(100000, 999999);
    $c_refer = $con->query("select * from user where code=" . $six_digit_random_number . "")->num_rows;
    if ($c_refer != 0)
    {
        generate_random();
    }
    else
    {
        return $six_digit_random_number;
    }
}

